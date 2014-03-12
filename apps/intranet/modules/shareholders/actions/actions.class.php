<?php

/**
 * shareholders actions.
 *
 * @package    sf_icox
 * @subpackage shareholders
 * @author     Mauro 
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class shareholdersActions extends sfActions
{
    /**
     * index
     * @param sfWebRequest $request
     */
    public function executeIndex(sfWebRequest $request)
    {
        $temp_document = TempsDocumentsTable::getInstance()->findAll()->delete();
        $this->iPage  = $request->getParameter('page', 1);
        $this->oPager = CalendarTable::getInstance()->getPager($this->iPage, 20, $this->setFilter(), $this->setOrderBy());
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
        $sch_partial        = '1 AND type_calendar_id = 2';
        $this->month        = array(
        											'-- Seleccionar --',
                              'Enero',
                              'Febrero',
                              'Marzo',
                              'Abril',
                              'Mayo',
                              'Junio',
                            	'Julio',
                              'Agosto',
                              'Septiembre',
                              'Octubre',
                              'Noviembre',
                              'Diciembre');

        $this->sch_name    = trim($this->getRequestParameter('sch_name'));
        $this->sch_month    = trim($this->getRequestParameter('sch_month'));
        

        if (!empty($this->sch_name)) {
                $sch_partial .= " AND (subject LIKE '%$this->sch_name%')";
                $this->f_params .= '&sch_name='.urlencode($this->sch_name);
        }
        if (!empty($this->sch_month)) {
                $first_day = date('Y').'-'.$this->sch_month.'-01';
                $end_day   = date('Y').'-'.$this->sch_month.'-31';
                $sch_partial .= " AND month = ".sprintf("%02d",$this->sch_month);
                $this->f_params .= '&sch_month='.urlencode($this->sch_month);
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
          $q_order = $this->getRequestParameter('o', 'subject');	// order
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
    public function executeRegister(sfWebRequest $request) { $this->forward('shareholders', 'process'); }

   /**
    * Executes edit action
    *
    * @param sfWebRequest $request
    */
    public function executeEdit(sfWebRequest $request)
    {
  	if (!$request->getParameter('id')) {
  		$this->redirect('@shareholders');
  	}
  	$this->forward('shareholders', 'process');
    }
  
   /**
    * delete
    * @param sfWebRequest $request
    */
    public function executeDelete(sfWebRequest $request)
    {
      if (!$request->getParameter('id')) {
  		$this->redirect('@shareholders');
      }
      $shareholders = CalendarTable::getInstance()->findOneById($request->getParameter('id'))->delete();
      
      $this->redirect('@shareholders');
    }
    
   /**
    * Process form action
    *
    * @param sfWebRequest $request
    */
    public function executeProcess(sfWebRequest $request)
    {
        $this->id                  = $request->getParameter('id');
        $entity_object             = NULL;
        $this->url_document        = !$this->id?'@shareholders-register-document':'@shareholders-register-document?id='.$this->id;
        $this->error               = array();
        if ($this->id) {
              $entity_object = CalendarTable::getInstance()->find($this->id);
        }
        
        $this->form = new CalendarForm($entity_object);
        
        $this->form->setDefault('date',"$this->sch_year-$this->sch_month-$this->sch_day"); 
        $this->form->setDefault('hour_from',"00:00:00");
        $this->form->setDefault('hour_to',"00:00:00");
        
        if($this->id){
            $this->form->setDefault('date',$entity_object->getYear()."-".$entity_object->getMonth()."-".$entity_object->getDay()); 
            $this->form->setDefault('hour_from',$entity_object->getHourFrom());
            $this->form->setDefault('hour_to',$entity_object->getHourTo());
        }
        
        if ($request->getMethod() == 'POST') {
              $this->form->bind($request->getParameter($this->form->getName()));
              $form_request = $request->getParameter($this->form->getName());
              
              $hour_from = sprintf("%02d", $form_request['hour_from']['hour']).':'.sprintf("%02d", $form_request['hour_from']['minute']).':'.sprintf("%02d", $form_request['hour_from']['second']);
              
              $hour_to   = sprintf("%02d", $form_request['hour_to']['hour']).':'.sprintf("%02d", $form_request['hour_to']['minute']).':'.sprintf("%02d", $form_request['hour_to']['second']);
             
              $day       = sprintf("%02d",$form_request['date']['day']).'/'.sprintf("%02d",$form_request['date']['month']).'/'.$form_request['date']['year'];
              
              $shareholders = CalendarTable::getInstance()->getAvailabilities($form_request['date']['year'], $form_request['date']['month'], $form_request['date']['day'], $hour_from, $this->id); 
              
              if($shareholders){
                $this->error['shareholders'] = 'Ya existe un Evento registrado para este horario: '.$hour_from.' -- '.$day;   
              }
              
              if($hour_from >= $hour_to)
              {
                 $this->error['hour'] = 'El Horario de inicio debe ser anterior a Horario de fin'; 
              }              
              if ($this->form->isValid() && count($this->error)== 0 ) 
              {
                  
                  if (!$this->id) {
                    $entity_object = NEW Calendar(); 
                  }
                  
                  if($form_request['next']){
                      $all_shareholders = CalendarTable::getInstance()->findByTypeCalendarId(2);
                      if($all_shareholders){
                        foreach ($all_shareholders AS $v){
                            $v->setNext(0);
                            $v->save();
                        }
                      }    
                  }
                  
                  $entity_object->setAppUserId($this->getUser()->getAttribute('user_id'));
                  $entity_object->setYear($form_request['date']['year']);
                  $entity_object->setMonth($form_request['date']['month']);
                  $entity_object->setDay($form_request['date']['day']);
                  $entity_object->setHourFrom($hour_from);
                  $entity_object->setHourTo($hour_to);
                  $entity_object->setSubject($form_request['subject']);
                  $entity_object->setBody($form_request['body']);
                  $entity_object->setTypeCalendarId(2);
                  $entity_object->setNext($form_request['next']);
                  $entity_object->setRegisteredCompaniesId(1);
                  $entity_object->save();
                  
                  #set document
                  $temp_document = TempsDocumentsTable::getInstance()->findAll();
                  if($temp_document)
                  {
                      foreach ($temp_document AS $v_doc)
                      {
                          $load_doc = NEW DocumentsRegisteredCompanies();
                          $load_doc->setName($v_doc->getName());
                          $load_doc->setIcon($v_doc->getIcon());
                          $load_doc->setDescription($v_doc->getDescription());
                          $load_doc->setDownload($v_doc->getDownload());
                          $load_doc->setUrl($v_doc->getUrl());
                          $load_doc->setRegisteredCompaniesId($entity_object->getRegisteredCompaniesId());
                          $load_doc->setCalendarId($entity_object->getId());
                          $load_doc->save();

                          $v_doc->delete();
                      }
                  }

                  $this->redirect('@shareholders-edit?id='.$entity_object->getId());
              }
        }

        $this->setTemplate('form');
    }
    
   /**
    * register document
    * @param sfWebRequest $request
    */
    public function executeRegisterDocument(sfWebRequest $request)
    {
        return $this->renderComponent('shareholders', 'getDocument');
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

        return $this->renderComponent('shareholders', 'getDocument');
        exit();
      
    }   
    
    /**
     * Executes show action
     *
     * @param sfWebRequest $request
     */
    public function executeShow(sfWebRequest $request)
    {
          $this->sch_year = trim($this->getRequestParameter('sch_year'));
          $this->sch_month = trim($this->getRequestParameter('sch_month'));
          $this->sch_day = trim($this->getRequestParameter('sch_day'));
          
          $this->id = $request->getParameter('id');
          $this->oValue = CalendarTable::getInstance()->find($this->id);

          if (empty($this->id)) { $this->redirect('@shareholders?sch_year='.$this->sch_year.'&sch_month='.$this->sch_month.'&sch_day='.$this->sch_day); }
    }
}
?>
