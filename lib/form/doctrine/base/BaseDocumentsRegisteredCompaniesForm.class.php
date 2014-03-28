<?php

/**
 * DocumentsRegisteredCompanies form base class.
 *
 * @method DocumentsRegisteredCompanies getObject() Returns the current form's model object
 *
 * @package    egauss
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDocumentsRegisteredCompaniesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                      => new sfWidgetFormInputHidden(),
      'name'                    => new sfWidgetFormInputText(),
      'icon'                    => new sfWidgetFormInputText(),
      'url'                     => new sfWidgetFormInputText(),
      'registered_companies_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RegisteredCompanies'), 'add_empty' => false)),
      'information_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Information'), 'add_empty' => true)),
      'type_information_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TypeInformation'), 'add_empty' => true)),
      'calendar_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Calendar'), 'add_empty' => true)),
      'description'             => new sfWidgetFormInputText(),
      'download'                => new sfWidgetFormInputText(),
      'entrepreneur_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Entrepreneur'), 'add_empty' => true)),
      'created_at'              => new sfWidgetFormDateTime(),
      'updated_at'              => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'                    => new sfValidatorString(array('max_length' => 50)),
      'icon'                    => new sfValidatorString(array('max_length' => 200)),
      'url'                     => new sfValidatorString(array('max_length' => 200)),
      'registered_companies_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RegisteredCompanies'))),
      'information_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Information'), 'required' => false)),
      'type_information_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TypeInformation'), 'required' => false)),
      'calendar_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Calendar'), 'required' => false)),
      'description'             => new sfValidatorPass(array('required' => false)),
      'download'                => new sfValidatorString(array('max_length' => 200)),
      'entrepreneur_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Entrepreneur'), 'required' => false)),
      'created_at'              => new sfValidatorDateTime(),
      'updated_at'              => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('documents_registered_companies[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DocumentsRegisteredCompanies';
  }

}
