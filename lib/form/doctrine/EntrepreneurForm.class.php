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
      for($i = 1910; $i<(date('Y')-1); $i++)
      {
        $years[$i] = $i;
      }
      
      $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'date'             => new sfWidgetFormJQueryDate(array('image'=>'/images/calendario.gif','date_widget' => new sfWidgetFormDate(array('format' => '%day% %month% %year%','years'=> array_combine($years, $years))))),
      'year_one'         => new sfWidgetFormChoice(array('choices'=>$years), array('class'=>'form_input', 'style'=>'width:147px;')),
      'year_two'         => new sfWidgetFormChoice(array('choices'=>$years), array('class'=>'form_input', 'style'=>'width:147px;')),
      'name'             => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'last_name'        => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'phone'            => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'email'            => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'linkedin'         => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'web_personal'     => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'sex'              => new sfWidgetFormChoice(array('choices'=>$sex), array('class'=>'form_input', 'style'=>'width:308px;')),
      'country'          => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),    
      'workstation'      => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'sector'           => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'twitter'          => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'facebook'         => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'source'           => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),
      'other_sites_interest' => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),    
      'project_name'     => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:300px;')),    
      'project'          => new sfWidgetFormTextareaTinyMCE(array('config' => 'theme_advanced_buttons1 : "cut, copy, paste, images, bold, italic, underline, justifyleft, justifycenter, justifyright , outdent, indent, bullist, numlist, undo, redo, link",theme_advanced_buttons2 : "",theme_advanced_buttons3 : ""'),array('style' => 'width:900px;  height: 150px;', 'rows' => 10, 'class' => 'foo')),
      'capital'          => new sfWidgetFormInputCheckbox([],['value'=>'1']),
      'comments_capital' => new sfWidgetFormTextarea(array(),array('style' => 'width:900px;  height: 150px;', 'rows' => 10, 'class' => 'foo')),
      'courses'          => new sfWidgetFormInputCheckbox([],['value'=>'1']),
      'comments_courses' => new sfWidgetFormTextarea(array(),array('style' => 'width:900px;  height: 150px;', 'rows' => 10, 'class' => 'foo')),
      'comments'         => new sfWidgetFormTextareaTinyMCE(array('config' =>'theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,forecolor,backcolor",theme_advanced_buttons3 : "removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr",'),array('style' => 'width:930px;  height: 450px;', 'rows' => 10, 'class' => 'foo')),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'date'             => new sfValidatorDate(array('required' => False)),
      'year_one'         => new sfValidatorString(array('max_length' => 200)),
      'year_two'         => new sfValidatorString(array('max_length' => 200)),  
      'name'             => new sfValidatorString(array('max_length' => 50), array('required'=>$i18N->__('Enter the name', NULL, 'errors'))),
      'last_name'        => new sfValidatorString(array('max_length' => 50), array('required'=>$i18N->__('Enter the last name', NULL, 'errors'))),
      'phone'            => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'email'            => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'linkedin'         => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'web_personal'     => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'sex'              => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'country'          => new sfValidatorString(array('max_length' => 200, 'required' => false)),  
      'workstation'      => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'sector'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'twitter'          => new sfValidatorPass(array('required' => false)),
      'facebook'         => new sfValidatorPass(array('required' => false)),
      'source'           => new sfValidatorPass(array('required' => false)),
      'other_sites_interest' => new sfValidatorPass(array('required' => false)),  
      'project_name'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),  
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
