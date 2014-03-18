<?php

/**
 * Investor form.
 *
 * @package    egauss
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class InvestorForm extends BaseInvestorForm
{
  public function configure()
  {
      $i18N             = sfContext::getInstance()->getI18N();
      $tic              = Tic::getArrayForSelect();
      $general_theme    = GeneralTheme::getArrayForSelect();
      $theme            = Theme::getArrayForSelect();
      $type_of_investor = TypeOfInvestor::getArrayForSelect();
      $array_user       = array(''=>'-- Seleccionar --') + AppUserTable::getInstance()->getAllForSelectContact();
      
      $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'date'                => new sfWidgetFormJQueryDate(array('image'=>'/images/calendario.gif','date_widget' => new sfWidgetFormDate(array('format' => '%day% %month% %year%')))),
      'name'                => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'last_name'           => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'phone'               => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'email'               => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'web_personal'        => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'company'             => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'web_company'         => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'city'                => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'country'             => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'project'             => new sfWidgetFormTextarea(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'tic_id'              => new sfWidgetFormChoice(array('choices'=>$tic), array('class'=>'form_input', 'style'=>'width:308px;')),
      'general_theme_id'    => new sfWidgetFormChoice(array('choices'=>$general_theme), array('class'=>'form_input', 'style'=>'width:308px;')),
      'theme_id'            => new sfWidgetFormChoice(array('choices'=>$theme), array('class'=>'form_input', 'style'=>'width:308px;')),
      'sub_theme'           => new sfWidgetFormTextarea(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'accredited_enisa'    => new sfWidgetFormInputCheckbox(array(),array('value'=>1)),
      'type_of_investor_id' => new sfWidgetFormChoice(array('choices'=>$type_of_investor), array('class'=>'form_input', 'style'=>'width:308px;')),
      'investor_from'       => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'investor_to'         => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'comment'             => new sfWidgetFormTextareaTinyMCE(array('config' => 'theme_advanced_buttons1 : "cut, copy, paste, images, bold, italic, underline, justifyleft, justifycenter, justifyright , outdent, indent, bullist, numlist, undo, redo, link",theme_advanced_buttons2 : "",theme_advanced_buttons3 : ""'),array('style' => 'width:900px;  height: 150px;', 'rows' => 10, 'class' => 'foo')),
      'app_user_id'         => new sfWidgetFormChoice(array('choices'=>$array_user), array('class'=>'form_input', 'style'=>'width:308px;')),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'date'                => new sfValidatorDate(array('required' => true), array('required' => 'La fecha es obligatoria', 'invalid' => 'La fecha ingresada es incorrecta')),
      'name'                => new sfValidatorString(array('max_length' => 50), array('required'=>$i18N->__('Enter the name', NULL, 'errors'))),
      'last_name'           => new sfValidatorString(array('max_length' => 50), array('required'=>$i18N->__('Enter the last name', NULL, 'errors'))),
      'phone'               => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'email'               => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'web_personal'        => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'company'             => new sfValidatorString(array('max_length' => 200, 'required' => true),  array('required'=>'Ingrese el nombre de la empresa')),
      'web_company'         => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'city'                => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'country'             => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'project'             => new sfValidatorPass(array('required' => true),  array('required'=>'Ingrese el proyecto')),
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
    ));

    $this->widgetSchema->setNameFormat('investor[%s]');
  }
}
