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
    $i18N                =  sfContext::getInstance()->getI18N();   
    $array_user_customer =  AppUserTable::getInstance()->getAllForSelectContact(3);
    $array_company       = RegisteredCompanies::getArrayByType(['0','3']);
    $array_affiliated    = RegisteredCompanies::getArrayByType(['0','1']);
    
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
    
    $id                     = $this->getObject()->getId();
    $associated_customer    = array();
    $associated_company     = array();
    $associated_affiliated  = array();
    
    if($id)
    {
      $associated_customer    = AppUserContractsIntermediationTable::getInstance()->getAllForSelectContactAssociated($id);  
      $associated_company     = RegisteredCompaniesContractsIntermediationTable::getInstance()->getAllForSelectCompanyAssociated($id, 'company'); 
      $associated_affiliated  = RegisteredCompaniesContractsIntermediationTable::getInstance()->getAllForSelectCompanyAssociated($id, 'affiliated'); 
    }    
    
    
    
    $this->setWidgets(array(
      'id'                      => new sfWidgetFormInputHidden(),
      'name'                    => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:400px;')),  
      'date'                    => new sfWidgetFormJQueryDate(array('image'=>'/images/calendario.gif','date_widget' => new sfWidgetFormDate(array('format' => '%day% %month% %year%')))),  
      'hour_from'               => new sfWidgetFormTime(array('with_seconds' => true,'format'=> '%hour% : %minute% : %second%')),
      'hour_to'                 => new sfWidgetFormTime(array('with_seconds' => true,'format'=> '%hour% : %minute% : %second%')),
      'subject'                 => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:400px;')),
      'body'                    => new sfWidgetFormTextareaTinyMCE(array('config' => 'theme_advanced_buttons1 : "cut, copy, paste, images, bold, italic, underline, justifyleft, justifycenter, justifyright , outdent, indent, bullist, numlist, undo, redo, link",theme_advanced_buttons2 : "",theme_advanced_buttons3 : ""'),array('style' => 'width:900px;  height: 150px;', 'rows' => 10, 'class' => 'foo')),  
      'year'                    => new sfWidgetFormChoice(array('choices'=>$array_year), array('class'=>'form_input', 'style'=>'width:130px;')),
      'month'                   => new sfWidgetFormChoice(array('choices'=>$month), array('class'=>'form_input', 'style'=>'width:130px;')),
      'observations'            => new sfWidgetFormTextareaTinyMCE(array('config' =>'theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,forecolor,backcolor",theme_advanced_buttons3 : "removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr",'),array('style' => 'width:930px;  height: 450px;', 'rows' => 10, 'class' => 'foo')),
      'business_amount'         => new sfWidgetFormInputText(array(), array('class'=>'form_input no_letters', 'style'=>'width:400px;')),
      'intermediation'          => new sfWidgetFormInputText(array(), array('class'=>'form_input no_letters', 'style'=>'width:400px;')),
      'final_commission'        => new sfWidgetFormInputText(array(), array('class'=>'form_input no_letters', 'style'=>'width:400px;')),
      'cashed'                  => new sfWidgetFormInputCheckbox(array(),array('value'=>1)),
      'customer'                => new sfWidgetFormChoice(array('choices'=> $array_user_customer,'renderer_class' => 'sfWidgetFormSelectDoubleList','renderer_options'=>array('associated_first'=>FALSE,'associated_choices' => $associated_customer, 'label_unassociated'=>$i18N->__('Unassociated'), 'label_associated'=>$i18N->__('Associated')))),
      'company'                 => new sfWidgetFormChoice(array('choices'=> $array_company,'renderer_class' => 'sfWidgetFormSelectDoubleList','renderer_options'=>array('associated_first'=>FALSE,'associated_choices' => $associated_company, 'label_unassociated'=>$i18N->__('Unassociated'), 'label_associated'=>$i18N->__('Associated'))))   ,
      'affiliated'              => new sfWidgetFormChoice(array('choices'=> $array_affiliated,'renderer_class' => 'sfWidgetFormSelectDoubleList','renderer_options'=>array('associated_first'=>FALSE,'associated_choices' => $associated_affiliated, 'label_unassociated'=>$i18N->__('Unassociated'), 'label_associated'=>$i18N->__('Associated'))))      
        
    ));

    $this->setValidators(array(
      'id'                      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'                    => new sfValidatorString(array('max_length' => 200,'required' => TRUE), array('required' => 'Ingrese el Nombre',)),  
      'date'                    => new sfValidatorDate(array('required' => FALSE), array('required' => 'La fecha es obligatoria', 'invalid' => 'La fecha ingresada es incorrecta')),  
      'hour_from'               => new sfValidatorTime(array('required' => FALSE), array('invalid' => 'Hora de inicio Inválida', 'required' => 'Hora de inicio Obrigatória.')),
      'hour_to'                 => new sfValidatorTime(array('required' => FALSE), array('invalid' => 'Hora de fin Inválida', 'required' => 'Hora de fin Obrigatória.')),
      'subject'                 => new sfValidatorString(array('max_length' => 50, 'required' => FALSE), array('required'=>'Ingrese el Título')),
      'body'                    => new sfValidatorPass(array('required' => false)),
      'year'                    => new sfValidatorChoice(array('choices' => array_keys($array_year)),array('required' => 'Ingrese un año.')),
      'month'                   => new sfValidatorChoice(array('choices' => array_keys($month)),array('required' => 'Ingrese un mes .')),
      'observations'            => new sfValidatorPass(array('required' => false)),
      'business_amount'         => new sfValidatorNumber(array('required' => false)),
      'intermediation'          => new sfValidatorNumber(array('required' => false)),
      'final_commission'        => new sfValidatorNumber(array('required' => false)),
      'cashed'                  => new sfValidatorBoolean(array('required' => false)), 
      'customer'                => new sfValidatorChoice(array('choices' => array_keys($array_user_customer), 'multiple' => true, 'required'=>TRUE ),array('required'=>'Ingrese un Cliente')),    
      'company'                 => new sfValidatorChoice(array('choices' => array_keys($array_company), 'multiple' => true)),
      'affiliated'              => new sfValidatorChoice(array('choices' => array_keys($array_affiliated), 'multiple' => true))        
    ));

    $this->widgetSchema->setNameFormat('contracts_intermediation[%s]');
  }
}
