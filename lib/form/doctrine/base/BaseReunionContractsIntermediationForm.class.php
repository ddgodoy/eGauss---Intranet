<?php

/**
 * ReunionContractsIntermediation form base class.
 *
 * @method ReunionContractsIntermediation getObject() Returns the current form's model object
 *
 * @package    egauss
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseReunionContractsIntermediationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                          => new sfWidgetFormInputHidden(),
      'date'                        => new sfWidgetFormInputText(),
      'comments'                    => new sfWidgetFormInputText(),
      'contracts_intermediation_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ContractsIntermediation'), 'add_empty' => false)),
      'created_at'                  => new sfWidgetFormDateTime(),
      'updated_at'                  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'date'                        => new sfValidatorPass(),
      'comments'                    => new sfValidatorPass(array('required' => false)),
      'contracts_intermediation_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ContractsIntermediation'))),
      'created_at'                  => new sfValidatorDateTime(),
      'updated_at'                  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('reunion_contracts_intermediation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ReunionContractsIntermediation';
  }

}
