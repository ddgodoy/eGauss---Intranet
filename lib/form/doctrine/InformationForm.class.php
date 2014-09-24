<?php

/**
 * Information form.
 *
 * @package    egauss
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class InformationForm extends BaseInformationForm
{
  public function configure()
  {
    $type         = TypeInformation::getArrayForSelect();
    $company      = RegisteredCompanies::getArrayForSelect();
    $contract     = ContractsIntermediation::getArrayForSelect();
    
    $this->setWidgets(array(
      'id'                          => new sfWidgetFormInputHidden(),
      'date'                        => new sfWidgetFormJQueryDate(array('image'=>'/images/calendario.gif','date_widget' => new sfWidgetFormDate(array('format' => '%day% %month% %year%')))),
      'name'                        => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:400px;')),
      'description'                 => new sfWidgetFormTextareaTinyMCE(array('config' =>'theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,forecolor,backcolor",theme_advanced_buttons3 : "removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr",'),array('style' => 'width:930px;  height: 450px;', 'rows' => 10, 'class' => 'foo')),
      'registered_companies_id'     => new sfWidgetFormChoice(array('choices'=>$company), array('class'=>'form_input', 'style'=>'width:408px;')),
      'contracts_intermediation_id' => new sfWidgetFormChoice(array('choices'=>$contract), array('class'=>'form_input', 'style'=>'width:408px;')),
      'type_information_id'         => new sfWidgetFormChoice(array('choices'=>$type), array('class'=>'form_input', 'style'=>'width:408px;')),
      'important'                   => new sfWidgetFormInputCheckbox(),      
    ));

    $this->setValidators(array(
      'id'                          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'date'                        => new sfValidatorDate(array('required' => true), array('required' => 'La fecha es obligatoria', 'invalid' => 'La fecha ingresada es incorrecta')),
      'name'                        => new sfValidatorString(array('max_length' => 50), array('required'=>'Ingrese el Título')),
      'description'                 => new sfValidatorPass(array('required' => false)),
      'registered_companies_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RegisteredCompanies'), 'required' => false)),
      'contracts_intermediation_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ContractsIntermediation'), 'required' => false)),  
      'type_information_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TypeInformation'), 'required' => false)),
      'important'                   => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('information[%s]');
  }
}
