<?php

/**
 * RegisteredCompanies form.
 *
 * @package    egauss
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RegisteredCompaniesForm extends BaseRegisteredCompaniesForm
{
  public function configure()
  {
    $i18N = sfContext::getInstance()->getI18N(); 
    $contact    = AppUserTable::getInstance()->getAllForSelectContact();
    $id         = $this->getObject()->getId();
    $associated = array();
    if($id)
    {    
        $associated = AppUserRegisteredCompaniesTable::getInstance()->getAllForSelectContactAssociated($id);
    }  
    
    if($this->getOption('module')== 'affiliated'){
       $required_contacts = $i18N->__('Enter the contact', NULL, 'errors');
    }else{
       $required_contacts = FALSE;
    }
   
    
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'date'               => new sfWidgetFormJQueryDate(array('image'=>'/images/calendario.gif','date_widget' => new sfWidgetFormDate(array('format' => '%day% %month% %year%')))),
      'name'               => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'description'        => new sfWidgetFormTextareaTinyMCE(array(),array('style' => 'width:930px;  height: 450px;', 'rows' => 10, 'class' => 'foo')),
      'email'              => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'address'            => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'phone'              => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'skype'              => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'contact_first_name' => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'contact_last_name'  => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'contact_phone'      => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'contact_email'      => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'type_companies_id'  => new sfWidgetFormInputHidden(),
      'comments'           => new sfWidgetFormTextareaTinyMCE(array('config' => 'theme_advanced_buttons1 : "cut, copy, paste, images, bold, italic, underline, justifyleft, justifycenter, justifyright , outdent, indent, bullist, numlist, undo, redo, link",theme_advanced_buttons2 : "",theme_advanced_buttons3 : ""'),array('style' => 'width:900px;  height: 150px;', 'rows' => 10, 'class' => 'foo')),
      'contacts'           => new sfWidgetFormChoice(array('choices'=> $contact,'renderer_class'  => 'sfWidgetFormSelectDoubleList','renderer_options'=>array('associated_first'=>FALSE,'associated_choices' => $associated, 'label_unassociated'=>$i18N->__('Unassociated'), 'label_associated'=>$i18N->__('Associated'))))  
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'date'               => new sfValidatorDate(array('required' => true), array('required' => 'La fecha es obligatoria', 'invalid' => 'La fecha ingresada es incorrecta')),
      'name'               => new sfValidatorString(array('max_length' => 50), array('required'=>$i18N->__('Enter the name', NULL, 'errors'))),
      'description'        => new sfValidatorPass(array('required' => false)),
      'email'              => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'address'            => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'phone'              => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'skype'              => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'contact_first_name' => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'contact_last_name'  => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'contact_phone'      => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'contact_email'      => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'type_companies_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TypeCompanies'))),
      'comments'           => new sfValidatorPass(array('required' => false)),
      'contacts'           => new sfValidatorChoice(array('choices' => array_keys($contact), 'multiple' => true, 'required'=>$required_contacts ),array('required'=>$required_contacts))  
    ));
    
    if($this->getOption('module')== 'affiliated'){
       $this->setDefault('type_companies_id', 1); 
    }else{
       $this->setDefault('type_companies_id', 2); 
    }

    $this->widgetSchema->setNameFormat('registered_companies[%s]');
  }
}
