<?php

/**
 * Calendar filter form base class.
 *
 * @package    egauss
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCalendarFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'app_user_id'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AppUser'), 'add_empty' => true)),
      'year'                        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'month'                       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'day'                         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'hour_from'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'hour_to'                     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'subject'                     => new sfWidgetFormFilterInput(),
      'body'                        => new sfWidgetFormFilterInput(),
      'type_calendar_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TypeCalendar'), 'add_empty' => true)),
      'registered_companies_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RegisteredCompanies'), 'add_empty' => true)),
      'next'                        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'contracts_intermediation_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ContractsIntermediation'), 'add_empty' => true)),
      'created_at'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'app_user_id'                 => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AppUser'), 'column' => 'id')),
      'year'                        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'month'                       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'day'                         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'hour_from'                   => new sfValidatorPass(array('required' => false)),
      'hour_to'                     => new sfValidatorPass(array('required' => false)),
      'subject'                     => new sfValidatorPass(array('required' => false)),
      'body'                        => new sfValidatorPass(array('required' => false)),
      'type_calendar_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TypeCalendar'), 'column' => 'id')),
      'registered_companies_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('RegisteredCompanies'), 'column' => 'id')),
      'next'                        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'contracts_intermediation_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ContractsIntermediation'), 'column' => 'id')),
      'created_at'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('calendar_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Calendar';
  }

  public function getFields()
  {
    return array(
      'id'                          => 'Number',
      'app_user_id'                 => 'ForeignKey',
      'year'                        => 'Number',
      'month'                       => 'Number',
      'day'                         => 'Number',
      'hour_from'                   => 'Text',
      'hour_to'                     => 'Text',
      'subject'                     => 'Text',
      'body'                        => 'Text',
      'type_calendar_id'            => 'ForeignKey',
      'registered_companies_id'     => 'ForeignKey',
      'next'                        => 'Boolean',
      'contracts_intermediation_id' => 'ForeignKey',
      'created_at'                  => 'Date',
      'updated_at'                  => 'Date',
    );
  }
}
