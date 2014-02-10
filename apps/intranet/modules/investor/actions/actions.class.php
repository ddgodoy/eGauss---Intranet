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
		$this->sch_name = trim($this->getRequestParameter('sch_name'));

		if (!empty($this->sch_name)) {
			$sch_partial .= " AND i.name LIKE '%$this->sch_name%'";
			$this->f_params .= '&sch_name='.urlencode($this->sch_name);
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

} // end class