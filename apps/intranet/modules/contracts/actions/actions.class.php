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

        $this->sch_customer    = trim($this->getRequestParameter('sch_customer'));
        $this->sch_month    = trim($this->getRequestParameter('sch_month'));
       
        if (!empty($this->sch_customer)) {
                $sch_partial .= " AND (customer LIKE '%$this->sch_customer%')";
                $this->f_params .= '&sch_customer='.urlencode($this->sch_customer);
        }
        if (!empty($this->sch_month)) {
                $sch_partial .= " AND month = '$this->sch_month'";
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
        $this->id                  = $request->getParameter('id');
        $entity_object             = NULL;
        $this->error               = array();
        if ($this->id) {
              $entity_object = ContractsIntermediationTable::getInstance()->find($this->id);
        }
        
        $this->form = new ContractsIntermediationForm($entity_object);
        
        if($this->id)
        {
           $this->form->setDefault('date', $entity_object->getYear()."-".$entity_object->getMonth()."-".$entity_object->getDay()); 
        }
        
        if ($request->getMethod() == 'POST') {
            
              
              $this->form->bind($request->getParameter($this->form->getName()));
              if ($this->form->isValid() && count($this->error)== 0) 
              {
                  $form_request = $request->getParameter($this->form->getName());
                  $recorded = $this->form->save();
                  
                  $recorded->setDay($form_request['date']['day']);
                  $recorded->setMonth($form_request['date']['month']);
                  $recorded->setYear($form_request['date']['year']);
                  $recorded->save();
                  
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
          $this->oValue  = ContractsIntermediationTable::getInstance()->find($this->id);
         

          if (empty($this->id)) { $this->redirect('@contracts'); }
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
                  
        /*echo '<pre>';
        print_r($array_data);
        echo '</pre>';
        exit();*/
        echo json_encode($date_1);
        exit();
    }        
}
?>