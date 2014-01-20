<?php

/**
 * DocumentsRegisteredCompanies filter form base class.
 *
 * @package    egauss
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDocumentsRegisteredCompaniesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'icon'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'url'                     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'registered_companies_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RegisteredCompanies'), 'add_empty' => true)),
      'information_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Information'), 'add_empty' => true)),
      'type_information_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TypeInformation'), 'add_empty' => true)),
      'calendar_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Calendar'), 'add_empty' => true)),
      'created_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'name'                    => new sfValidatorPass(array('required' => false)),
      'icon'                    => new sfValidatorPass(array('required' => false)),
      'url'                     => new sfValidatorPass(array('required' => false)),
      'registered_companies_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('RegisteredCompanies'), 'column' => 'id')),
      'information_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Information'), 'column' => 'id')),
      'type_information_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TypeInformation'), 'column' => 'id')),
      'calendar_id'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Calendar'), 'column' => 'id')),
      'created_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('documents_registered_companies_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DocumentsRegisteredCompanies';
  }

  public function getFields()
  {
    return array(
      'id'                      => 'Number',
      'name'                    => 'Text',
      'icon'                    => 'Text',
      'url'                     => 'Text',
      'registered_companies_id' => 'ForeignKey',
      'information_id'          => 'ForeignKey',
      'type_information_id'     => 'ForeignKey',
      'calendar_id'             => 'ForeignKey',
      'created_at'              => 'Date',
      'updated_at'              => 'Date',
    );
  }
}
