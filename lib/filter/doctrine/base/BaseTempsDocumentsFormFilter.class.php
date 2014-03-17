<?php

/**
 * TempsDocuments filter form base class.
 *
 * @package    egauss
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTempsDocumentsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'         => new sfWidgetFormFilterInput(),
      'icon'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'url'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'download'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'type_information_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TypeInformation'), 'add_empty' => true)),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'name'                => new sfValidatorPass(array('required' => false)),
      'description'         => new sfValidatorPass(array('required' => false)),
      'icon'                => new sfValidatorPass(array('required' => false)),
      'url'                 => new sfValidatorPass(array('required' => false)),
      'download'            => new sfValidatorPass(array('required' => false)),
      'type_information_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TypeInformation'), 'column' => 'id')),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('temps_documents_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TempsDocuments';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'name'                => 'Text',
      'description'         => 'Text',
      'icon'                => 'Text',
      'url'                 => 'Text',
      'download'            => 'Text',
      'type_information_id' => 'ForeignKey',
      'created_at'          => 'Date',
      'updated_at'          => 'Date',
    );
  }
}
