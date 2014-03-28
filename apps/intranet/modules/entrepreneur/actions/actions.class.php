<?php

/**
 * entrepreneur actions.
 *
 * @package    sf_icox
 * @subpackage entrepreneur
 * @author     Mauro 
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class entrepreneurActions extends sfActions
{
    /**
     * index
     * @param sfWebRequest $request
     */
    public function executeIndex(sfWebRequest $request)
    {
      $this->getUser()->getAttributeHolder()->remove('videos');

      $temp_document = TempsDocumentsTable::getInstance()->findAll()->delete();
      $this->iPage   = $request->getParameter('page', 1);
      $this->oPager  = EntrepreneurTable::getInstance()->getPager($this->iPage, 20, $this->setFilter(), $this->setOrderBy());
      
      $this->oList   = $this->oPager->getResults();
      $this->oCant   = $this->oPager->getNbResults();
    }   
    
    /**
     * Set filter
     *
     * @return string
     */
    protected function setFilter()
    {
      $sch_partial = '1 ';
      $this->f_params  = '';
      $this->sch_name  = trim($this->getRequestParameter('sch_name'));
      $this->sch_email = trim($this->getRequestParameter('sch_email'));

      if (!empty($this->sch_name))
      {
        $sch_partial .= " AND (name LIKE '%$this->sch_name%')";
        $this->f_params .= '&sch_name='.urlencode($this->sch_name);
      }
      if (!empty($this->sch_email))
      {
        $sch_partial .= " AND email LIKE '%$this->sch_email%'";
        $this->f_params .= '&sch_email='.urlencode($this->sch_email);
      }
      return $sch_partial;
    }
    
    /**
     * Set list order
     *
     * @return string
     */
    protected function setOrderBy()
    {
      $q_order = $this->getRequestParameter('o', 'name');	// order
      $q_sort  = $this->getRequestParameter('s', 'asc');  // sort

      $this->sort = $q_sort == 'asc' ? 'desc' : 'asc';
      $this->pager_order = "&o=$q_order&s=$q_sort";

      return "$q_order $q_sort";
    }
    
    /**
     * Executes create action
     *
     * @param sfWebRequest $request
     */
    public function executeRegister(sfWebRequest $request) { $this->forward('entrepreneur', 'process'); }

    /**
     * Executes edit action
     *
     * @param sfWebRequest $request
     */
    public function executeEdit(sfWebRequest $request)
    {
          if (!$request->getParameter('id')) {
                  $this->redirect('@entrepreneur');
          }
          $this->forward('entrepreneur', 'process');
    }

    /**
     * delete
     * @param sfWebRequest $request
     */
    public function executeDelete(sfWebRequest $request)
    {
        if (!$request->getParameter('id')) {
                  $this->redirect('@entrepreneur');
        } 
        $videos       = VideosRegisteredCompaniesTable::getInstance()->findByEntrepreneurId($request->getParameter('id'))->delete();
        $document     = DocumentsRegisteredCompaniesTable::getInstance()->findByEntrepreneurId($request->getParameter('id'))->delete();
        $entrepreneur = EntrepreneurTable::getInstance()->findOneById($request->getParameter('id'))->delete();

        $this->redirect('@entrepreneur');
    } 
    
    /**
     * Process form action
     *
     * @param sfWebRequest $request
     */
    public function executeProcess(sfWebRequest $request)
    {
      if(!$this->getUser()->hasCredential('super_admin')){
          $this->redirect('@entrepreneur');
      }   
      $this->id      = $request->getParameter('id');
      $entity_object = NULL;
      $this->url_register_videos = !$this->id ? '@entrepreneur-register-video'       : '@entrepreneur-register-video?id='.$this->id;
      $this->url_get_videos      = !$this->id ? '@entrepreneur-get-components-videos': '@entrepreneur-get-components-videos?id='.$this->id;
      $this->url_document        = !$this->id ? '@entrepreneur-register-document'    : '@entrepreneur-register-document?id='.$this->id;

      if ($this->id)
      {
        $entity_object = EntrepreneurTable::getInstance()->find($this->id);
      }
      $this->form = new EntrepreneurForm($entity_object);

      if ($request->getMethod() == 'POST')
      {
        $this->form->bind($request->getParameter($this->form->getName()));

        if ($this->form->isValid()) 
        {
          $parameter_post = $request->getParameter($this->form->getName());
          $recorded = $this->form->save();

          #set videos
          if ($new_videos = $this->getUser()->getAttribute('videos'))
          {
            foreach ($new_videos as $k=>$value)
            {
              $load_videos = new VideosRegisteredCompanies();
              $load_videos->setName($value['name']);
              $load_videos->setUrl($value['url']);
              $load_videos->setEntrepreneurId($recorded->getId());
              $load_videos->save();
            }  
            $this->getUser()->getAttributeHolder()->remove('videos');
          }
          #set document
          $temp_document = TempsDocumentsTable::getInstance()->findAll();

          if ($temp_document)
          {
            foreach ($temp_document AS $v_doc)
                  {
              $load_doc = NEW DocumentsRegisteredCompanies();
              $load_doc->setName($v_doc->getName());
              $load_doc->setIcon($v_doc->getIcon());
              $load_doc->setDescription($v_doc->getDescription());
              $load_doc->setDownload($v_doc->getDownload());
              $load_doc->setUrl($v_doc->getUrl());
              $load_doc->setEntrepreneurId($recorded->getId());
              $load_doc->setTypeInformationId(1);
              $load_doc->save();

              $v_doc->delete();
            }
          }               
          
          $this->redirect('@entrepreneur-edit?id='.$recorded->getId());
        }
      }
      $this->setTemplate('form');
    }   

  /**
   * register video
   * @param sfWebRequest $request
   */
  public function executeRegisterVideo(sfWebRequest $request)
  {
      $this->error      = array();
      $this->name       = $request->getParameter('name','');
      $this->url        = $request->getParameter('url','');
      $this->msj_ok     = false;
      $array_videos_new = array();
      $array_videos     = $this->getUser()->getAttribute('videos', array());
      
      if($request->isMethod('POST'))
      {          
          if($this->name == ''){$this->error['name']='Ingrese el nombre';}    
          if($this->url == ''){$this->error['url']='Ingrese la url';}  
          
          if(count($this->error)== 0)
          {
              $array_videos_new[] = array(
                                    'name' => $this->name, 
                                    'url'  => $this->url,
                                    'type' => 'temp'
                                );
  
              $new_videos_array = array_merge($array_videos,$array_videos_new);
              $this->getUser()->setAttribute('videos', $new_videos_array);
              $this->name = '';
              $this->url  ='';
              $this->msj_ok = true;
          }    
      }    
      
      $this->setLayout('layout_iframe');
  }
  
  /**
   * get components videos
   * @param sfWebRequest $request
   */
  public function executeGetComponentsVideos(sfWebRequest $request)
  {
      return $this->renderComponent('entrepreneur', 'getVideos');
      exit();
  }     
  
  /**
   * Delete Video
   * @param sfWebRequest $request
   */
  public function executeDeleteVideo(sfWebRequest $request)
  {
      $id           = $request->getParameter('id_video');
      $array_videos = $this->getUser()->getAttribute('videos', array());
      $type         = $request->getParameter('type');
      
      if($type == 'real')
      {
          $d_videos = VideosRegisteredCompaniesTable::getInstance()->findOneById($id)->delete();
      }
      else
      {    
        unset($array_videos[$id]);
      }  
      
      $this->getUser()->setAttribute('videos', $array_videos);
      
      return $this->renderComponent('entrepreneur', 'getVideos');
      exit();
      
  }
  
  /**
   * register document
   * @param sfWebRequest $request
   */
  public function executeRegisterDocument(sfWebRequest $request)
  {
      return $this->renderComponent('entrepreneur', 'getDocument');
      exit();
  }
  
  /**
   * Delete document
   * @param sfWebRequest $request
   */
  public function executeDeleteDocument(sfWebRequest $request)
  {
      $id = $request->getParameter('id_doc');
      $type = $request->getParameter('type');
      
      if($type == 'real'){
          $d_document = DocumentsRegisteredCompaniesTable::getInstance()->findOneById($id);
      }else{
          $d_document = TempsDocumentsTable::getInstance()->findOneById($id);
      }
          
      if($d_document)
      {
          $d_document->delete();
      }    
      
      return $this->renderComponent('entrepreneur', 'getDocument');
      exit();
      
  }    
}

