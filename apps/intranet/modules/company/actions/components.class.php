<?php
/**
 * company components.
 *
 * @package    egauss
 * @subpackage company
 * @author     Mauro Garcia
 * @version    SVN: $Id: components.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class companyComponents extends sfComponents
{
    /**
     * get videos
     * @param sfWebRequest $request
     */
    public function executeGetVideos(sfWebRequest $request)
    {
        $id                       = $request->getParameter('id');
        $videos_by_company        = array();
        $this->url_d_videos       = !$id?'@company-delete-video':'@company-delete-video?id='.$id;
        if($id){
            $videos_by_company = VideosRegisteredCompaniesTable::getInstance()->findByRegisteredCompaniesId($id);
        }
        $this->array_videos = $this->getUser()->getAttribute('videos', array());
        
        if(count($videos_by_company))
        {
            foreach ($videos_by_company as $value)
            {
                $this->array_videos[]= array(
                                        'id'   => $value->getId(), 
                                        'name' => $value->getName(), 
                                        'url'  => $value->getUrl(),
                                        'type' => 'real'
                                       );
            }    
        }
        
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
        $this->url_d_document  = !$id?'@company-delete-document':'@company-delete-document?id='.$id;
        if($id){
            $document_by_company = DocumentsRegisteredCompaniesTable::getInstance()->findByRegisteredCompaniesId($id);
        }
        $temp_document = TempsDocumentsTable::getInstance()->getFindAllByAppUser();
        
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
            $document_by_company = DocumentsRegisteredCompaniesTable::getInstance()->findByRegisteredCompaniesId($id);
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
    
    /**
     * get videos
     * @param sfWebRequest $request
     */
    public function executeGetVideosView(sfWebRequest $request)
    {
        $id                       = $request->getParameter('id');
        $videos_by_company        = array();
        $this->array_videos       = array();
        if($id){
            $videos_by_company = VideosRegisteredCompaniesTable::getInstance()->findByRegisteredCompaniesId($id);
        }
        
        if(count($videos_by_company))
        {
            foreach ($videos_by_company as $value)
            {
                $this->array_videos[]= array(
                                        'id'   => $value->getId(), 
                                        'name' => $value->getName(), 
                                        'url'  => $value->getUrl(),
                                        'type' => 'real'
                                       );
            }    
        }
        
    }     
}