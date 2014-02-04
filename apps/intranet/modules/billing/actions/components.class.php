<?php
/**
 * billing components.
 *
 * @package    egauss
 * @subpackage billing
 * @author     Mauro Garcia
 * @version    SVN: $Id: components.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class billingComponents extends sfComponents
{
    public function executeGetBillingByMonth(sfWebRequest $request)
    {
         $this->month        = array(1=>'Enero',
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
        
         $this->array_year = array('-- Seleccionar --');
         
         $billing_all = BillingTable::getInstance()->findAll();
         
         foreach ($billing_all as $value) {
             $this->array_year[$value->getYear()] = $value->getYear();
         }
         
         $this->billing = BillingTable::getInstance()->findOneByMonthAndYear(date('m'), date('Y'));
    }        
}
?>