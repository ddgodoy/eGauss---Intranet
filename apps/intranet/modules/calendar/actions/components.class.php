<?php
/**
 * calendar components.
 *
 * @package    liprandi
 * @subpackage calendar
 * @author     Mauro Garcia
 * @version    SVN: $Id: components.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class calendarComponents extends sfComponents
{
	public function executeCalendar(sfWebRequest $request)
	{
		## For calendar
		$this->arrayShows = array();
		$this->calendar_list_array = array();
                $this->sch_year = trim($this->getRequestParameter('sch_year'));
                $this->sch_month = trim($this->getRequestParameter('sch_month'));
                $this->sch_day = trim($this->getRequestParameter('sch_day'));
                
                
		$usurID      = $this->getUser()->getAttribute('userId');	
		$this->year  = $this->getRequestParameter('y', date('Y'));
		$this->month = $this->getRequestParameter('m', date('m'));
                
                $calendar = CalendarTable::getInstance()->findByAppUserIdAndYearAndMonth($this->getUser()->getAttribute('user_id'), $this->year, $this->month);
                
                foreach ($calendar AS $v)
                {
                  $this->calendar_list_array[$v->day] = $v->getSubject();  
                }    
	    
	}
}