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
        $this->reunion = CalendarTable::getInstance()->getReunionByContract($this->id);
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
            $document_by_company = DocumentsRegisteredCompaniesTable::getInstance()->getDocumentByContrat($id, true);
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
  
  /**
   * comment by contract
   * @param sfWebRequest $request
   */
  public function executeCommentByContract(sfWebRequest $request)
  {
      $this->app_user_id = $this->getUser()->getAttribute('user_id');
      $this->contract_id = $request->getParameter('id');
      $this->comment_id  = $request->getParameter('comment_id', 0);
      $commnet           = Null;
      $this->array_value = [];
      $this->url_document= !$this->id ?'@contracts-register-document':'@contracts-register-document?id='.$this->id;
      if($this->comment_id)
      {
          $commnet = ContractsIntermediationCommentsTable::getInstance()->findOneById($this->comment_id);
      }    
      
      $this->form = new ContractsIntermediationCommentsForm($commnet, array('app_user_id'=>$this->app_user_id, 'contract_id'=>$this->contract_id));
      
      if($request->isMethod('POST'))
      {
          $this->form->bind($request->getParameter($this->form->getName()));
          if($this->form->isValid())
          {
              $form_request = $request->getParameter($this->form->getName());
              $this->contract_id = $form_request['contracts_intermediation_id'];
              # set document
              $temp_document = TempsDocumentsTable::getInstance()->getFindAllByAppUser($this->getUser()->getAttribute('user_id'));
              
              $form_request['comments']==''?'':$recorded = $this->form->save();
              
              if(!empty($temp_document))
              {
                  empty($recorded)?$recorded = $this->form->save():'';
                  foreach ($temp_document AS $v_doc)
                  {
                    $load_doc = NEW DocumentsRegisteredCompanies();
                    $load_doc->setName($v_doc->getName());
                    $load_doc->setIcon($v_doc->getIcon());
                    $load_doc->setDescription($v_doc->getDescription());
                    $load_doc->setDownload($v_doc->getDownload());
                    $load_doc->setUrl($v_doc->getUrl());
                    $load_doc->setContractsIntermediationId($this->contract_id);
                    $load_doc->setCiCommentsId($recorded->getId());
                    $load_doc->save();

                    $v_doc->delete();
                  }
              }
            
            $this->comment_id = 0;  
            $this->form = new ContractsIntermediationCommentsForm(null, array('app_user_id'=>$this->app_user_id, 'contract_id'=>$this->contract_id));  
          }
      }  
      
      $this->comment_all = ContractsIntermediationCommentsTable::getInstance()->getAllByContract($this->contract_id, $this->comment_id );
      
      foreach ($this->comment_all as $v)
      { 
          $this->array_value[$v->getId()]['id']                = $v->getId();
          $this->array_value[$v->getId()]['comment']           = $v->getComments();
          $this->array_value[$v->getId()]['date']              = Common::getFormattedDate($v->getCreatedAt(),'d/m/Y h:i:s');
          $this->array_value[$v->getId()]['app_user']['id']    = $v->getAppUser()->getId();
          $this->array_value[$v->getId()]['app_user']['name']  = $v->getAppUser()->getTitle().' '.$v->getAppUser()->getName().' '.$v->getAppUser()->getLastName();
          $this->array_value[$v->getId()]['app_user']['photo'] = $v->getAppUser()->getPhoto();
      } 
      
  }  
  
  /**
   * get document
   * @param sfWebRequest $request
   */
  public function executeGetDocumentComment(sfWebRequest $request)
  {
        $id_comment            = $this->id_comment;
        $document_by_company   = array();
        $this->result_document = array();
        $temp_document         = array();
        $this->url_d_document  = !$id_comment?'@contracts-delete-document-comment':'@contracts-delete-document-comment?id_comment='.$id_comment;
        if($id_comment){
            $document_by_company = DocumentsRegisteredCompaniesTable::getInstance()->findByCiCommentsId($id_comment);
        }
        $temp_document = TempsDocumentsTable::getInstance()->getFindAllByAppUser($this->getUser()->getAttribute('user_id'));
        
        foreach ($document_by_company as $value)
        {
            $this->result_document[] = array(
                                          'id' => $value->getId(),
                                          'name' => $value->getName(),
                                          'url'  => $value->getUrl(),
                                          'download'=> $value->getDownload(),  
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
                                          'download'=> $value->getDownload(),  
                                          'icon' => $value->getIcon(),
                                          'type' => 'temp'
                                       ); 
        } 
  }
    
  /**
   * get document view
   * @param sfWebRequest $request
   */
  public function executeGetDocumentViewComment(sfWebRequest $request)
  {
        $id                    = $this->id_comment;
        $this->result_document = array();
        $document_by_company   = array();
        $this->url_d_document  = !$id?'@contracts-delete-document-comment':'@contracts-delete-document-comment?id_comment='.$id;
        if($id){
            $document_by_company = DocumentsRegisteredCompaniesTable::getInstance()->findByCiCommentsId($id);
            $contract_comment    = ContractsIntermediationCommentsTable::getInstance()->findOneById($id); 
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
                                          'user' => $contract_comment->getAppUserId()
                                       ); 
        } 
  }
  
  public function executeGetProductByCompany(sfWebRequest $request)
  {
     $id             = $request->getParameter('id');
     
     $this->products_array = $this->getUser()->getAttribute('product_temp', []);
     $cont_temp      = count($this->products_array);  
     
     if($id)
     {
         $products = ProductsContractsIntermediationTable::getInstance()->findByContractsIntermediationId($id);
         $index = $cont_temp;
         foreach($products as $v)
         {
             $this->products_array[$index]['id']         = $v->getId();
             $this->products_array[$index]['name']       = $v->getProducts()->getName().' - ('.$v->getRegisteredCompanies()->getName().')';
             $this->products_array[$index]['percentage'] = $v->getPercentage();
             $this->products_array[$index]['type']       = 'base';
             
             $index++;
         }    
         
     } 
      
     if($this->string_in_company)
     {
         $this->select_products = array(''=>'--Seleccionar--')+ProductRegisteredCompanies::getArrayForSelectByCompany($this->string_in_company); 
     }     
  }        
} // end class