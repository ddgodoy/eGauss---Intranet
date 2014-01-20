<?php

/**
 * AppUser filter form base class.
 *
 * @package    egauss
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAppUserFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'              => new sfWidgetFormFilterInput(),
      'last_name'         => new sfWidgetFormFilterInput(),
      'email'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'phone'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'skype'             => new sfWidgetFormFilterInput(),
      'contact_time_from' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'contact_time_to'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'photo'             => new sfWidgetFormFilterInput(),
      'salt'              => new sfWidgetFormFilterInput(),
      'password'          => new sfWidgetFormFilterInput(),
      'recover_token'     => new sfWidgetFormFilterInput(),
      'enabled'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'last_access'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'company_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Company'), 'add_empty' => true)),
      'user_role_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserRole'), 'add_empty' => true)),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'name'              => new sfValidatorPass(array('required' => false)),
      'last_name'         => new sfValidatorPass(array('required' => false)),
      'email'             => new sfValidatorPass(array('required' => false)),
      'phone'             => new sfValidatorPass(array('required' => false)),
      'skype'             => new sfValidatorPass(array('required' => false)),
      'contact_time_from' => new sfValidatorPass(array('required' => false)),
      'contact_time_to'   => new sfValidatorPass(array('required' => false)),
      'photo'             => new sfValidatorPass(array('required' => false)),
      'salt'              => new sfValidatorPass(array('required' => false)),
      'password'          => new sfValidatorPass(array('required' => false)),
      'recover_token'     => new sfValidatorPass(array('required' => false)),
      'enabled'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'last_access'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'company_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Company'), 'column' => 'id')),
      'user_role_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UserRole'), 'column' => 'id')),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('app_user_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AppUser';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'name'              => 'Text',
      'last_name'         => 'Text',
      'email'             => 'Text',
      'phone'             => 'Text',
      'skype'             => 'Text',
      'contact_time_from' => 'Text',
      'contact_time_to'   => 'Text',
      'photo'             => 'Text',
      'salt'              => 'Text',
      'password'          => 'Text',
      'recover_token'     => 'Text',
      'enabled'           => 'Boolean',
      'last_access'       => 'Date',
      'company_id'        => 'ForeignKey',
      'user_role_id'      => 'ForeignKey',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
    );
  }
}
