<?php

/**
 * Entrepreneur filter form base class.
 *
 * @package    egauss
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEntrepreneurFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'date'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'name'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'last_name'        => new sfWidgetFormFilterInput(),
      'phone'            => new sfWidgetFormFilterInput(),
      'email'            => new sfWidgetFormFilterInput(),
      'linkedin'         => new sfWidgetFormFilterInput(),
      'web_personal'     => new sfWidgetFormFilterInput(),
      'sex'              => new sfWidgetFormFilterInput(),
      'workstation'      => new sfWidgetFormFilterInput(),
      'project'          => new sfWidgetFormFilterInput(),
      'capital'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'comments_capital' => new sfWidgetFormFilterInput(),
      'courses'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'comments_courses' => new sfWidgetFormFilterInput(),
      'comments'         => new sfWidgetFormFilterInput(),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'date'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'name'             => new sfValidatorPass(array('required' => false)),
      'last_name'        => new sfValidatorPass(array('required' => false)),
      'phone'            => new sfValidatorPass(array('required' => false)),
      'email'            => new sfValidatorPass(array('required' => false)),
      'linkedin'         => new sfValidatorPass(array('required' => false)),
      'web_personal'     => new sfValidatorPass(array('required' => false)),
      'sex'              => new sfValidatorPass(array('required' => false)),
      'workstation'      => new sfValidatorPass(array('required' => false)),
      'project'          => new sfValidatorPass(array('required' => false)),
      'capital'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'comments_capital' => new sfValidatorPass(array('required' => false)),
      'courses'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'comments_courses' => new sfValidatorPass(array('required' => false)),
      'comments'         => new sfValidatorPass(array('required' => false)),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('entrepreneur_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Entrepreneur';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'date'             => 'Date',
      'name'             => 'Text',
      'last_name'        => 'Text',
      'phone'            => 'Text',
      'email'            => 'Text',
      'linkedin'         => 'Text',
      'web_personal'     => 'Text',
      'sex'              => 'Text',
      'workstation'      => 'Text',
      'project'          => 'Text',
      'capital'          => 'Boolean',
      'comments_capital' => 'Text',
      'courses'          => 'Boolean',
      'comments_courses' => 'Text',
      'comments'         => 'Text',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
    );
  }
}
