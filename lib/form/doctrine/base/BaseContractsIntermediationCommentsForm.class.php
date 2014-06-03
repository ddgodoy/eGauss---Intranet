<?php

/**
 * ContractsIntermediationComments form base class.
 *
 * @method ContractsIntermediationComments getObject() Returns the current form's model object
 *
 * @package    egauss
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseContractsIntermediationCommentsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                          => new sfWidgetFormInputHidden(),
      'comments'                    => new sfWidgetFormInputText(),
      'contracts_intermediation_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ContractsIntermediation'), 'add_empty' => false)),
      'app_user_id'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AppUser'), 'add_empty' => false)),
      'created_at'                  => new sfWidgetFormDateTime(),
      'updated_at'                  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'comments'                    => new sfValidatorPass(array('required' => false)),
      'contracts_intermediation_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ContractsIntermediation'))),
      'app_user_id'                 => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AppUser'))),
      'created_at'                  => new sfValidatorDateTime(),
      'updated_at'                  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('contracts_intermediation_comments[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ContractsIntermediationComments';
  }

}
