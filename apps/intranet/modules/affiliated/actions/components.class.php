<?php
/**
 * affiliated components.
 *
 * @package    egauss
 * @subpackage affiliated
 * @author     Mauro Garcia
 * @version    SVN: $Id: components.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class affiliatedComponents extends sfComponents
{
    /**
     * get videos
     * @param sfWebRequest $request
     */
    public function executeGetVideos(sfWebRequest $request)
    {
        $id                       = $request->getParameter('id');
        $videos_by_company        = array();
        $this->url_d_videos       = !$id?'@affiliated-delete-video':'@affiliated-delete-video?id='.$id;
        if($id){
            $videos_by_company = VideosRegisteredCompaniesTable::getInstance()->getVideoByCompany($id);
        }
        $this->array_videos = $this->getUser()->getAttribute('videos', array());
        
        if(count($videos_by_company))
        {
            foreach ($videos_by_company as $value)
            {
                $this->array_videos[]=[
                                        'id'   => $value->getId(), 
                                        'name' => $value->getName(), 
                                        'url'  => $value->getUrl(),
                                        'type' => 'real'
                                       ];
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
        $document_by_company   = [];
        $this->result_document = [];
        $temp_document         = [];
        $this->url_d_document  = !$id?'@affiliated-delete-document':'@affiliated-delete-document?id='.$id;
        if($id){
            $document_by_company = DocumentsRegisteredCompaniesTable::getInstance()->getDocumentsByCompany($id);
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
            $document_by_company = DocumentsRegisteredCompaniesTable::getInstance()->findByRegisteredCompaniesId($id);
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
    
    /**
     * get videos
     * @param sfWebRequest $request
     */
    public function executeGetVideosView(sfWebRequest $request)
    {
        $id                       = $request->getParameter('id');
        $videos_by_company        = [];
        $this->array_videos       = [];
        if($id){
            $videos_by_company = VideosRegisteredCompaniesTable::getInstance()->findByRegisteredCompaniesId($id);
        }
        
        if(count($videos_by_company))
        {
            foreach ($videos_by_company as $value)
            {
                $this->array_videos[]=[
                                        'id'   => $value->getId(), 
                                        'name' => $value->getName(), 
                                        'url'  => $value->getUrl(),
                                        'type' => 'real'
                                       ];
            }    
        }
        
    }
    
    /**
     * get sfWebRequest $request
     * @param sfWebRequest $request
     */
    public function executeGetAffiliated(sfWebRequest $request)
    {
        $this->array_new_affiliated = [];
        
        $this->array_new_affiliated = RegisteredCompaniesTable::getInstance()->getAffiliated();
        
    }        
}