<?php

/**
 * ContractsIntermediation form.
 *
 * @package    egauss
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ContractsIntermediationForm extends BaseContractsIntermediationForm
{
  public function configure()
  {
    $array_user = [''=>'-- seleccionar --']+AppUserTable::getInstance()->getAllForSelectContact();
    
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'date'             => new sfWidgetFormJQueryDate(array('image'=>'/images/calendario.gif','date_widget' => new sfWidgetFormDate(array('format' => '%day% %month% %year%')))),
      'customer'         => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:400px;')),
      'app_user_id'      => new sfWidgetFormChoice(array('choices'=>$array_user), array('class'=>'form_input', 'style'=>'width:406px;')),
      'observations'     => new sfWidgetFormTextareaTinyMCE(array(),array('style' => 'width:100%;  height: 450px;', 'rows' => 10, 'class' => 'foo')),
      'business_amount'  => new sfWidgetFormInputText(array(), array('class'=>'form_input no_letters', 'style'=>'width:400px;')),
      'intermediation'   => new sfWidgetFormInputText(array(), array('class'=>'form_input no_letters', 'style'=>'width:400px;')),
      'final_commission' => new sfWidgetFormInputText(array(), array('class'=>'form_input no_letters', 'style'=>'width:400px;')),
      'comments'         => new sfWidgetFormTextareaTinyMCE(array('config' => 'theme_advanced_buttons1 : "cut, copy, paste, images, bold, italic, underline, justifyleft, justifycenter, justifyright , outdent, indent, bullist, numlist, undo, redo, link",theme_advanced_buttons2 : "",theme_advanced_buttons3 : ""'),array('style' => 'width:900px;  height: 150px;', 'rows' => 10, 'class' => 'foo')),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'date'             => new sfValidatorDate(array('required' => true), array('required' => 'La fecha es obligatoria', 'invalid' => 'La fecha ingresada es incorrecta')),
      'customer'         => new sfValidatorString(array('max_length' => 50)),
      'app_user_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AppUser'))),
      'observations'     => new sfValidatorPass(array('required' => false)),
      'business_amount'  => new sfValidatorNumber(array('required' => false)),
      'intermediation'   => new sfValidatorNumber(array('required' => false)),
      'final_commission' => new sfValidatorNumber(array('required' => false)),
      'comments'         => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('contracts_intermediation[%s]');
  }
}
