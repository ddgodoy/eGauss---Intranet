<?php
/**
 * shareholders components.
 *
 * @package    egauss
 * @subpackage shareholders
 * @author     Mauro Garcia
 * @version    SVN: $Id: components.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class shareholdersComponents extends sfComponents
{
    /**
     * get document
     * @param sfWebRequest $request
     */
    public function executeGetDocument(sfWebRequest $request)
    {
        $id                    = $request->getParameter('id');
        $document_by_company   = [];
        $this->result_document = [];
        $temp_document         = [];
        $this->url_d_document  = !$id?'@shareholders-delete-document':'@shareholders-delete-document?id='.$id;
        if($id){
            $document_by_company = DocumentsRegisteredCompaniesTable::getInstance()->findByCalendarId($id);
        }
        $temp_document = TempsDocumentsTable::getInstance()->findAll();
        
        foreach ($document_by_company as $value)
        {
            $this->result_document[] = [
                                          'id' => $value->getId(),
                                          'name' => $value->getName(),
                                          'url'  => $value->getUrl(),
                                          'icon' => $value->getIcon(),
                                          'type' => 'real'
                                       ]; 
        } 
        
        foreach ($temp_document as $value)
        {
            $this->result_document[] = [
                                          'id' => $value->getId(),
                                          'name' => $value->getName(),
                                          'url'  => $value->getUrl(),
                                          'icon' => $value->getIcon(),
                                          'type' => 'temp'
                                       ]; 
        } 
    }
    
    /**
     * get document view
     * @param sfWebRequest $request
     */
    public function executeGetDocumentView(sfWebRequest $request)
    {
        $id                    = $request->getParameter('id');
        $this->result_document = [];
        $document_by_company   = [];
        if($id){
            $document_by_company = DocumentsRegisteredCompaniesTable::getInstance()->findByCalendarId($id);
        }
        
        foreach ($document_by_company as $value)
        {
            $this->result_document[] = [
                                          'id' => $value->getId(),
                                          'name' => $value->getName(),
                                          'url'  => $value->getUrl(),
                                          'icon' => $value->getIcon(),
                                          'type' => 'real'
                                       ]; 
        } 
    }        
}