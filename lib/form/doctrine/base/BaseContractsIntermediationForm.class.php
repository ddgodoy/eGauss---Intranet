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
      'id'                      => new sfWidgetFormInputHidden(),
      'year'                    => new sfWidgetFormInputText(),
      'month'                   => new sfWidgetFormInputText(),
      'day'                     => new sfWidgetFormInputText(),
      'customer_name'           => new sfWidgetFormInputText(),
      'customer_company'        => new sfWidgetFormInputText(),
      'customer_workstation'    => new sfWidgetFormInputText(),
      'customer_email'          => new sfWidgetFormInputText(),
      'customer_phone'          => new sfWidgetFormInputText(),
      'company_name'            => new sfWidgetFormInputText(),
      'company_contact'         => new sfWidgetFormInputText(),
      'company_email'           => new sfWidgetFormInputText(),
      'company_phone'           => new sfWidgetFormInputText(),
      'app_user_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AppUser'), 'add_empty' => false)),
      'observations'            => new sfWidgetFormInputText(),
      'business_amount'         => new sfWidgetFormInputText(),
      'intermediation'          => new sfWidgetFormInputText(),
      'final_commission'        => new sfWidgetFormInputText(),
      'comments'                => new sfWidgetFormInputText(),
      'registered_companies_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RegisteredCompanies'), 'add_empty' => true)),
      'created_at'              => new sfWidgetFormDateTime(),
      'updated_at'              => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'year'                    => new sfValidatorInteger(),
      'month'                   => new sfValidatorInteger(),
      'day'                     => new sfValidatorInteger(),
      'customer_name'           => new sfValidatorString(array('max_length' => 50)),
      'customer_company'        => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'customer_workstation'    => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'customer_email'          => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'customer_phone'          => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'company_name'            => new sfValidatorString(array('max_length' => 50)),
      'company_contact'         => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'company_email'           => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'company_phone'           => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'app_user_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AppUser'))),
      'observations'            => new sfValidatorPass(array('required' => false)),
      'business_amount'         => new sfValidatorNumber(array('required' => false)),
      'intermediation'          => new sfValidatorNumber(array('required' => false)),
      'final_commission'        => new sfValidatorNumber(array('required' => false)),
      'comments'                => new sfValidatorPass(array('required' => false)),
      'registered_companies_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RegisteredCompanies'), 'required' => false)),
      'created_at'              => new sfValidatorDateTime(),
      'updated_at'              => new sfValidatorDateTime(),
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
