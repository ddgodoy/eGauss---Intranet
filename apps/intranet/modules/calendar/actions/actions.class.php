<?php
/**
 *  calendar actions.
 *
 * @package    sf_icox
 * @subpackage calendar
 * @author     pinika
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class calendarActions extends sfActions
{
   /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
    public function executeIndex(sfWebRequest $request)
    {
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
       $this->f_params  = '';
       $this->sch_year  = trim($this->getRequestParameter('sch_year'));
       $this->sch_month = trim($this->getRequestParameter('sch_month'));
       $this->sch_day   = trim($this->getRequestParameter('sch_day'));
       $sch_partial     = '1';

       if (!empty($this->sch_year)) {
           $sch_partial .= " AND year = $this->sch_year";
           $this->f_params .= '&sch_year='.urlencode($this->sch_year);
       }
       
       if (!empty($this->sch_month)) {
           $sch_partial .= " AND month = $this->sch_month";
           $this->f_params .= '&sch_month='.urlencode($this->sch_month);
       }
       
       if (!empty($this->sch_day)) {
           $sch_partial .= " AND day = $this->sch_day";
           $this->f_params .= '&sch_day='.urlencode($this->sch_day);
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
       $q_order = $this->getRequestParameter('o', 'date');	// order
       $q_sort  = $this->getRequestParameter('s', 'desc');  // sort

       $this->sort = $q_sort == 'asc' ? 'desc' : 'asc';
       $this->pager_order = "&o=$q_order&s=$q_sort";

       return "$q_order $q_sort";
    }
     
    /**
     * Executes create action
     *
     * @param sfWebRequest $request
     */
    public function executeRegister(sfWebRequest $request) { $this->forward('calendar', 'process'); }

    /**
     * Executes edit action
     *
     * @param sfWebRequest $request
     */
    public function executeEdit(sfWebRequest $request)
    {
  	if (!$request->getParameter('id')) {
  		$this->redirect('home/index');
  	}
  	$this->forward('calendar', 'process');
    }
  
    /**
     * Process form action
     *
     * @param sfWebRequest $request
     */
    public function executeProcess(sfWebRequest $request)
    {
  	$this->id        = $request->getParameter('id');
        $this->sch_year  = trim($this->getRequestParameter('sch_year'));
        $this->sch_month = trim($this->getRequestParameter('sch_month'));
        $this->sch_day   = trim($this->getRequestParameter('sch_day'));
        $this->error     = array();
  	$entity_object   = NULL;

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
              
              $event = CalendarTable::getInstance()->getAvailabilities($form_request['date']['year'], $form_request['date']['month'], $form_request['date']['day'], $hour_from, $this->id); 
              
              if($event){
                $this->error['event'] = 'Ya existe un Evento registrado para este horario: '.$hour_from.' -- '.$day;   
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
                  
                  $entity_object->setAppUserId($this->getUser()->getAttribute('user_id'));
                  $entity_object->setYear($form_request['date']['year']);
                  $entity_object->setMonth(sprintf("%02d",$form_request['date']['month']));
                  $entity_object->setDay(sprintf("%02d",$form_request['date']['day']));
                  $entity_object->setHourFrom($hour_from);
                  $entity_object->setHourTo($hour_to);
                  $entity_object->setSubject($form_request['subject']);
                  $entity_object->setBody($form_request['body']);
                  $entity_object->setTypeCalendarId(1);
                  $entity_object->setRegisteredCompaniesId(1);
                  $entity_object->save();
                  

                  $this->redirect('calendar/edit?id='.$entity_object->getId().'&sch_year='.$this->sch_year.'&sch_month='.$this->sch_month.'&sch_day='.$this->sch_day);
              }
        }

        $this->setTemplate('form');
    }
    /**
     * get date
     * @param sfWebRequest $request
     */
    public function executeGetDate(sfWebRequest $request)
    {
        return $this->renderComponent('calendar', 'calendar');
        exit();
    }       
    
    /**
     * Executes delete action
     *
     * @param sfWebRequest $request
     */
    public function executeDelete(sfWebRequest $request)
    {
          $this->sch_year = trim($this->getRequestParameter('sch_year'));
          $this->sch_month = trim($this->getRequestParameter('sch_month'));
          $this->sch_day = trim($this->getRequestParameter('sch_day'));
          
          $oValue = CalendarTable::getInstance()->find($request->getParameter('id'));

          if ($oValue) {
            $oValue->delete();
          }
          $this->redirect('@calendar_lista');
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

          if (empty($this->id)) { $this->redirect('@calendar_lista'); }
    }
}
?>