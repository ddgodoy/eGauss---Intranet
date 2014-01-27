<?php

/**
 * Notifications form base class.
 *
 * @method Notifications getObject() Returns the current form's model object
 *
 * @package    egauss
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseNotificationsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                          => new sfWidgetFormInputHidden(),
      'registered_companies_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RegisteredCompanies'), 'add_empty' => true)),
      'information_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Information'), 'add_empty' => true)),
      'contracts_intermediation_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ContractsIntermediation'), 'add_empty' => true)),
      'app_user_id'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AppUser'), 'add_empty' => true)),
      'type'                        => new sfWidgetFormInputText(),
      'subject'                     => new sfWidgetFormInputText(),
      'important'                   => new sfWidgetFormInputCheckbox(),
      'created_at'                  => new sfWidgetFormDateTime(),
      'updated_at'                  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'registered_companies_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RegisteredCompanies'), 'required' => false)),
      'information_id'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Information'), 'required' => false)),
      'contracts_intermediation_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ContractsIntermediation'), 'required' => false)),
      'app_user_id'                 => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AppUser'), 'required' => false)),
      'type'                        => new sfValidatorString(array('max_length' => 50)),
      'subject'                     => new sfValidatorPass(array('required' => false)),
      'important'                   => new sfValidatorBoolean(array('required' => false)),
      'created_at'                  => new sfValidatorDateTime(),
      'updated_at'                  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('notifications[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Notifications';
  }

}
