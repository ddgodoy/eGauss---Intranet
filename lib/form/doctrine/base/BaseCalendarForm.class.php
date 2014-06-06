<?php

/**
 * Calendar form base class.
 *
 * @method Calendar getObject() Returns the current form's model object
 *
 * @package    egauss
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCalendarForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                          => new sfWidgetFormInputHidden(),
      'app_user_id'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AppUser'), 'add_empty' => false)),
      'year'                        => new sfWidgetFormInputText(),
      'month'                       => new sfWidgetFormInputText(),
      'day'                         => new sfWidgetFormInputText(),
      'hour_from'                   => new sfWidgetFormInputText(),
      'hour_to'                     => new sfWidgetFormInputText(),
      'subject'                     => new sfWidgetFormInputText(),
      'body'                        => new sfWidgetFormInputText(),
      'type_calendar_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TypeCalendar'), 'add_empty' => false)),
      'registered_companies_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RegisteredCompanies'), 'add_empty' => true)),
      'next'                        => new sfWidgetFormInputCheckbox(),
      'contracts_intermediation_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ContractsIntermediation'), 'add_empty' => true)),
      'created_at'                  => new sfWidgetFormDateTime(),
      'updated_at'                  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'app_user_id'                 => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AppUser'))),
      'year'                        => new sfValidatorInteger(),
      'month'                       => new sfValidatorInteger(),
      'day'                         => new sfValidatorInteger(),
      'hour_from'                   => new sfValidatorString(array('max_length' => 50)),
      'hour_to'                     => new sfValidatorString(array('max_length' => 50)),
      'subject'                     => new sfValidatorPass(array('required' => false)),
      'body'                        => new sfValidatorPass(array('required' => false)),
      'type_calendar_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TypeCalendar'))),
      'registered_companies_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RegisteredCompanies'), 'required' => false)),
      'next'                        => new sfValidatorBoolean(array('required' => false)),
      'contracts_intermediation_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ContractsIntermediation'), 'required' => false)),
      'created_at'                  => new sfValidatorDateTime(),
      'updated_at'                  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('calendar[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Calendar';
  }

}
