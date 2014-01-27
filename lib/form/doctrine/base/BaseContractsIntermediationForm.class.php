<?php

/**
 * ContractsIntermediation form base class.
 *
 * @method ContractsIntermediation getObject() Returns the current form's model object
 *
 * @package    egauss
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseContractsIntermediationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'year'             => new sfWidgetFormInputText(),
      'month'            => new sfWidgetFormInputText(),
      'day'              => new sfWidgetFormInputText(),
      'customer'         => new sfWidgetFormInputText(),
      'app_user_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AppUser'), 'add_empty' => false)),
      'observations'     => new sfWidgetFormInputText(),
      'business_amount'  => new sfWidgetFormInputText(),
      'intermediation'   => new sfWidgetFormInputText(),
      'final_commission' => new sfWidgetFormInputText(),
      'comments'         => new sfWidgetFormInputText(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'year'             => new sfValidatorInteger(),
      'month'            => new sfValidatorInteger(),
      'day'              => new sfValidatorInteger(),
      'customer'         => new sfValidatorString(array('max_length' => 50)),
      'app_user_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AppUser'))),
      'observations'     => new sfValidatorPass(array('required' => false)),
      'business_amount'  => new sfValidatorNumber(array('required' => false)),
      'intermediation'   => new sfValidatorNumber(array('required' => false)),
      'final_commission' => new sfValidatorNumber(array('required' => false)),
      'comments'         => new sfValidatorPass(array('required' => false)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('contracts_intermediation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ContractsIntermediation';
  }

}
