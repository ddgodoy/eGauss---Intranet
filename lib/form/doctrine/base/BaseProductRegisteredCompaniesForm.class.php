<?php

/**
 * ProductRegisteredCompanies form base class.
 *
 * @method ProductRegisteredCompanies getObject() Returns the current form's model object
 *
 * @package    egauss
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProductRegisteredCompaniesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                      => new sfWidgetFormInputHidden(),
      'product_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Product'), 'add_empty' => true)),
      'registered_companies_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RegisteredCompanies'), 'add_empty' => true)),
      'created_at'              => new sfWidgetFormDateTime(),
      'updated_at'              => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'product_id'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Product'), 'required' => false)),
      'registered_companies_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RegisteredCompanies'), 'required' => false)),
      'created_at'              => new sfValidatorDateTime(),
      'updated_at'              => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('product_registered_companies[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProductRegisteredCompanies';
  }

}
