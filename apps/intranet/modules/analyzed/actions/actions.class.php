<?php

/**
 * analyzed actions.
 *
 * @package    sf_icox
 * @subpackage analyzed
 * @author     Mauro 
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class analyzedActions extends sfActions
{
  /**
   * index
   * @param sfWebRequest $request
   */
  public function executeIndex(sfWebRequest $request)
  {
		$this->getUser()->getAttributeHolder()->remove('videos');
		$temp_document = TempsDocumentsTable::getInstance()->findAll()->delete();
		
		$this->iPage  = $request->getParameter('page', 1);
		$this->oPager = RegisteredCompaniesTable::getInstance()->getPager($this->iPage, 20, $this->setFilter(), $this->setOrderBy());
		$this->oList  = $this->oPager->getResults();
		$this->oCant  = $this->oPager->getNbResults();
  }   
    
    /**
     * Set filter
     *
     * @return string
     */
    protected function setFilter()
    {
        $sch_partial = 'type_companies_id = 2 ';
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
  public function executeRegister(sfWebRequest $request) { $this->forward('analyzed', 'process'); }

  /**
   * Executes edit action
   *
   * @param sfWebRequest $request
   */
  public function executeEdit(sfWebRequest $request)
  {
  	if (!$request->getParameter('id')) {
  		$this->redirect('@analyzed');
  	}
  	$this->forward('analyzed', 'process');
  }
  
  /**
   * delete
   * @param sfWebRequest $request
   */
  public function executeDelete(sfWebRequest $request)
  {
      if (!$request->getParameter('id')) {
  		$this->redirect('@analyzed');
      }
      $videos      = VideosRegisteredCompaniesTable::getInstance()->findByRegisteredCompaniesId($request->getParameter('id'))->delete();
      $document    = DocumentsRegisteredCompaniesTable::getInstance()->findByRegisteredCompaniesId($request->getParameter('id'))->delete();
      NotificationsTable::getInstance()->findOneByRegisteredCompaniesId($request->getParameter('id'))->delete();
      $company = RegisteredCompaniesTable::getInstance()->findOneById($request->getParameter('id'))->delete();
      
      $this->redirect('@analyzed');
  }        
  
  /**
   * Process form action
   *
   * @param sfWebRequest $request
   */
  public function executeProcess(sfWebRequest $request)
  {
    if(!$this->getUser()->hasCredential('super_admin')){
        $this->redirect('@analyzed');
    }   
    $this->id      = $request->getParameter('id');
    $this->logo    = '';
    $entity_object = NULL;
    $this->url_register_videos = !$this->id ? '@analyzed-register-video'       : '@analyzed-register-video?id='.$this->id;
    $this->url_get_videos      = !$this->id ? '@analyzed-get-components-videos': '@analyzed-get-components-videos?id='.$this->id;
    $this->url_document        = !$this->id ? '@analyzed-register-document'    : '@analyzed-register-document?id='.$this->id;

    if ($this->id)
    {
      $entity_object = RegisteredCompaniesTable::getInstance()->find($this->id);
      $this->logo    = $entity_object->getLogo();
    }
    $this->form = new RegisteredCompaniesForm($entity_object, array('module'=>$this->getContext()->getModuleName()));
      
    if ($request->getMethod() == 'POST')
    {
      $this->form->bind($request->getParameter($this->form->getName()));

      if ($this->form->isValid()) 
      {
        $parameter_post = $request->getParameter($this->form->getName());
        $recorded = $this->form->save();
            
        #set logo
        RegisteredCompaniesTable::getInstance()->uploadLogo($request->getFiles('logo'), $recorded, $request->getParameter('reset_logo'));
        
        #set videos
        if ($new_videos = $this->getUser()->getAttribute('videos'))
        {
          foreach ($new_videos as $k=>$value)
          {
            $load_videos = new VideosRegisteredCompanies();
            $load_videos->setName($value['name']);
            $load_videos->setUrl($value['url']);
            $load_videos->setRegisteredCompaniesId($recorded->getId());
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
            $load_doc->setRegisteredCompaniesId($recorded->getId());
            $load_doc->setTypeInformationId(1);
            $load_doc->save();
            
            $v_doc->delete();
          }
        }               
        if (!$this->id)
        {
          #set notification
          Notifications::setNewNotification('company_analyzed', 'Una nueva Empresas para Analizar fue creada', $recorded->getId());
        }
        if ($request->getParameter('affiliated') == 1)
        {
          $recorded->setTypeCompaniesId(1);
          $recorded->save();

          #set notification
          NotificationsTable::getInstance()->findOneByRegisteredCompaniesId($recorded->getId())->delete();
          Notifications::setNewNotification('company_affiliated', 'Una nueva Empresas Participadas fue creada', $recorded->getId());

          $this->redirect('@affiliated-edit?id='.$recorded->getId());
        }
        $this->redirect('@analyzed-edit?id='.$recorded->getId());
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
      return $this->renderComponent('analyzed', 'getVideos');
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
      
      return $this->renderComponent('analyzed', 'getVideos');
      exit();
      
  }
  
  /**
   * register document
   * @param sfWebRequest $request
   */
  public function executeRegisterDocument(sfWebRequest $request)
  {
      return $this->renderComponent('analyzed', 'getDocument');
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
      
      return $this->renderComponent('analyzed', 'getDocument');
      exit();
      
  }
  
  /**
   * Executes show action
   *
   * @param sfWebRequest $request
   */
   public function executeShow(sfWebRequest $request)
   {
          
          $this->id      = $request->getParameter('id');
          $this->oValue  = RegisteredCompaniesTable::getInstance()->find($this->id);
          $this->logo    = $this->oValue->getLogo();

          if (empty($this->id)) { $this->redirect('@analyzed'); }
   }
}