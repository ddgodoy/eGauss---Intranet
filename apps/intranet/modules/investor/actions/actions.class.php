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
  	$sch_partial = 'id > 0';
  	$this->f_params = '';
        $this->sch_name             = trim($this->getRequestParameter('sch_name'));
        $this->sch_company          = trim($this->getRequestParameter('sch_company'));
        $this->sch_project          = trim($this->getRequestParameter('sch_project'));
        $this->sch_general_theme    = trim($this->getRequestParameter('sch_general_theme'));
        $this->sch_theme            = trim($this->getRequestParameter('sch_theme'));
        $this->sch_sub_theme        = trim($this->getRequestParameter('sch_sub_theme'));
        $this->sch_accredited_enisa = trim($this->getRequestParameter('sch_accredited_enisa'));
		

        if (!empty($this->sch_name)) {
                $sch_partial .= " AND (name LIKE '%$this->sch_name%' OR last_name LIKE '%$this->sch_name%' )";
                $this->f_params .= '&sch_name='.urlencode($this->sch_name);
        }
        
        if (!empty($this->sch_company)) {
                $sch_partial .= " AND company LIKE '%$this->sch_company%'";
                $this->f_params .= '&sch_company='.urlencode($this->sch_company);
        }
        
        if (!empty($this->sch_project)) {
                $sch_partial .= " AND project LIKE '%$this->sch_project%'";
                $this->f_params .= '&sch_project='.urlencode($this->sch_project);
        }
        
        if (!empty($this->sch_general_theme)) {
                $sch_partial .= " AND general_theme_id = $this->sch_general_theme";
                $this->f_params .= '&sch_general_theme='.urlencode($this->sch_general_theme);
        }
        
        if (!empty($this->sch_theme)) {
                $sch_partial .= " AND theme_id = $this->sch_theme";
                $this->f_params .= '&sch_theme='.urlencode($this->sch_theme);
        }
        
        if (!empty($this->sch_sub_theme)) {
                $sch_partial .= " AND sub_theme LIKE '%$this->sch_sub_theme%'";
                $this->f_params .= '&sch_sub_theme='.urlencode($this->sch_sub_theme);
        }
        
        if (!empty($this->sch_accredited_enisa)) {
                $sch_partial .= " AND accredited_enisa = '$this->sch_accredited_enisa'";
                $this->f_params .= '&sch_accredited_enisa='.urlencode($this->sch_accredited_enisa);
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
        if(!$this->getUser()->hasCredential('super_admin')){
            $this->redirect('@investor');
        }
        
  	$this->id           = $request->getParameter('id');
  	$entity_object      = new Investor();

  	if ($this->id)
  	{
  		$entity_object = InvestorTable::getInstance()->find($this->id);
  	}
        
        $this->form = new InvestorForm($entity_object);
        
  	if ($request->getMethod() == 'POST')
  	{
  		$this->form->bind($request->getParameter($this->form->getName()));
              if ($this->form->isValid()) 
              {
                  $recorded = $this->form->save();
                  $this->redirect('@investor-edit?id='.$recorded->getId());
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
    
    $oXLS->setCellValue('A1', 'Nombre');
    $oXLS->setCellValue('B1', 'Apellido');
    $oXLS->setCellValue('C1', 'Teléfono');
    $oXLS->setCellValue('D1', 'Email');
    $oXLS->setCellValue('E1', 'Web personal');
    $oXLS->setCellValue('F1', 'Empresa');
    $oXLS->setCellValue('G1', 'Web');
    $oXLS->setCellValue('H1', 'Ciudad');
    $oXLS->setCellValue('I1', 'País, internacional');
    $oXLS->setCellValue('J1', 'Proyecto');
    $oXLS->setCellValue('K1', 'TIC');
    $oXLS->setCellValue('L1', 'Tema general');
    $oXLS->setCellValue('M1', 'Tema');
    $oXLS->setCellValue('N1', 'Subtema');
    $oXLS->setCellValue('O1', 'Acreditado');
    $oXLS->setCellValue('P1', 'Tipo de inversor');
    $oXLS->setCellValue('Q1', 'Inversión desde');
    $oXLS->setCellValue('R1', 'Inversión hasta');
    $oXLS->setCellValue('S1', 'Observación');
    $oXLS->setCellValue('T1', 'Conocido por');
    

    $oXLS->getRowDimension('1')->setRowHeight(20);
    $oXLS->getStyle('A1:T1')->applyFromArray($style_header);
    
    $oXLS->getColumnDimension('A')->setAutoSize(true);
    $oXLS->getColumnDimension('B')->setAutoSize(true);
    $oXLS->getColumnDimension('C')->setAutoSize(true);
    $oXLS->getColumnDimension('D')->setAutoSize(true);
    $oXLS->getColumnDimension('E')->setAutoSize(true);
    $oXLS->getColumnDimension('F')->setAutoSize(true);
    $oXLS->getColumnDimension('G')->setAutoSize(true);
    $oXLS->getColumnDimension('H')->setAutoSize(true);
    $oXLS->getColumnDimension('I')->setAutoSize(true);
    $oXLS->getColumnDimension('J')->setAutoSize(true);
    $oXLS->getColumnDimension('K')->setAutoSize(true);
    $oXLS->getColumnDimension('L')->setAutoSize(true);
    $oXLS->getColumnDimension('M')->setAutoSize(true);
    $oXLS->getColumnDimension('N')->setAutoSize(true);
    $oXLS->getColumnDimension('O')->setAutoSize(true);
    $oXLS->getColumnDimension('P')->setAutoSize(true);
    $oXLS->getColumnDimension('Q')->setAutoSize(true);
    $oXLS->getColumnDimension('R')->setAutoSize(true);
    $oXLS->getColumnDimension('S')->setAutoSize(true);
    $oXLS->getColumnDimension('T')->setAutoSize(true);
    
    //
    $ex_fila = 1;
    $obDatos = InvestorTable::getInstance()->getForExcell();

    foreach ($obDatos as $dato)
    {
            $ex_fila++;

            $oXLS->setCellValue("A$ex_fila", $dato->getName());
            $oXLS->setCellValue("B$ex_fila", $dato->getLastName());
            $oXLS->setCellValue("C$ex_fila", $dato->getPhone());
            $oXLS->setCellValue("D$ex_fila", $dato->getEmail());
            $oXLS->setCellValue("E$ex_fila", $dato->getWebPersonal());
            $oXLS->setCellValue("F$ex_fila", $dato->getCompany());
            $oXLS->setCellValue("G$ex_fila", $dato->getWebCompany());
            $oXLS->setCellValue("H$ex_fila", $dato->getCity());
            $oXLS->setCellValue("I$ex_fila", $dato->getCountry());
            $oXLS->setCellValue("J$ex_fila", $dato->getProject());
            $oXLS->setCellValue("K$ex_fila", $dato->getTic()->getName());
            $oXLS->setCellValue("L$ex_fila", $dato->getGeneralTheme()->getName());
            $oXLS->setCellValue("M$ex_fila", $dato->getTheme()->getName());
            $oXLS->setCellValue("N$ex_fila", $dato->getSubTheme());
            $oXLS->setCellValue("O$ex_fila", $dato->getAccreditedEnisa()==1?'Enisa':'');
            $oXLS->setCellValue("P$ex_fila", $dato->getTypeOfInvestor()->getName());
            $oXLS->setCellValue("Q$ex_fila", $dato->getInvestorFrom());
            $oXLS->setCellValue("R$ex_fila", $dato->getInvestorTo());
            $oXLS->setCellValue("S$ex_fila", $dato->getComment());
            $oXLS->setCellValue("T$ex_fila", $dato->getAppUser()->getName().' '.$dato->getAppUser()->getLastName());
            
    }
    
    $oXLS->getStyle("A2:T$ex_fila")->applyFromArray($style_data);
    $oXLS->getStyle("H2:T$ex_fila")->applyFromArray($style_data1);
    //
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="inversores_'.date('Ymd_His').'.xlsx"');
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($oWorkBoook, 'Excel2007');
    $objWriter->save('php://output');

    exit();
  }

} // end class