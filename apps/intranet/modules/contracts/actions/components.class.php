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
  /**
   * Get Contracts By Month
   * @param sfWebRequest $request
   */
  public function executeGetContractsByMonth(sfWebRequest $request)
  {
    $this->contracts = ContractsIntermediationTable::getInstance()->findByYear(date('Y'));
    $this->rSocios   = ContractsIntermediationTable::getInstance()->getSumatoriaSocios(date('Y'));
  }
  
  /**
   * Get Ranking Socios
   * @param sfWebRequest $request
   */
  public function executeGetRankingSocios(sfWebRequest $request)
  {
    $this->rSocios = ContractsIntermediationTable::getInstance()->getSumatoriaSocios(date('Y'));
  }

  /**
   * get reunion by contract
   * @param sfWebRequest $request
   */
  public function executeGetReunionByContract(sfWebRequest $request)
  {
      $this->id   = $request->getParameter('id');
      $this->reunion = ReunionContractsIntermediationTable::getInstance()->getReunionByContract($this->id);
  }        
} // end class