<?php

/**
 * investor actions.
 *
 * @package    sf_icox
 * @subpackage investor
 * @author     pinika
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class investorActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  	$this->iPage  = $request->getParameter('page', 1);
  	$this->oPager = InvestorTable::getInstance()->getPager($this->iPage, 20, $this->setFilter(), $this->setOrderBy());

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
  	$sch_partial = 'i.id > 0';
  	$this->f_params = '';
		$this->sch_inversor = trim($this->getRequestParameter('sch_inversor'));
		$this->sch_empresa  = trim($this->getRequestParameter('sch_empresa'));
		$this->sch_sector   = trim($this->getRequestParameter('sch_sector'));
		$this->sch_estado   = trim($this->getRequestParameter('sch_estado', ''));

		if (!empty($this->sch_inversor)) {
			$sch_partial .= " AND i.name LIKE '%$this->sch_inversor%'";
			$this->f_params .= '&sch_inversor='.urlencode($this->sch_inversor);
		}
		if (!empty($this->sch_empresa)) {
			$sch_partial .= " AND e.name LIKE '%$this->sch_empresa%'";
			$this->f_params .= '&sch_empresa='.urlencode($this->sch_empresa);
		}
		if (!empty($this->sch_sector)) {
			$sch_partial .= " AND i.business LIKE '%$this->sch_sector%'";
			$this->f_params .= '&sch_sector='.urlencode($this->sch_sector);
		}
		if (!empty($this->sch_estado)) {
			$sch_partial .= " AND i.estado = '$this->sch_estado'";
			$this->f_params .= '&sch_estado='.urlencode($this->sch_estado);
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
  	$q_order = $this->getRequestParameter('o', 'i.created_at');	// order
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
  public function executeRegister(sfWebRequest $request) { $this->forward('investor', 'process'); }

  /**
	 * Executes edit action
	 *
	 * @param sfWebRequest $request
	 */
  public function executeEdit(sfWebRequest $request)
  {
  	if (!$request->getParameter('id')) {
  		$this->redirect('@investors');
  	}
  	$this->forward('investor', 'process');
  }
  
  /**
   * Process form action
   *
   * @param sfWebRequest $request
   */
  public function executeProcess(sfWebRequest $request)
  {
  	$this->id      = $request->getParameter('id');
  	$this->empresa = 0;
  	$this->name    = '';
  	$this->amount  = 0;
  	$this->phone   = '';
  	$this->website = '';
  	$this->address = '';
  	$this->sector  = '';
  	$this->year    = date('Y');
  	$this->estado  = 'pendiente';
  	$this->error   = array();
  	$entity_object = new Investor();

  	if ($this->id)
  	{
  		$entity_object = InvestorTable::getInstance()->find($this->id);

  		$this->empresa = $entity_object->getRegisteredCompaniesId();
	  	$this->name    = $entity_object->getName();
	  	$this->amount  = $entity_object->getAmount();
	  	$this->phone   = $entity_object->getPhone();
	  	$this->website = $entity_object->getWebsite();
	  	$this->address = $entity_object->getAddress();
	  	$this->sector  = $entity_object->getBusiness();
	  	$this->year    = $entity_object->getYear();
	  	$this->estado  = $entity_object->getEstado();
  	}
  	if ($request->getMethod() == 'POST')
  	{
  		$this->empresa = $request->getParameter('empresa');
	  	$this->name    = trim($request->getParameter('name'));
	  	$this->amount  = trim($request->getParameter('amount', 0));
	  	$this->phone   = trim($request->getParameter('phone'));
	  	$this->website = trim($request->getParameter('website'));
	  	$this->address = trim($request->getParameter('address'));
	  	$this->sector  = trim($request->getParameter('sector'));
	  	$this->year    = trim($request->getParameter('year'));
	  	$this->estado  = $request->getParameter('estado');

	  	if (empty($this->name))  { $this->error['name']  = 'Ingrese el nombre'; }
  		if (empty($this->phone)) { $this->error['phone'] = 'Ingrese el teléfono'; }
  		if (empty($this->year))  { $this->error['year']  = 'Ingrese el año'; }

  		if (count($this->error) == 0)
  		{
  			$entity_object->setName    ($this->name);
  			$entity_object->setAmount  ($this->amount);
  			$entity_object->setPhone   ($this->phone);
  			$entity_object->setWebsite ($this->website);
  			$entity_object->setAddress ($this->address);
  			$entity_object->setBusiness($this->sector);
  			$entity_object->setYear    ($this->year);
  			$entity_object->setEstado  ($this->estado);
  			$entity_object->setRegisteredCompaniesId($this->empresa);
  			$entity_object->save();

  			$this->redirect('@investor-show?id='.$entity_object->getId());
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
  	$this->id = $request->getParameter('id');

  	if (empty($this->id)) { $this->redirect('@investors'); }

  	$this->oValue = InvestorTable::getInstance()->find($this->id);
  }
  
  /**
   * Executes delete action
   *
   * @param sfWebRequest $request
   */
  public function executeDelete(sfWebRequest $request)
  {
  	$oValue = InvestorTable::getInstance()->find($request->getParameter('id'));

  	if ($oValue) {
  		$oValue->delete();
  	}
  	$this->redirect('@investors');
  }
  
 /**
  * Executes export to excel action
  *
  * @param sfRequest $request A request object
  */
  public function executeExcel(sfWebRequest $request)
  {
  	define('PHPEXCEL_ROOT', sfConfig::get('sf_root_dir').'/lib/vendor/PHPExcel');

  	require_once PHPEXCEL_ROOT.'/Autoloader.php';

		$oWorkBoook = new PHPExcel();
		
		// cell styles
    $style_header = array(
    	'borders'   => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN)),
    	'fill'      => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => 'ECECEC')),
    	'font' 			=> array('size' => 10, 'bold' => true),
    	'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER)
    );
    $style_data = array(
    	'borders' => array('outline' => array('style' => PHPExcel_Style_Border::BORDER_THIN))
    );
    $style_data1 = array(
    	'alignment' => array('wrap' => true)
    );
    //
    $oXLS = $oWorkBoook->setActiveSheetIndex(0);
  	$oXLS->setTitle('Reporte de Inversores');

  	$fontStyle = $oXLS->getDefaultStyle()->getFont();
    $fontStyle->setName('Arial');
    $fontStyle->setSize(10);
    
    $oXLS->setCellValue('A1', 'Nombre del inversor');
    $oXLS->setCellValue('B1', 'Teléfono');
    $oXLS->setCellValue('C1', 'Dirección');
    $oXLS->setCellValue('D1', 'Nombre de la empresa');
    $oXLS->setCellValue('E1', 'Sector');
    $oXLS->setCellValue('F1', 'Página web');
    $oXLS->setCellValue('G1', 'Año de la inversión');
    $oXLS->setCellValue('H1', 'Monto');
    $oXLS->setCellValue('I1', 'Estado');

    $oXLS->getRowDimension('1')->setRowHeight(20);
    $oXLS->getStyle('A1:I1')->applyFromArray($style_header);
    
    $oXLS->getColumnDimension('A')->setAutoSize(true);
    $oXLS->getColumnDimension('B')->setAutoSize(true);
    $oXLS->getColumnDimension('C')->setAutoSize(true);
    $oXLS->getColumnDimension('D')->setAutoSize(true);
    $oXLS->getColumnDimension('E')->setAutoSize(true);
    $oXLS->getColumnDimension('F')->setAutoSize(true);
    $oXLS->getColumnDimension('G')->setAutoSize(true);
    $oXLS->getColumnDimension('H')->setAutoSize(true);
    $oXLS->getColumnDimension('I')->setAutoSize(true);
		//
		$ex_fila = 1;
		$obDatos = InvestorTable::getInstance()->getForExcell();

		foreach ($obDatos as $dato)
		{
			$ex_fila++;

			$oXLS->setCellValue("A$ex_fila", utf8_encode($dato->getName()));
	    $oXLS->setCellValue("B$ex_fila", utf8_encode($dato->getPhone()));
	    $oXLS->setCellValue("C$ex_fila", utf8_encode($dato->getAddress()));
	    $oXLS->setCellValue("D$ex_fila", utf8_encode($dato->RegisteredCompanies->getName()));
	    $oXLS->setCellValue("E$ex_fila", utf8_encode($dato->getBusiness()));
	    $oXLS->setCellValue("F$ex_fila", utf8_encode($dato->getWebsite()));
	    $oXLS->setCellValue("G$ex_fila", utf8_encode($dato->getYear()));
	    $oXLS->setCellValue("H$ex_fila", $dato->getAmount());
	    $oXLS->setCellValue("I$ex_fila", strtoupper(utf8_encode($dato->getEstado())));
		}
		$oXLS->getStyle("A2:I$ex_fila")->applyFromArray($style_data);
		$oXLS->getStyle("H2:I$ex_fila")->applyFromArray($style_data1);
		//
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	  header('Content-Disposition: attachment;filename="inversores_'.date('Ymd_His').'.xlsx"');
	  header('Cache-Control: max-age=0');
	
	  $objWriter = PHPExcel_IOFactory::createWriter($oWorkBoook, 'Excel2007');
	  $objWriter->save('php://output');

	  exit();
  }

} // end class