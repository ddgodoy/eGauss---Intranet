<?php

/**
 * Investor form base class.
 *
 * @method Investor getObject() Returns the current form's model object
 *
 * @package    egauss
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseInvestorForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'date'                => new sfWidgetFormInputText(),
      'name'                => new sfWidgetFormInputText(),
      'last_name'           => new sfWidgetFormInputText(),
      'phone'               => new sfWidgetFormInputText(),
      'email'               => new sfWidgetFormInputText(),
      'web_personal'        => new sfWidgetFormInputText(),
      'company'             => new sfWidgetFormInputText(),
      'web_company'         => new sfWidgetFormInputText(),
      'city'                => new sfWidgetFormInputText(),
      'country'             => new sfWidgetFormInputText(),
      'project'             => new sfWidgetFormInputText(),
      'tic_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tic'), 'add_empty' => false)),
      'general_theme_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('GeneralTheme'), 'add_empty' => false)),
      'theme_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Theme'), 'add_empty' => false)),
      'sub_theme'           => new sfWidgetFormInputText(),
      'accredited_enisa'    => new sfWidgetFormInputCheckbox(),
      'type_of_investor_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TypeOfInvestor'), 'add_empty' => false)),
      'investor_from'       => new sfWidgetFormInputText(),
      'investor_to'         => new sfWidgetFormInputText(),
      'comment'             => new sfWidgetFormInputText(),
      'app_user_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AppUser'), 'add_empty' => true)),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'date'                => new sfValidatorPass(array('required' => false)),
      'name'                => new sfValidatorString(array('max_length' => 200)),
      'last_name'           => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'phone'               => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'email'               => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'web_personal'        => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'company'             => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'web_company'         => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'city'                => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'country'             => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'project'             => new sfValidatorPass(array('required' => false)),
      'tic_id'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tic'))),
      'general_theme_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('GeneralTheme'))),
      'theme_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Theme'))),
      'sub_theme'           => new sfValidatorPass(array('required' => false)),
      'accredited_enisa'    => new sfValidatorBoolean(array('required' => false)),
      'type_of_investor_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TypeOfInvestor'))),
      'investor_from'       => new sfValidatorNumber(array('required' => false)),
      'investor_to'         => new sfValidatorNumber(array('required' => false)),
      'comment'             => new sfValidatorPass(array('required' => false)),
      'app_user_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AppUser'), 'required' => false)),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('investor[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Investor';
  }

}
