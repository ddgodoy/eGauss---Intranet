<?php

/**
 * Billing filter form base class.
 *
 * @package    egauss
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseBillingFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'year'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'month'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'total_affiliated'     => new sfWidgetFormFilterInput(),
      'sale_of_affiliated'   => new sfWidgetFormFilterInput(),
      'total_consultancy'    => new sfWidgetFormFilterInput(),
      'consultancy'          => new sfWidgetFormFilterInput(),
      'total_intermediation' => new sfWidgetFormFilterInput(),
      'intermediation'       => new sfWidgetFormFilterInput(),
      'total_formation'      => new sfWidgetFormFilterInput(),
      'formation'            => new sfWidgetFormFilterInput(),
      'total_patents'        => new sfWidgetFormFilterInput(),
      'patents'              => new sfWidgetFormFilterInput(),
      'created_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'year'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'month'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'total_affiliated'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'sale_of_affiliated'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'total_consultancy'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'consultancy'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'total_intermediation' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'intermediation'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'total_formation'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'formation'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'total_patents'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'patents'              => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'created_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('billing_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Billing';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'year'                 => 'Number',
      'month'                => 'Number',
      'total_affiliated'     => 'Number',
      'sale_of_affiliated'   => 'Number',
      'total_consultancy'    => 'Number',
      'consultancy'          => 'Number',
      'total_intermediation' => 'Number',
      'intermediation'       => 'Number',
      'total_formation'      => 'Number',
      'formation'            => 'Number',
      'total_patents'        => 'Number',
      'patents'              => 'Number',
      'created_at'           => 'Date',
      'updated_at'           => 'Date',
    );
  }
}
