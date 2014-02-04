<?php

/**
 * Billing form.
 *
 * @package    egauss
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BillingForm extends BaseBillingForm
{
  public function configure()
  {
  	$month        = array(
										'-- Seleccionar --',
                    'Enero',
                    'Febrero',
                    'Marzo',
                    'Abril',
                    'Mayo',
                    'Junio',
                  	'Julio',
                    'Agosto',
                    'Septiembre',
                    'Octubre',
                    'Noviembre',
                    'Diciembre');
    
    $array_year = array();
    $year_now   = date('Y');
    $after_year = $year_now-2;
    
    for($i=1; $i<7; $i++){
        $after_year = $after_year+1;
        $array_year[$after_year] = $after_year; 
    }
      
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'year'                 => new sfWidgetFormChoice(array('choices'=>$array_year), array('class'=>'form_input', 'style'=>'width:130px;')),
      'month'                => new sfWidgetFormChoice(array('choices'=>$month), array('class'=>'form_input', 'style'=>'width:130px;')),
      'total_affiliated'     => new sfWidgetFormInputText(array(), array('class'=>'form_input no_letters', 'style'=>'width:265px;')),
      'sale_of_affiliated'   => new sfWidgetFormInputText(array(), array('class'=>'form_input no_letters', 'style'=>'width:265px;')),
      'total_consultancy'    => new sfWidgetFormInputText(array(), array('class'=>'form_input no_letters', 'style'=>'width:265px;')),
      'consultancy'          => new sfWidgetFormInputText(array(), array('class'=>'form_input no_letters', 'style'=>'width:265px;')),
      'total_intermediation' => new sfWidgetFormInputText(array(), array('class'=>'form_input no_letters', 'style'=>'width:265px;')),
      'intermediation'       => new sfWidgetFormInputText(array(), array('class'=>'form_input no_letters', 'style'=>'width:265px;')),
      'total_formation'      => new sfWidgetFormInputText(array(), array('class'=>'form_input no_letters', 'style'=>'width:265px;')),
      'formation'            => new sfWidgetFormInputText(array(), array('class'=>'form_input no_letters', 'style'=>'width:265px;')),
      'total_patents'        => new sfWidgetFormInputText(array(), array('class'=>'form_input no_letters', 'style'=>'width:265px;')),
      'patents'              => new sfWidgetFormInputText(array(), array('class'=>'form_input no_letters', 'style'=>'width:265px;')),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'year'                 => new sfValidatorChoice(array('choices' => array_keys($array_year)),array('required' => 'Ingrese un año.')),
      'month'                => new sfValidatorChoice(array('choices' => array_keys($month)),array('required' => 'Ingrese un mes .')),
      'total_affiliated'     => new sfValidatorNumber(array('required' => false)),
      'sale_of_affiliated'   => new sfValidatorNumber(array('required' => false)),
      'total_consultancy'    => new sfValidatorNumber(array('required' => false)),
      'consultancy'          => new sfValidatorNumber(array('required' => false)),
      'total_intermediation' => new sfValidatorNumber(array('required' => false)),
      'intermediation'       => new sfValidatorNumber(array('required' => false)),
      'total_formation'      => new sfValidatorNumber(array('required' => false)),
      'formation'            => new sfValidatorNumber(array('required' => false)),
      'total_patents'        => new sfValidatorNumber(array('required' => false)),
      'patents'              => new sfValidatorNumber(array('required' => false)),
    ));

    $this->setDefault('year', $year_now);
    
    $this->widgetSchema->setNameFormat('billing[%s]');
      
  }
}