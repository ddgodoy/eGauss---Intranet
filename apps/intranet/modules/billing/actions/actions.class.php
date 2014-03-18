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
        if(!$this->getUser()->hasCredential('super_admin')){
            $this->redirect('@homepage');
        }
        
        $this->id                  = $request->getParameter('id');
        $entity_object             = NULL;
        $this->error               = array();
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
    
    /**
     * billing by month year
     * @param sfWebRequest $request
     */
    public function executeBillingByMonthYear(sfWebRequest $request)
    {
        $month_graph = $request->getParameter('month_graph', date('m'));
        $year_graph  = $request->getParameter('year_graph', date('Y'));

        $array_data = array
        (
          1 => array(1=>0, 2=>0),
          2 => array(1=>0,2=>0),
          3 => array(1=>0,2=>0),
          4 => array(1=>0,2=>0),
          5 => array(1=>0,2=>0),
        );
        $tot_est = 0;
        $tot_fac = 0;
        $billing = BillingTable::getInstance()->findOneByMonthAndYear($month_graph, $year_graph);

        if ($billing)
        {
        	$t_affiliated  = $billing->getTotalAffiliated() ? (double)$billing->getTotalAffiliated() : 0;
					$t_consultancy = $billing->getTotalConsultancy() ? (double)$billing->getTotalConsultancy() : 0;
					$t_intermediat = $billing->getTotalIntermediation() ? (double)$billing->getTotalIntermediation() : 0;
					$t_formation   = $billing->getTotalFormation() ? (double)$billing->getTotalFormation() : 0;
					$t_patents     = $billing->getTotalPatents() ? (double)$billing->getTotalPatents() : 0;
					
					$p_affiliated  = $billing->getSaleOfAffiliated() ? (double)$billing->getSaleOfAffiliated() : 0;
					$p_consultancy = $billing->getConsultancy() ? (double)$billing->getConsultancy() : 0;
					$p_intermediat = $billing->getIntermediation() ? (double)$billing->getIntermediation() : 0;
					$p_formation   = $billing->getFormation() ? (double)$billing->getFormation() : 0;
					$p_patents     = $billing->getPatents() ? (double)$billing->getPatents() : 0;

          $array_data = array
          (
            1 => array(1 => $t_affiliated , 2 => $p_affiliated),
            2 => array(1 => $t_consultancy, 2 => $p_consultancy),
            3 => array(1 => $t_intermediat, 2 => $p_intermediat),
            4 => array(1 => $t_formation  , 2 => $p_formation),
            5 => array(1 => $t_patents    , 2 => $p_patents),
          );
          $tot_est = $t_affiliated + $t_consultancy + $t_intermediat + $t_formation + $t_patents;
        	$tot_fac = $p_affiliated + $p_consultancy + $p_intermediat + $p_formation + $p_patents;
        }
        $title = array('Conceptos Facturados', 'Estimado', 'Facturado');
        $data1 = array('Venta de Participadas', $array_data[1][1], $array_data[1][2]);
        $data2 = array('Consultoría', $array_data[2][1], $array_data[2][2]);
        $data3 = array('Intermediación', $array_data[3][1], $array_data[3][2]);
        $data4 = array('Formación', $array_data[4][1], $array_data[4][2]);
        $data5 = array('Patentes', $array_data[5][1], $array_data[5][2]);
       
        $test = array(
        	'estimado'  => $tot_est,
        	'facturado' => $tot_fac,
        	'datos'     => array($title,$data1, $data2, $data3, $data4, $data5),
        );
        echo json_encode($test);
        exit();
    }
}
?>