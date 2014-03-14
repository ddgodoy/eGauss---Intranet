<?php

/**
 * Investor filter form base class.
 *
 * @package    egauss
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseInvestorFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'date'                => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'name'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'last_name'           => new sfWidgetFormFilterInput(),
      'phone'               => new sfWidgetFormFilterInput(),
      'email'               => new sfWidgetFormFilterInput(),
      'web_personal'        => new sfWidgetFormFilterInput(),
      'company'             => new sfWidgetFormFilterInput(),
      'web_company'         => new sfWidgetFormFilterInput(),
      'city'                => new sfWidgetFormFilterInput(),
      'country'             => new sfWidgetFormFilterInput(),
      'project'             => new sfWidgetFormFilterInput(),
      'tic_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tic'), 'add_empty' => true)),
      'general_theme_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('GeneralTheme'), 'add_empty' => true)),
      'theme_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Theme'), 'add_empty' => true)),
      'sub_theme'           => new sfWidgetFormFilterInput(),
      'accredited_enisa'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'type_of_investor_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TypeOfInvestor'), 'add_empty' => true)),
      'investor_from'       => new sfWidgetFormFilterInput(),
      'investor_to'         => new sfWidgetFormFilterInput(),
      'comment'             => new sfWidgetFormFilterInput(),
      'app_user_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AppUser'), 'add_empty' => true)),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'date'                => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'name'                => new sfValidatorPass(array('required' => false)),
      'last_name'           => new sfValidatorPass(array('required' => false)),
      'phone'               => new sfValidatorPass(array('required' => false)),
      'email'               => new sfValidatorPass(array('required' => false)),
      'web_personal'        => new sfValidatorPass(array('required' => false)),
      'company'             => new sfValidatorPass(array('required' => false)),
      'web_company'         => new sfValidatorPass(array('required' => false)),
      'city'                => new sfValidatorPass(array('required' => false)),
      'country'             => new sfValidatorPass(array('required' => false)),
      'project'             => new sfValidatorPass(array('required' => false)),
      'tic_id'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Tic'), 'column' => 'id')),
      'general_theme_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('GeneralTheme'), 'column' => 'id')),
      'theme_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Theme'), 'column' => 'id')),
      'sub_theme'           => new sfValidatorPass(array('required' => false)),
      'accredited_enisa'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'type_of_investor_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TypeOfInvestor'), 'column' => 'id')),
      'investor_from'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'investor_to'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'comment'             => new sfValidatorPass(array('required' => false)),
      'app_user_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AppUser'), 'column' => 'id')),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('investor_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Investor';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'date'                => 'Date',
      'name'                => 'Text',
      'last_name'           => 'Text',
      'phone'               => 'Text',
      'email'               => 'Text',
      'web_personal'        => 'Text',
      'company'             => 'Text',
      'web_company'         => 'Text',
      'city'                => 'Text',
      'country'             => 'Text',
      'project'             => 'Text',
      'tic_id'              => 'ForeignKey',
      'general_theme_id'    => 'ForeignKey',
      'theme_id'            => 'ForeignKey',
      'sub_theme'           => 'Text',
      'accredited_enisa'    => 'Boolean',
      'type_of_investor_id' => 'ForeignKey',
      'investor_from'       => 'Number',
      'investor_to'         => 'Number',
      'comment'             => 'Text',
      'app_user_id'         => 'ForeignKey',
      'created_at'          => 'Date',
      'updated_at'          => 'Date',
    );
  }
}
