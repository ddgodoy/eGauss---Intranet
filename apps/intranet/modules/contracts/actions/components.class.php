<?php
/**
 * contracts components.
 *
 * @package    egauss
 * @subpackage contracts
 * @author     Mauro Garcia
 * @version    SVN: $Id: components.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class contractsComponents extends sfComponents
{
  public function executeGetContractsByMonth(sfWebRequest $request)
  {
    $this->contracts = ContractsIntermediationTable::getInstance()->findByYear(date('Y'));
  }
  
  public function executeGetRankingSocios(sfWebRequest $request)
  {
    $this->rSocios = ContractsIntermediationTable::getInstance()->getSumatoriaSocios(date('Y'));
  }

} // end class