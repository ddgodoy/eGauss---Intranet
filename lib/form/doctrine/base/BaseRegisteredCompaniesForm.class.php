<?php

/**
 * RegisteredCompanies form base class.
 *
 * @method RegisteredCompanies getObject() Returns the current form's model object
 *
 * @package    egauss
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRegisteredCompaniesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'date'               => new sfWidgetFormInputText(),
      'name'               => new sfWidgetFormInputText(),
      'description'        => new sfWidgetFormInputText(),
      'website'            => new sfWidgetFormInputText(),
      'email'              => new sfWidgetFormInputText(),
      'address'            => new sfWidgetFormInputText(),
      'phone'              => new sfWidgetFormInputText(),
      'skype'              => new sfWidgetFormInputText(),
      'logo'               => new sfWidgetFormInputText(),
      'code'               => new sfWidgetFormInputText(),
      'contact_first_name' => new sfWidgetFormInputText(),
      'contact_last_name'  => new sfWidgetFormInputText(),
      'contact_phone'      => new sfWidgetFormInputText(),
      'contact_email'      => new sfWidgetFormInputText(),
      'type_companies_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TypeCompanies'), 'add_empty' => false)),
      'comments'           => new sfWidgetFormInputText(),
      'basecamp_id'        => new sfWidgetFormInputText(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'date'               => new sfValidatorPass(array('required' => false)),
      'name'               => new sfValidatorString(array('max_length' => 50)),
      'description'        => new sfValidatorPass(array('required' => false)),
      'website'            => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'email'              => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'address'            => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'phone'              => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'skype'              => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'logo'               => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'code'               => new sfValidatorString(array('max_length' => 150)),
      'contact_first_name' => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'contact_last_name'  => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'contact_phone'      => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'contact_email'      => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'type_companies_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TypeCompanies'))),
      'comments'           => new sfValidatorPass(array('required' => false)),
      'basecamp_id'        => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'created_at'         => new sfValidatorDateTime(),
      'updated_at'         => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('registered_companies[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RegisteredCompanies';
  }

}
