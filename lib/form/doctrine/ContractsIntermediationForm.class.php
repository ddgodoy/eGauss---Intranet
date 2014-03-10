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
    $array_user = array(''=>'-- Seleccionar --') + AppUserTable::getInstance()->getAllForSelectContact();
    
    $month = array(      1=>'Enero',
                         2=>'Febrero',
                         3=>'Marzo',
                         4=>'Abril',
                         5=>'Mayo',
                         6=>'Junio',
                         7=>'Julio',
                         8=>'Agosto',
                         9=>'Septiembre',
                         10=>'Octubre',
                         11=>'Noviembre',
                         12=>'Diciembre');
    
    $array_year = array();
    $year_now   = date('Y');
    $after_year = $year_now-1;
    
    for($i=1; $i<7; $i++){
        $after_year = $after_year+1;
        $array_year[$after_year] = $after_year; 
    }
    
    $this->setWidgets(array(
      'id'                      => new sfWidgetFormInputHidden(),
      'date'                    => new sfWidgetFormJQueryDate(array('image'=>'/images/calendario.gif','date_widget' => new sfWidgetFormDate(array('format' => '%day% %month% %year%')))),  
      'year'                    => new sfWidgetFormChoice(array('choices'=>$array_year), array('class'=>'form_input', 'style'=>'width:130px;')),
      'month'                   => new sfWidgetFormChoice(array('choices'=>$month), array('class'=>'form_input', 'style'=>'width:130px;')),
      'customer_name'           => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:400px;')),
      'customer_company'        => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:400px;')),
      'customer_workstation'    => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:400px;')),
      'customer_email'          => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:400px;')),
      'customer_phone'          => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:400px;')),  
      'company_name'            => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:400px;')),
      'company_contact'         => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:400px;')),
      'company_email'           => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:400px;')),
      'company_phone'           => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:400px;')),  
      'app_user_id'             => new sfWidgetFormChoice(array('choices'=>$array_user), array('class'=>'form_input', 'style'=>'width:406px;')),
      'observations'            => new sfWidgetFormTextareaTinyMCE(array(),array('style' => 'width:100%;  height: 450px;', 'rows' => 10, 'class' => 'foo')),
      'business_amount'         => new sfWidgetFormInputText(array(), array('class'=>'form_input no_letters', 'style'=>'width:400px;')),
      'intermediation'          => new sfWidgetFormInputText(array(), array('class'=>'form_input no_letters', 'style'=>'width:400px;')),
      'final_commission'        => new sfWidgetFormInputText(array(), array('class'=>'form_input no_letters', 'style'=>'width:400px;')),
      'comments'                => new sfWidgetFormTextareaTinyMCE(array('config' => 'theme_advanced_buttons1 : "cut, copy, paste, images, bold, italic, underline, justifyleft, justifycenter, justifyright , outdent, indent, bullist, numlist, undo, redo, link",theme_advanced_buttons2 : "",theme_advanced_buttons3 : ""'),array('style' => 'width:900px;  height: 150px;', 'rows' => 10, 'class' => 'foo')),
      'comments_reunion'        => new sfWidgetFormTextareaTinyMCE(array('config' => 'theme_advanced_buttons1 : "cut, copy, paste, images, bold, italic, underline, justifyleft, justifycenter, justifyright , outdent, indent, bullist, numlist, undo, redo, link",theme_advanced_buttons2 : "",theme_advanced_buttons3 : ""'),array('style' => 'width:900px;  height: 150px;', 'rows' => 10, 'class' => 'foo')),  
    ));

    $this->setValidators(array(
      'id'                      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'date'                    => new sfValidatorDate(array('required' => FALSE), array('invalid' => 'La fecha ingresada es incorrecta')),  
      'year'                    => new sfValidatorChoice(array('choices' => array_keys($array_year)),array('required' => 'Ingrese un año.')),
      'month'                   => new sfValidatorChoice(array('choices' => array_keys($month)),array('required' => 'Ingrese un mes .')),
      'customer_name'           => new sfValidatorString(array('max_length' => 50)),
      'customer_company'        => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'customer_workstation'    => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'customer_email'          => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'customer_phone'          => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'company_name'            => new sfValidatorString(array('max_length' => 50,  'required' => false)),
      'company_contact'         => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'company_email'           => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'company_phone'           => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'app_user_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AppUser'))),
      'observations'            => new sfValidatorPass(array('required' => false)),
      'business_amount'         => new sfValidatorNumber(array('required' => false)),
      'intermediation'          => new sfValidatorNumber(array('required' => false)),
      'final_commission'        => new sfValidatorNumber(array('required' => false)),
      'comments'                => new sfValidatorPass(array('required' => false)),
      'comments_reunion'        => new sfValidatorPass(array('required' => false)),  
    ));

    $this->widgetSchema->setNameFormat('contracts_intermediation[%s]');
  }
}
