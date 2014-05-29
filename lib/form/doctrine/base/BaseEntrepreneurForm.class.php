<?php

/**
 * Entrepreneur form base class.
 *
 * @method Entrepreneur getObject() Returns the current form's model object
 *
 * @package    egauss
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEntrepreneurForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'date'                 => new sfWidgetFormInputText(),
      'year_one'             => new sfWidgetFormInputText(),
      'year_two'             => new sfWidgetFormInputText(),
      'name'                 => new sfWidgetFormInputText(),
      'last_name'            => new sfWidgetFormInputText(),
      'phone'                => new sfWidgetFormInputText(),
      'email'                => new sfWidgetFormInputText(),
      'linkedin'             => new sfWidgetFormInputText(),
      'web_personal'         => new sfWidgetFormInputText(),
      'sex'                  => new sfWidgetFormInputText(),
      'country'              => new sfWidgetFormInputText(),
      'workstation'          => new sfWidgetFormInputText(),
      'sector'               => new sfWidgetFormInputText(),
      'twitter'              => new sfWidgetFormInputText(),
      'facebook'             => new sfWidgetFormInputText(),
      'source'               => new sfWidgetFormInputText(),
      'other_sites_interest' => new sfWidgetFormInputText(),
      'project_name'         => new sfWidgetFormInputText(),
      'project'              => new sfWidgetFormInputText(),
      'capital'              => new sfWidgetFormInputCheckbox(),
      'comments_capital'     => new sfWidgetFormInputText(),
      'courses'              => new sfWidgetFormInputCheckbox(),
      'comments_courses'     => new sfWidgetFormInputText(),
      'comments'             => new sfWidgetFormInputText(),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'date'                 => new sfValidatorPass(),
      'year_one'             => new sfValidatorString(array('max_length' => 200)),
      'year_two'             => new sfValidatorString(array('max_length' => 200)),
      'name'                 => new sfValidatorString(array('max_length' => 200)),
      'last_name'            => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'phone'                => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'email'                => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'linkedin'             => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'web_personal'         => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'sex'                  => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'country'              => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'workstation'          => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'sector'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'twitter'              => new sfValidatorPass(array('required' => false)),
      'facebook'             => new sfValidatorPass(array('required' => false)),
      'source'               => new sfValidatorPass(array('required' => false)),
      'other_sites_interest' => new sfValidatorPass(array('required' => false)),
      'project_name'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'project'              => new sfValidatorPass(array('required' => false)),
      'capital'              => new sfValidatorBoolean(array('required' => false)),
      'comments_capital'     => new sfValidatorPass(array('required' => false)),
      'courses'              => new sfValidatorBoolean(array('required' => false)),
      'comments_courses'     => new sfValidatorPass(array('required' => false)),
      'comments'             => new sfValidatorPass(array('required' => false)),
      'created_at'           => new sfValidatorDateTime(),
      'updated_at'           => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('entrepreneur[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Entrepreneur';
  }

}
