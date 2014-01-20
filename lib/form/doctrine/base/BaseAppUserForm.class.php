<?php

/**
 * AppUser form base class.
 *
 * @method AppUser getObject() Returns the current form's model object
 *
 * @package    egauss
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAppUserForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'name'              => new sfWidgetFormInputText(),
      'last_name'         => new sfWidgetFormInputText(),
      'email'             => new sfWidgetFormInputText(),
      'phone'             => new sfWidgetFormInputText(),
      'skype'             => new sfWidgetFormInputText(),
      'contact_time_from' => new sfWidgetFormInputText(),
      'contact_time_to'   => new sfWidgetFormInputText(),
      'photo'             => new sfWidgetFormInputText(),
      'salt'              => new sfWidgetFormInputText(),
      'password'          => new sfWidgetFormInputText(),
      'recover_token'     => new sfWidgetFormInputText(),
      'enabled'           => new sfWidgetFormInputCheckbox(),
      'last_access'       => new sfWidgetFormInputText(),
      'company_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Company'), 'add_empty' => false)),
      'user_role_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserRole'), 'add_empty' => false)),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'              => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'last_name'         => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'email'             => new sfValidatorString(array('max_length' => 200)),
      'phone'             => new sfValidatorString(array('max_length' => 50)),
      'skype'             => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'contact_time_from' => new sfValidatorString(array('max_length' => 50)),
      'contact_time_to'   => new sfValidatorString(array('max_length' => 50)),
      'photo'             => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'salt'              => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'password'          => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'recover_token'     => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'enabled'           => new sfValidatorBoolean(array('required' => false)),
      'last_access'       => new sfValidatorPass(array('required' => false)),
      'company_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Company'))),
      'user_role_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UserRole'))),
      'created_at'        => new sfValidatorDateTime(),
      'updated_at'        => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('app_user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AppUser';
  }

}
