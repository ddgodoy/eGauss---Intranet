<?php

/**
 * ContractsIntermediationComments form.
 *
 * @package    egauss
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ContractsIntermediationCommentsForm extends BaseContractsIntermediationCommentsForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'id'                          => new sfWidgetFormInputHidden(),
      'comments'                    => new sfWidgetFormTextareaTinyMCE(array('config' => 'theme_advanced_buttons1 : "cut, copy, paste, images, bold, italic, underline, justifyleft, justifycenter, justifyright , outdent, indent, bullist, numlist, undo, redo, link",theme_advanced_buttons2 : "",theme_advanced_buttons3 : ""'),array('style' => 'width:800px;  height: 100px;', 'rows' => 10, 'class' => 'foo')),  
      'contracts_intermediation_id' => new sfWidgetFormInputHidden(),
      'app_user_id'                 => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'                          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'comments'                    => new sfValidatorPass(array('required' => true), array('required' =>'Ingrese un comentario')),
      'contracts_intermediation_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ContractsIntermediation'))),
      'app_user_id'                 => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AppUser'))),
    ));

    $this->setDefaults(array('contracts_intermediation_id'=>$this->getOption('contract_id'), 'app_user_id'=>$this->getOption('app_user_id')));
    
    $this->widgetSchema->setNameFormat('contracts_intermediation_comments[%s]');

  }
}
