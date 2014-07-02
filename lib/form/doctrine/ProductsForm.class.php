<?php

/**
 * Products form.
 *
 * @package    egauss
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProductsForm extends BaseProductsForm
{
  public function configure()
  {
    $i18N       = sfContext::getInstance()->getI18N();   
    $company    = RegisteredCompanies::getArrayByType(['1','3']);  
    $id         = $this->getObject()->getId();
    $associated = array();
    
    if($id)
    {
       $associated = ProductRegisteredCompaniesTable::getInstance()->getAllForSelectCompanyAssociated($id); 
    }    
      
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormInputText(array(), array('class'=>'form_input no_letters', 'style'=>'width:265px;')),
      'description' => new sfWidgetFormTextareaTinyMCE(array(),array('style' => 'width:930px;  height: 450px;', 'rows' => 10, 'class' => 'foo')),
      'company'     => new sfWidgetFormChoice(array('choices'=> $company,'renderer_class' => 'sfWidgetFormSelectDoubleList','renderer_options'=>array('associated_first'=>FALSE,'associated_choices' => $associated, 'label_unassociated'=>$i18N->__('Unassociated'), 'label_associated'=>$i18N->__('Associated'))))    
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 50)),
      'description' => new sfValidatorPass(array('required' => false)),
      'company'     => new sfValidatorChoice(array('choices' => array_keys($company), 'multiple' => true, 'required'=>FALSE ))    
    ));

    $this->widgetSchema->setNameFormat('product[%s]');
  }
}
