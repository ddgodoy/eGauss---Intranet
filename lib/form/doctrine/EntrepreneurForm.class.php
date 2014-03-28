<?php

/**
 * Entrepreneur form.
 *
 * @package    egauss
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EntrepreneurForm extends BaseEntrepreneurForm
{
  public function configure()
  {
      $i18N       = sfContext::getInstance()->getI18N(); 
      $sex = ['m'=>'Masculino','f'=>'Femenino'];
      $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'date'             => new sfWidgetFormJQueryDate(array('image'=>'/images/calendario.gif','date_widget' => new sfWidgetFormDate(array('format' => '%day% %month% %year%')))),
      'name'             => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'last_name'        => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'phone'            => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'email'            => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'linkedin'         => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'web_personal'     => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'sex'              => new sfWidgetFormChoice(array('choices'=>$sex), array('class'=>'form_input', 'style'=>'width:308px;')),
      'workstation'      => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'project'          => new sfWidgetFormTextareaTinyMCE(array('config' => 'theme_advanced_buttons1 : "cut, copy, paste, images, bold, italic, underline, justifyleft, justifycenter, justifyright , outdent, indent, bullist, numlist, undo, redo, link",theme_advanced_buttons2 : "",theme_advanced_buttons3 : ""'),array('style' => 'width:900px;  height: 150px;', 'rows' => 10, 'class' => 'foo')),
      'capital'          => new sfWidgetFormInputCheckbox([],['value'=>'1']),
      'comments_capital' => new sfWidgetFormTextarea(array(),array('style' => 'width:900px;  height: 150px;', 'rows' => 10, 'class' => 'foo')),
      'courses'          => new sfWidgetFormInputCheckbox([],['value'=>'1']),
      'comments_courses' => new sfWidgetFormTextarea(array(),array('style' => 'width:900px;  height: 150px;', 'rows' => 10, 'class' => 'foo')),
      'comments'         => new sfWidgetFormTextareaTinyMCE(array(),array('style' => 'width:930px;  height: 450px;', 'rows' => 10, 'class' => 'foo')),    
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'date'             => new sfValidatorDate(array('required' => true), array('required' => 'La fecha es obligatoria', 'invalid' => 'La fecha ingresada es incorrecta')),
      'name'             => new sfValidatorString(array('max_length' => 50), array('required'=>$i18N->__('Enter the name', NULL, 'errors'))),
      'last_name'        => new sfValidatorString(array('max_length' => 50), array('required'=>$i18N->__('Enter the last name', NULL, 'errors'))),
      'phone'            => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'email'            => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'linkedin'         => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'web_personal'     => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'sex'              => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'workstation'      => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'project'          => new sfValidatorPass(array('required' => false)),
      'capital'          => new sfValidatorBoolean(array('required' => false)),
      'comments_capital' => new sfValidatorPass(array('required' => false)),
      'courses'          => new sfValidatorBoolean(array('required' => false)),
      'comments_courses' => new sfValidatorPass(array('required' => false)),
      'comments'         => new sfValidatorPass(array('required' => false)),  
    ));

    $this->widgetSchema->setNameFormat('entrepreneur[%s]');
  }
}
