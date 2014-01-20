<?php

/**
 * home actions.
 *
 * @package    sf_icox
 * @subpackage home
 * @author     pinika
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class homeActions extends sfActions
{
   /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
    public function executeIndex(sfWebRequest $request)
    {
        $this->getUser()->setCulture('es');

        $this->shareholders = CalendarTable::getInstance()->findOneByNextAndTypeCalendarId(1,2);
        $this->infomation   = InformationTable::getInstance()->getInformation();
        $this->notification = NotificationsTable::getInstance()->getNotifications($this->getUser()->getAttribute('user_id'));
        $this->calendar     = CalendarTable::getInstance()->getCalendarByUserAndDate($this->getUser()->getAttribute('user_id'), date('Y'), date('m'), date('d'));
    }
    
   /**
    * Executes logout action
    *
    * @param sfWebRequest $request
    */
   public function executeLogout(sfWebRequest $request)
   {  	
         ServiceAuthentication::closeSessionProcess();

         $this->redirect('@homepage');
   }
   
}
?>
