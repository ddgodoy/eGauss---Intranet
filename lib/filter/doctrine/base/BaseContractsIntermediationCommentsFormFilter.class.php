<?php

/**
 * ContractsIntermediationComments filter form base class.
 *
 * @package    egauss
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseContractsIntermediationCommentsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'comments'                    => new sfWidgetFormFilterInput(),
      'contracts_intermediation_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ContractsIntermediation'), 'add_empty' => true)),
      'app_user_id'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AppUser'), 'add_empty' => true)),
      'created_at'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'comments'                    => new sfValidatorPass(array('required' => false)),
      'contracts_intermediation_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ContractsIntermediation'), 'column' => 'id')),
      'app_user_id'                 => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AppUser'), 'column' => 'id')),
      'created_at'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('contracts_intermediation_comments_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ContractsIntermediationComments';
  }

  public function getFields()
  {
    return array(
      'id'                          => 'Number',
      'comments'                    => 'Text',
      'contracts_intermediation_id' => 'ForeignKey',
      'app_user_id'                 => 'ForeignKey',
      'created_at'                  => 'Date',
      'updated_at'                  => 'Date',
    );
  }
}
