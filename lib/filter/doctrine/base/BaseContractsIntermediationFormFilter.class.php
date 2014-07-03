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
      'name'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'year'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'month'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'day'                     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'customer_name'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'customer_company'        => new sfWidgetFormFilterInput(),
      'customer_workstation'    => new sfWidgetFormFilterInput(),
      'customer_email'          => new sfWidgetFormFilterInput(),
      'customer_phone'          => new sfWidgetFormFilterInput(),
      'company_name'            => new sfWidgetFormFilterInput(),
      'company_contact'         => new sfWidgetFormFilterInput(),
      'company_email'           => new sfWidgetFormFilterInput(),
      'company_phone'           => new sfWidgetFormFilterInput(),
      'app_user_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AppUser'), 'add_empty' => true)),
      'observations'            => new sfWidgetFormFilterInput(),
      'business_amount'         => new sfWidgetFormFilterInput(),
      'intermediation'          => new sfWidgetFormFilterInput(),
      'final_commission'        => new sfWidgetFormFilterInput(),
      'comments'                => new sfWidgetFormFilterInput(),
      'registered_companies_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RegisteredCompanies'), 'add_empty' => true)),
      'cashed'                  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_new'                  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'name'                    => new sfValidatorPass(array('required' => false)),
      'year'                    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'month'                   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'day'                     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'customer_name'           => new sfValidatorPass(array('required' => false)),
      'customer_company'        => new sfValidatorPass(array('required' => false)),
      'customer_workstation'    => new sfValidatorPass(array('required' => false)),
      'customer_email'          => new sfValidatorPass(array('required' => false)),
      'customer_phone'          => new sfValidatorPass(array('required' => false)),
      'company_name'            => new sfValidatorPass(array('required' => false)),
      'company_contact'         => new sfValidatorPass(array('required' => false)),
      'company_email'           => new sfValidatorPass(array('required' => false)),
      'company_phone'           => new sfValidatorPass(array('required' => false)),
      'app_user_id'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AppUser'), 'column' => 'id')),
      'observations'            => new sfValidatorPass(array('required' => false)),
      'business_amount'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'intermediation'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'final_commission'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'comments'                => new sfValidatorPass(array('required' => false)),
      'registered_companies_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('RegisteredCompanies'), 'column' => 'id')),
      'cashed'                  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_new'                  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
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
      'id'                      => 'Number',
      'name'                    => 'Text',
      'year'                    => 'Number',
      'month'                   => 'Number',
      'day'                     => 'Number',
      'customer_name'           => 'Text',
      'customer_company'        => 'Text',
      'customer_workstation'    => 'Text',
      'customer_email'          => 'Text',
      'customer_phone'          => 'Text',
      'company_name'            => 'Text',
      'company_contact'         => 'Text',
      'company_email'           => 'Text',
      'company_phone'           => 'Text',
      'app_user_id'             => 'ForeignKey',
      'observations'            => 'Text',
      'business_amount'         => 'Number',
      'intermediation'          => 'Number',
      'final_commission'        => 'Number',
      'comments'                => 'Text',
      'registered_companies_id' => 'ForeignKey',
      'cashed'                  => 'Boolean',
      'is_new'                  => 'Boolean',
      'created_at'              => 'Date',
      'updated_at'              => 'Date',
    );
  }
}
