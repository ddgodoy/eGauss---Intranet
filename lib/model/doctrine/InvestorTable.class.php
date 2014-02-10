<?php

/**
 * InvestorTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class InvestorTable extends Doctrine_Table
{
  /**
   * Returns an instance of this class.
   *
   * @return object InvestorTable
   */
  public static function getInstance() { return Doctrine_Core::getTable('Investor'); }
    
  /**
	 * Get pager for list
	 *
	 * @param integer $page
	 * @param integer $per_page
	 * @param string $filter
	 * @param string $order
	 * @return doctrine pager
	 */
  public function getPager($page, $per_page, $filter, $order)
	{
		$oPager = new sfDoctrinePager('Investor', $per_page);
		$oPager->getQuery()
					 ->from('Investor i')
					 ->leftJoin('i.RegisteredCompanies e')
					 ->where($filter)
					 ->orderBy($order);
		$oPager->setPage($page);
		$oPager->init();

		return $oPager;
	}  

} // end class