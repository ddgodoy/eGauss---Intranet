<?php

/**
 * Billing form base class.
 *
 * @method Billing getObject() Returns the current form's model object
 *
 * @package    egauss
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseBillingForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'year'                 => new sfWidgetFormInputText(),
      'month'                => new sfWidgetFormInputText(),
      'total_affiliated'     => new sfWidgetFormInputText(),
      'sale_of_affiliated'   => new sfWidgetFormInputText(),
      'total_consultancy'    => new sfWidgetFormInputText(),
      'consultancy'          => new sfWidgetFormInputText(),
      'total_intermediation' => new sfWidgetFormInputText(),
      'intermediation'       => new sfWidgetFormInputText(),
      'total_formation'      => new sfWidgetFormInputText(),
      'formation'            => new sfWidgetFormInputText(),
      'total_patents'        => new sfWidgetFormInputText(),
      'patents'              => new sfWidgetFormInputText(),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'year'                 => new sfValidatorInteger(),
      'month'                => new sfValidatorInteger(),
      'total_affiliated'     => new sfValidatorNumber(array('required' => false)),
      'sale_of_affiliated'   => new sfValidatorNumber(array('required' => false)),
      'total_consultancy'    => new sfValidatorNumber(array('required' => false)),
      'consultancy'          => new sfValidatorNumber(array('required' => false)),
      'total_intermediation' => new sfValidatorNumber(array('required' => false)),
      'intermediation'       => new sfValidatorNumber(array('required' => false)),
      'total_formation'      => new sfValidatorNumber(array('required' => false)),
      'formation'            => new sfValidatorNumber(array('required' => false)),
      'total_patents'        => new sfValidatorNumber(array('required' => false)),
      'patents'              => new sfValidatorNumber(array('required' => false)),
      'created_at'           => new sfValidatorDateTime(),
      'updated_at'           => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('billing[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Billing';
  }

}
