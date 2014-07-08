<?php

/**
 * affiliated actions.
 *
 * @package    sf_icox
 * @subpackage affiliated
 * @author     Mauro 
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class affiliatedActions extends sfActions
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
      $this->oPager  = RegisteredCompaniesTable::getInstance()->getPager($this->iPage, 20, $this->setFilter(), $this->setOrderBy());
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
      $sch_partial = 'type_companies_id = 1';
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
  public function executeRegister(sfWebRequest $request) { $this->forward('affiliated', 'process'); }

  /**
   * Executes edit action
   *
   * @param sfWebRequest $request
   */
  public function executeEdit(sfWebRequest $request)
  {
  	if (!$request->getParameter('id')) {
  		$this->redirect('@affiliated');
  	}
  	$this->forward('affiliated', 'process');
  }
  
  /**
   * delete
   * @param sfWebRequest $request
   */
  public function executeDelete(sfWebRequest $request)
  {
      if (!$request->getParameter('id')) {
  		$this->redirect('@affiliated');
      }
      if ($request->getParameter('id') == 1) {
  		$this->redirect('@affiliated');
      }
      $videos      = VideosRegisteredCompaniesTable::getInstance()->findByRegisteredCompaniesId($request->getParameter('id'))->delete();
      $document    = DocumentsRegisteredCompaniesTable::getInstance()->findByRegisteredCompaniesId($request->getParameter('id'))->delete();
      NotificationsTable::getInstance()->findOneByRegisteredCompaniesId($request->getParameter('id'))->delete();
      $company = RegisteredCompaniesTable::getInstance()->findOneById($request->getParameter('id'))->delete();
      
      $this->redirect('@affiliated');
  }        
  
  /**
   * Process form action
   *
   * @param sfWebRequest $request
   */
  public function executeProcess(sfWebRequest $request)
  {
    if(!$this->getUser()->hasCredential('super_admin')){
        $this->redirect('@affiliated');
    }  
    $this->id       = $request->getParameter('id');
    $this->logo     = '';
    $entity_object  = NULL;
    $texto_mensaje  = 'registrado';
    

    $this->url_register_videos = !$this->id ? '@affiliated-register-video':'@affiliated-register-video?id='.$this->id;
    $this->url_get_videos      = !$this->id ? '@affiliated-get-components-videos':'@affiliated-get-components-videos?id='.$this->id;
    $this->url_document        = !$this->id ? '@affiliated-register-document':'@affiliated-register-document?id='.$this->id;

    if ($this->id)
    {
      $entity_object  = RegisteredCompaniesTable::getInstance()->find($this->id);
      $this->logo     = $entity_object->getLogo();
      $texto_mensaje  = 'actualizado';
    }
    $this->form = new RegisteredCompaniesForm($entity_object, array('module'=>$this->getContext()->getModuleName()));
    //
    if ($request->getMethod() == 'POST')
    {
      $this->form->bind($request->getParameter($this->form->getName()));

      if ($this->form->isValid())
      {
        $parameter_post = $request->getParameter($this->form->getName());
        $recorded = $this->form->save();
        $recorded->setCodeName(Common::getStrtrSpecialCharacters($parameter_post['name']));
        $recorded->save();
        
        if (!$this->id)
        {
          # set notification
          Notifications::setNewNotification('company_affiliated', 'Una nueva Empresas Participadas fue creada', $recorded->getId());
        }
        if ($this->id != '')
        {
          $d_app_user_registered_companies = AppUserRegisteredCompaniesTable::getInstance()->findByRegisteredCompaniesId($this->id);  
          foreach ($d_app_user_registered_companies as $d){
            $array_user_by_company[$d->getAppUserId()] = $d->getAppUserId();           
          }
          
          
          $d_product_registered_companies = ProductRegisteredCompaniesTable::getInstance()->findByRegisteredCompaniesId($this->id);  
          foreach ($d_product_registered_companies as $d){
            $array_product_by_company[$d->getProductsId()] = $d->getProductsId();           
          }
        }
        $array_user_active = '(0,';
        foreach ($parameter_post['contacts'] AS $k => $v)
        {
          if($this->id != '')
          {
              if(empty($array_user_by_company[$v])){
                  AppUserRegisteredCompanies::setNewUserInCompany($v, $recorded);
              }
              
          }
          else
          {
              AppUserRegisteredCompanies::setNewUserInCompany($v, $recorded);
          }    
          
          $array_user_active .= $v.',';
        }
        $string_user = substr($array_user_active, 0, -1).')';
        
        
        if($string_user && $this->id != ''){
            $d_user_not_in_company = AppUserRegisteredCompaniesTable::getInstance()->deleteUserNotInCompany($string_user, $recorded->getId());
        }
        
        $array_product_active = '(0,';
        foreach ($parameter_post['product'] AS $k => $v)
        {
          if($this->id != '')
          {
              if(empty($array_product_by_company[$v])){
                  ProductRegisteredCompanies::setProductInCompany($recorded->getId(), $v);
              }

          }
          else
          {
              ProductRegisteredCompanies::setProductInCompany($recorded->getId(), $v);
          }    
          $array_product_active .= $v.',';
        }
        $string_product = substr($array_product_active, 0, -1).')';
        
        if($string_product && $this->id != ''){
            $d_product_not_in_company = ProductRegisteredCompaniesTable::getInstance()->deleteProductNotInCompany($string_product, $recorded->getId());
        }
        
        # set logo
        RegisteredCompaniesTable::getInstance()->uploadLogo($request->getFiles('logo'), $recorded, $request->getParameter('reset_logo'));

        # set videos
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
        # set document
        $temp_document = TempsDocumentsTable::getInstance()->getFindAllByAppUser();

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
            $load_doc->setTypeInformationId($v_doc->getTypeInformationId());
            $load_doc->save();
            
            $v_doc->delete();
          }
        }
        $this->getUser()->setFlash('success_participada', 'El registro fue '.$texto_mensaje.' correctamente.');
        $this->redirect('@affiliated-edit?id='.$recorded->getId());
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
      return $this->renderComponent('affiliated', 'getVideos');
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
      
      return $this->renderComponent('affiliated', 'getVideos');
      exit();
      
  }
  
  /**
   * register document
   * @param sfWebRequest $request
   */
  public function executeRegisterDocument(sfWebRequest $request)
  {
      return $this->renderComponent('affiliated', 'getDocument');
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
      
      return $this->renderComponent('affiliated', 'getDocument');
      exit();
      
  }
  
  /**
   * Executes show action
   *
   * @param sfWebRequest $request
   */
   public function executeShow(sfWebRequest $request)
   {
      $this->id = $request->getParameter('id');
      $this->is_iframe = trim($this->getRequestParameter('iframe', NULL));

      if (empty($this->id)) { $this->redirect('@affiliated'); }
      
      $this->oValue           = RegisteredCompaniesTable::getInstance()->find($this->id);
      $this->logo             = $this->oValue->getLogo();
      $this->partners_company = AppUserRegisteredCompaniesTable::getInstance()->findByRegisteredCompaniesId($this->id);
      $this->information      = InformationTable::getInstance()->findByRegisteredCompaniesId($this->id);  
      $this->videos           = VideosRegisteredCompaniesTable::getInstance()->findByRegisteredCompaniesId($this->id);
      $this->document_c       = DocumentsRegisteredCompaniesTable::getInstance()->getDocumentsByCompanyAndType($this->id, array(0,1));
      $this->document_o       = DocumentsRegisteredCompaniesTable::getInstance()->getDocumentsByCompanyAndType($this->id, array(2,3));
      $this->basecamp_id      = $this->oValue->getBasecampId();
      $this->arrDatos         = NewBasecamp::todosLosProyectos(false, $this->basecamp_id);
      
      if($this->is_iframe){
          $this->setTemplate('showIframe');
          $this->setLayout('layout_iframe');
      }
   }

} // end class