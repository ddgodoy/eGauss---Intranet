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
  
  /**
   * get document
   * @param sfWebRequest $request
   */
  public function executeGetDocument(sfWebRequest $request)
  {
        $id                    = $request->getParameter('id');
        $document_by_company   = array();
        $this->result_document = array();
        $temp_document         = array();
        $this->url_d_document  = !$id?'@contracts-delete-document':'@contracts-delete-document?id='.$id;
        if($id){
            $document_by_company = DocumentsRegisteredCompaniesTable::getInstance()->findByContractsIntermediationId($id);
        }
        $temp_document = TempsDocumentsTable::getInstance()->findAll();
        
        foreach ($document_by_company as $value)
        {
            $this->result_document[] = array(
                                          'id' => $value->getId(),
                                          'name' => $value->getName(),
                                          'url'  => $value->getUrl(),
                                          'icon' => $value->getIcon(),
                                          'type' => 'real'
                                       ); 
        } 
        
        foreach ($temp_document as $value)
        {
            $this->result_document[] = array(
                                          'id' => $value->getId(),
                                          'name' => $value->getName(),
                                          'url'  => $value->getUrl(),
                                          'icon' => $value->getIcon(),
                                          'type' => 'temp'
                                       ); 
        } 
  }
    
  /**
   * get document view
   * @param sfWebRequest $request
   */
  public function executeGetDocumentView(sfWebRequest $request)
  {
        $id                    = $request->getParameter('id');
        $this->result_document = array();
        $document_by_company   = array();
        if($id){
            $document_by_company = DocumentsRegisteredCompaniesTable::getInstance()->findByContractsIntermediationId($id);
        }
        
        foreach ($document_by_company as $value)
        {
            $this->result_document[] = array(
                                          'id' => $value->getId(),
                                          'name' => $value->getName(),
                                          'url'  => $value->getUrl(),
                                          'download'=> $value->getDownload(),  
                                          'icon' => $value->getIcon(),
                                          'type' => 'real',
                                          'date' => $value->getCreatedAt(),
                                       ); 
        } 
  }
} // end class