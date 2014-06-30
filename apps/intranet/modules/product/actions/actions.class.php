<?php
/**
 * product actions.
 *
 * @package    sf_icox
 * @subpackage investor
 * @author     pinika
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class productActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  	$this->iPage  = $request->getParameter('page', 1);
        $this->oPager = ProductTable::getInstance()->getPager($this->iPage, 20, $this->setFilter(), $this->setOrderBy()); 

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
      $this->f_params  = '';
      $this->sch_name  = trim($this->getRequestParameter('sch_name'));

      if (!empty($this->sch_name))
      {
        $sch_partial .= " AND (p.name LIKE '%$this->sch_name%')";
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
      $q_order = $this->getRequestParameter('o', 'p.name');	// order
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
    public function executeRegister(sfWebRequest $request) { $this->forward('product', 'process'); }

   /**
    * Executes edit action
    *
    * @param sfWebRequest $request
    */
    public function executeEdit(sfWebRequest $request)
    {
  	if (!$request->getParameter('id')) {
  		$this->redirect('@product');
  	}
  	$this->forward('product', 'process');
    }
  
   /**
    * delete
    * @param sfWebRequest $request
    */
    public function executeDelete(sfWebRequest $request)
    {
      if (!$request->getParameter('id')) {
  		$this->redirect('@product');
      }
      $procuct_company = ProductRegisteredCompaniesTable::getInstance()->findByProdcutId($request->getParameter('id'))->delete();
      $product = ProductTable::getInstance()->findOneById($request->getParameter('id'))->delete();
      
      $this->redirect('@product');
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
              $entity_object = ProductTable::getInstance()->find($this->id);
        }
        
        $this->form = new ProductForm($entity_object);
        
        if ($request->getMethod() == 'POST') {
            
              $form_request = $request->getParameter($this->form->getName());
              
              $this->form->bind($request->getParameter($this->form->getName()));
              if ($this->form->isValid()) 
              {
                  $recorded = $this->form->save();
                  
                  if ($this->id != '')
                  {
                    $d_product_registered_companies = ProductRegisteredCompaniesTable::getInstance()->findByProductId($this->id);  
                    foreach ($d_product_registered_companies as $d){
                      $array_company_by_product[$d->getRegisteredCompaniesId()] = $d->getRegisteredCompaniesId();           
                    }
                     
                  }
                  $array_company_active = '(0,';
                  foreach ($form_request['company'] AS $k => $v)
                  {
                      if($this->id != '')
                      {
                          if(empty($array_company_by_product[$v])){
                              ProductRegisteredCompanies::setProductInCompany($v, $recorded);
                          }

                      }
                      else
                      {
                          ProductRegisteredCompanies::setProductInCompany($v, $recorded);
                      }    

                      $array_company_active .= $v.',';
                  }
                  $string_company = substr($array_company_active, 0, -1).')';
                  
                  if($string_company && $this->id != ''){
                    $d_company_not_in_product = ProductRegisteredCompaniesTable::getInstance()->deleteCompanyNotInProduct($string_company, $recorded->getId());
                  }
                  
                  
                  
                  $this->redirect('@product-edit?id='.$recorded->getId());
              }
        }      
        $this->setTemplate('form');
    }
}