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
         $this->month        = [''=>'-- seleccionar --']+
                              [ 01=>'Enero',
                                02=>'Febrero',
                                03=>'Marzo',
                                04=>'Abril',
                                05=>'Mayo',
                                06=>'Junio',
                                07=>'julio',
                                08=>'Agosto',
                                09=>'Septiembre',
                                10=>'Octubre',
                                11=>'Noviembre',
                                12=>'Diciembre']; 
        
         $this->array_year = [''=>'-- seleccionar --'];
         
         $billing_all = BillingTable::getInstance()->findAll();
         
         foreach ($billing_all as $value) {
             $this->array_year[$value->getYear()] = $value->getYear();
         }
         
         $this->billing = BillingTable::getInstance()->findOneByMonthAndYear(date('m'), date('Y'));
    }        
}
?>
