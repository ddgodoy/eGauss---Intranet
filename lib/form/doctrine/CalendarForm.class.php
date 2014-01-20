<?php

/**
 * Calendar form.
 *
 * @package    egauss
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CalendarForm extends BaseCalendarForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'id'                      => new sfWidgetFormInputHidden(),
      'date'                    => new sfWidgetFormJQueryDate(array('image'=>'/images/calendario.gif','date_widget' => new sfWidgetFormDate(array('format' => '%day% %month% %year%')))),  
      'hour_from'               => new sfWidgetFormTime(array('with_seconds' => true,'format'=> '%hour% : %minute% : %second%')),
      'hour_to'                 => new sfWidgetFormTime(array('with_seconds' => true,'format'=> '%hour% : %minute% : %second%')),
      'subject'                 => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:400px;')),
      'body'                    => new sfWidgetFormTextareaTinyMCE(array(),array('style' => 'width:100%;  height: 450px;', 'rows' => 10, 'class' => 'foo')),
      'next'                    => new sfWidgetFormInputCheckbox(array(),array('value'=>1)),
    ));

    $this->setValidators(array(
      'id'                      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'date'                    => new sfValidatorDate(array('required' => true), array('required' => 'La fecha es obligatoria', 'invalid' => 'La fecha ingresada es incorrecta')),  
      'hour_from'               => new sfValidatorTime(array(), array('invalid' => 'Hora de inicio Inválida', 'required' => 'Hora de inicio Obrigatória.')),
      'hour_to'                 => new sfValidatorTime(array(), array('invalid' => 'Hora de fin Inválida', 'required' => 'Hora de fin Obrigatória.')),
      'subject'                 => new sfValidatorString(array('max_length' => 50), array('required'=>'Ingrese el Título')),
      'body'                    => new sfValidatorPass(array('required' => false)),
      'next'                    => new sfValidatorBoolean(array('required' => false)),
    ));
    
    
    $this->widgetSchema->setNameFormat('calendar[%s]');
  }
}
