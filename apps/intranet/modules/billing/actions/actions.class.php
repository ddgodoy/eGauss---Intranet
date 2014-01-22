<?php
/**
 * billing actions.
 *
 * @package    sf_icox
 * @subpackage billing
 * @author     Mauro
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class billingActions extends sfActions
{
    /**
     * index
     * @param sfWebRequest $request
     */
    public function executeIndex(sfWebRequest $request)
    {
        $this->iPage  = $request->getParameter('page', 1);
        $this->oPager = BillingTable::getInstance()->getPager($this->iPage, 20, $this->setFilter(), $this->setOrderBy());
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
        $sch_partial        = '1 ';
        $this->month        = [''=>'-- seleccionar --']+
                              [ 01=>'Enero',
                                02=>'Febrero',
                                03=>'Marzo',
                                04=>'Abril',
                                05=>'Mayo',
                                06=>'Junio',
                                07=>'julio',
                                08=>'Agosto',
                                09=>'Septiembre',
                                10=>'Octubre',
                                11=>'Noviembre',
                                12=>'Diciembre'];
        
        $this->sch_month    = trim($this->getRequestParameter('sch_month'));
        
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
    public function executeRegister(sfWebRequest $request) { $this->forward('billing', 'process'); }

   /**
    * Executes edit action
    *
    * @param sfWebRequest $request
    */
    public function executeEdit(sfWebRequest $request)
    {
  	if (!$request->getParameter('id')) {
  		$this->redirect('@billing');
  	}
  	$this->forward('billing', 'process');
    }
  
   /**
    * delete
    * @param sfWebRequest $request
    */
    public function executeDelete(sfWebRequest $request)
    {
      if (!$request->getParameter('id')) {
  		$this->redirect('@billing');
      }
      $billing = BillingTable::getInstance()->findOneById($request->getParameter('id'))->delete();
      
      $this->redirect('@billing');
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
        $this->error               = [];
        if ($this->id) {
              $entity_object = BillingTable::getInstance()->find($this->id);
        }
        
        $this->form = new BillingForm($entity_object);
        
        if ($request->getMethod() == 'POST') {
            
              $form_request = $request->getParameter($this->form->getName());
              
              $billing_month = BillingTable::getInstance()->findOneByMonthAndYear($form_request['month'], $form_request['year']);
              
              if($billing_month)
              {
                  $this->error['billing'] = 'Ya existe una facturación para este mes del año';
              }    
              
              $this->form->bind($request->getParameter($this->form->getName()));
              if ($this->form->isValid() && count($this->error)== 0) 
              {
                  $recorded = $this->form->save();
                  $this->redirect('@billing-edit?id='.$recorded->getId());
              }
        }      
        $this->setTemplate('form');
    }
}
?>
