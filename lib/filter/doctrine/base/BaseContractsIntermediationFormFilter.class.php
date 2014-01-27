<?php

/**
 * ContractsIntermediation filter form base class.
 *
 * @package    egauss
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseContractsIntermediationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'year'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'month'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'day'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'customer'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'app_user_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AppUser'), 'add_empty' => true)),
      'observations'     => new sfWidgetFormFilterInput(),
      'business_amount'  => new sfWidgetFormFilterInput(),
      'intermediation'   => new sfWidgetFormFilterInput(),
      'final_commission' => new sfWidgetFormFilterInput(),
      'comments'         => new sfWidgetFormFilterInput(),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'year'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'month'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'day'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'customer'         => new sfValidatorPass(array('required' => false)),
      'app_user_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AppUser'), 'column' => 'id')),
      'observations'     => new sfValidatorPass(array('required' => false)),
      'business_amount'  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'intermediation'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'final_commission' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'comments'         => new sfValidatorPass(array('required' => false)),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('contracts_intermediation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ContractsIntermediation';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'year'             => 'Number',
      'month'            => 'Number',
      'day'              => 'Number',
      'customer'         => 'Text',
      'app_user_id'      => 'ForeignKey',
      'observations'     => 'Text',
      'business_amount'  => 'Number',
      'intermediation'   => 'Number',
      'final_commission' => 'Number',
      'comments'         => 'Text',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
    );
  }
}
