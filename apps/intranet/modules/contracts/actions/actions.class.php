<?php

/**
 * contracts actions.
 *
 * @package    sf_icox
 * @subpackage contracts
 * @author     Mauro 
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contractsActions extends sfActions
{
    /**
     * index
     * @param sfWebRequest $request
     */
    public function executeIndex(sfWebRequest $request)
    {
        $temp_document = TempsDocumentsTable::getInstance()->findAll()->delete();
        $this->iPage  = $request->getParameter('page', 1);
        $this->oPager = ContractsIntermediationTable::getInstance()->getPager($this->iPage, 20, $this->setFilter(), $this->setOrderBy());
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
        $this->f_params     = '';
        $sch_partial        = '1';
        
        $this->month        = array(
                              0=>'--Seleccionar--',
                              1=>'Enero',
                              2=>'Febrero',
                              3=>'Marzo',
                              4=>'Abril',
                              5=>'Mayo',
                              6=>'Junio',
                              7=>'Julio',
                              8=>'Agosto',
                              9=>'Septiembre',
                              10=>'Octubre',
                              11=>'Noviembre',
                              12=>'Diciembre');

        $this->company      = RegisteredCompanies::getArrayForSelect(); 
        $this->sch_customer    = trim($this->getRequestParameter('sch_customer'));
        $this->sch_month       = trim($this->getRequestParameter('sch_month'));
        $this->sch_cashed      = trim($this->getRequestParameter('sch_cashed'));
        $this->sch_company  = trim($this->getRequestParameter('sch_company'));
       
        if (!empty($this->sch_customer)) {
                $sch_partial .= " AND (customer LIKE '%$this->sch_customer%')";
                $this->f_params .= '&sch_customer='.urlencode($this->sch_customer);
        }
        if (!empty($this->sch_month)) {
                $sch_partial .= " AND month = '$this->sch_month'";
                $this->f_params .= '&sch_month='.urlencode($this->sch_month);
        }
        if (!empty($this->sch_cashed)) {
                $sch_partial .= " AND cashed = '$this->sch_cashed'";
                $this->f_params .= '&sch_cashed='.urlencode($this->sch_cashed);
        }
        if (!empty($this->sch_company)) {
                $sch_partial .= " AND registered_companies_id = $this->sch_company";
                $this->f_params .= '&sch_company='.urlencode($this->sch_company);
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
          $q_order = $this->getRequestParameter('o', 'month');	// order
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
    public function executeRegister(sfWebRequest $request) { $this->forward('contracts', 'process'); }

   /**
    * Executes edit action
    *
    * @param sfWebRequest $request
    */
    public function executeEdit(sfWebRequest $request)
    {
  	if (!$request->getParameter('id')) {
  		$this->redirect('@contracts');
  	}
  	$this->forward('contracts', 'process');
    }
  
   /**
    * delete
    * @param sfWebRequest $request
    */
    public function executeDelete(sfWebRequest $request)
    {
      if (!$request->getParameter('id')) {
  		$this->redirect('@contracts');
      }
      $contracts = ContractsIntermediationTable::getInstance()->findOneById($request->getParameter('id'))->delete();
      
      $this->redirect('@contracts');
    }
    
   /**
    * Process form action
    *
    * @param sfWebRequest $request
    */
    public function executeProcess(sfWebRequest $request)
    {
        if(!$this->getUser()->hasCredential('super_admin')){
            $this->redirect('@contracts');
        }
        
        $this->id                  = $request->getParameter('id');
        $entity_object             = NULL;
        $this->error               = array();
        $this->company             = 1;
        $this->empresa             = 1;
        $this->url_document        = !$this->id ?'@contracts-register-document':'@contracts-register-document?id='.$this->id;
        if ($this->id) {
              $entity_object = ContractsIntermediationTable::getInstance()->find($this->id);
              
              
              
              if($entity_object->getRegisteredCompaniesId()){
                  $this->empresa = $entity_object->getRegisteredCompaniesId();
                  $this->company = 1;
              }else{
                  $this->company = 2;
              }
        }
        
        $this->form = new ContractsIntermediationForm($entity_object);
        $this->form->setDefault('date', "0000-00-0"); 
        
        
        if ($request->getMethod() == 'POST') {
              $this->company = $request->getParameter('company');
              $this->empresa = $request->getParameter('empresa');
              $this->form->bind($request->getParameter($this->form->getName()));
              if ($this->form->isValid() && count($this->error)== 0) 
              {
                $form_request = $request->getParameter($this->form->getName());

                $recorded = $this->form->save();

                $recorded->setDay(date('d'));
                $recorded->setMonth($form_request['month']);
                $recorded->setYear($form_request['year']);

                if($this->company==1){
                  $recorded->setRegisteredCompaniesId($this->empresa);    
                }else{
                  $recorded->setRegisteredCompaniesId(NULL);      
                }

                $recorded->save();

                if($form_request['date']['year']!= ''){
                    $date_reunion = $form_request['date']['year'].'-'.$form_request['date']['month'].'-'.$form_request['date']['day'];

                    $reunion = new ReunionContractsIntermediation();
                    $reunion->setDate($date_reunion);
                    $reunion->setComments($form_request['comments_reunion']);
                    $reunion->setContractsIntermediationId($recorded->getId());
                    $reunion->save();
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
                    $load_doc->setContractsIntermediationId($recorded->getId());
                    $load_doc->save();

                    $v_doc->delete();
                  }
                }
                  
                if(!$this->id){
                  #set notification
                  Notifications::setNewNotification('contracts', 'Un nuevo Contratos de Intermediación fue creado', '', '', '', $recorded->getId());
                }

                $this->redirect('@contracts-edit?id='.$recorded->getId());
              }
        }      
        $this->setTemplate('form');
    }
    
  /**
   * Executes show action
   *
   * @param sfWebRequest $request
   */
   public function executeShow(sfWebRequest $request)
   {
          
          $this->id      = $request->getParameter('id');
          if (empty($this->id)) { $this->redirect('@contracts'); }
          $this->oValue  = ContractsIntermediationTable::getInstance()->find($this->id);
          $this->month        = array(
                              1=>'Enero',
                              2=>'Febrero',
                              3=>'Marzo',
                              4=>'Abril',
                              5=>'Mayo',
                              6=>'Junio',
                              7=>'Julio',
                              8=>'Agosto',
                              9=>'Septiembre',
                              10=>'Octubre',
                              11=>'Noviembre',
                              12=>'Diciembre');

          $this->reunion_action = ReunionContractsIntermediationTable::getInstance()->getReunionByContract($this->id);
          $this->document       = DocumentsRegisteredCompaniesTable::getInstance()->getDocumentByContrat($this->id);
          
          
          
   }
   
   /**
    * contracts by month year
    * @param sfWebRequest $request
    */
    public function executeContractsByMonthYear(sfWebRequest $request)
    {
        $month_contracts = $request->getParameter('month_contracts', date('m'));
        $year_contracts  = $request->getParameter('year_contracts', date('Y'));
        $array_data = array('', 0, '', 0, '');
        
       
        $contracts = ContractsIntermediationTable::getInstance()->findByMonthAndYear($month_contracts, $year_contracts);
        
        if(count($contracts)>0)
        {   
            $index = 0;
            $array_data = array();
            foreach ($contracts AS $v_contract){
              $index++;  
              $array_data[$index][1] = $v_contract->getCustomer();
              $array_data[$index][2] = $v_contract->getBusinessAmount()?(double)$v_contract->getBusinessAmount():0;
              $array_data[$index][3] = '<div style="padding: 10px;">&nbsp;<b>Fecha de entrega:</b>&nbsp;'.sprintf("%02d",$v_contract->getDay()).'/'.sprintf("%02d",$v_contract->getMonth()).'/'.$v_contract->getYear().'&nbsp;<br/>&nbsp;<b>Cliente:</b>&nbsp;'.$v_contract->getCustomer().'&nbsp;<br/>&nbsp;<b>Volumen negocio:</b>&nbsp;'.($v_contract->getBusinessAmount()?$v_contract->getBusinessAmount():0).'</div>';
              $array_data[$index][4] = $v_contract->getFinalCommission()?(double)$v_contract->getFinalCommission():0;
              $array_data[$index][5] = '<div style="padding: 10px;">&nbsp;<b>Fecha de entrega:</b>&nbsp;'.sprintf("%02d",$v_contract->getDay()).'/'.sprintf("%02d",$v_contract->getMonth()).'/'.$v_contract->getYear().'&nbsp;<br/>&nbsp;<b>Socio:</b>&nbsp;'.$v_contract->getAppUser()->getName().' '.$v_contract->getAppUser()->getLastName().'&nbsp;<br/>&nbsp;<b>Comisión final:</b>&nbsp;'.($v_contract->getFinalCommission()?$v_contract->getFinalCommission():0).'</div>';
              
            }
        }
        
        $date_1 = array($array_data[1][1],$array_data[1][2],$array_data[1][3],$array_data[1][4],$array_data[1][5]);
                  
        echo json_encode($date_1);
        exit();
    } 
    
    /**
     * delete reunion by contract
     * @param sfWebRequest $request
     */
    public function executeDeleteReunionByContract(sfWebRequest $request)
    {
        $id_reunion = $request->getParameter('id_reunion');
        
        $reunion = ReunionContractsIntermediationTable::getInstance()->findOneById($id_reunion);
        
        if($reunion){
            $reunion->delete();
        }
        
        return $this->renderComponent('contracts', 'getReunionByContract');
        
        exit();
    }
    
   /**
    * register document
    * @param sfWebRequest $request
    */
   public function executeRegisterDocument(sfWebRequest $request)
   {
      return $this->renderComponent('contracts', 'getDocument');
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
      
      return $this->renderComponent('contracts', 'getDocument');
      exit();
      
   }
   
   /**
    * register document
    * @param sfWebRequest $request
    */
   public function executeRegisterDocumentComment(sfWebRequest $request)
   {
      return $this->renderComponent('contracts', 'getDocumentComment');
      exit();
   }
  
   /**
    * Delete document
    * @param sfWebRequest $request
    */
   public function executeDeleteDocumentComment(sfWebRequest $request)
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
      
      return $this->renderComponent('contracts', 'getDocumentComment');
      exit();
      
   }
   
   public function executeContratSetCommnet(sfWebRequest $request)
   {
      return $this->renderComponent('contracts', 'commentByContract');
      exit();
   }        
}
?>