<?php

/**
 * RegisteredCompanies filter form base class.
 *
 * @package    egauss
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRegisteredCompaniesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'date'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'name'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'        => new sfWidgetFormFilterInput(),
      'website'            => new sfWidgetFormFilterInput(),
      'email'              => new sfWidgetFormFilterInput(),
      'address'            => new sfWidgetFormFilterInput(),
      'phone'              => new sfWidgetFormFilterInput(),
      'skype'              => new sfWidgetFormFilterInput(),
      'logo'               => new sfWidgetFormFilterInput(),
      'code'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'contact_first_name' => new sfWidgetFormFilterInput(),
      'contact_last_name'  => new sfWidgetFormFilterInput(),
      'contact_phone'      => new sfWidgetFormFilterInput(),
      'contact_email'      => new sfWidgetFormFilterInput(),
      'type_companies_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TypeCompanies'), 'add_empty' => true)),
      'comments'           => new sfWidgetFormFilterInput(),
      'basecamp_id'        => new sfWidgetFormFilterInput(),
      'code_name'          => new sfWidgetFormFilterInput(),
      'created_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'date'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'name'               => new sfValidatorPass(array('required' => false)),
      'description'        => new sfValidatorPass(array('required' => false)),
      'website'            => new sfValidatorPass(array('required' => false)),
      'email'              => new sfValidatorPass(array('required' => false)),
      'address'            => new sfValidatorPass(array('required' => false)),
      'phone'              => new sfValidatorPass(array('required' => false)),
      'skype'              => new sfValidatorPass(array('required' => false)),
      'logo'               => new sfValidatorPass(array('required' => false)),
      'code'               => new sfValidatorPass(array('required' => false)),
      'contact_first_name' => new sfValidatorPass(array('required' => false)),
      'contact_last_name'  => new sfValidatorPass(array('required' => false)),
      'contact_phone'      => new sfValidatorPass(array('required' => false)),
      'contact_email'      => new sfValidatorPass(array('required' => false)),
      'type_companies_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TypeCompanies'), 'column' => 'id')),
      'comments'           => new sfValidatorPass(array('required' => false)),
      'basecamp_id'        => new sfValidatorPass(array('required' => false)),
      'code_name'          => new sfValidatorPass(array('required' => false)),
      'created_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('registered_companies_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RegisteredCompanies';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'date'               => 'Date',
      'name'               => 'Text',
      'description'        => 'Text',
      'website'            => 'Text',
      'email'              => 'Text',
      'address'            => 'Text',
      'phone'              => 'Text',
      'skype'              => 'Text',
      'logo'               => 'Text',
      'code'               => 'Text',
      'contact_first_name' => 'Text',
      'contact_last_name'  => 'Text',
      'contact_phone'      => 'Text',
      'contact_email'      => 'Text',
      'type_companies_id'  => 'ForeignKey',
      'comments'           => 'Text',
      'basecamp_id'        => 'Text',
      'code_name'          => 'Text',
      'created_at'         => 'Date',
      'updated_at'         => 'Date',
    );
  }
}
