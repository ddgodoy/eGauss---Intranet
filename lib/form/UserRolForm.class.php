<?php
/**
 * AppUser form.
 *
 * @package    sf_icox
 * @subpackage form
 * @author     pinika
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UserRolForm extends BaseAppUserForm
{
  public function configure()
  {
    $i18N                = sfContext::getInstance()->getI18N();
    $sf_user             = sfContext::getInstance()->getUser();
    $contact             = [''=>'Seleccionar']+AppUserTable::getInstance()->getAllForSelectContact(2);
    $array_affiliated    = [''=>'Seleccionar']+RegisteredCompanies::getArrayByType(['0','1']);

    $this->setWidgets(array(
      'id'                      => new sfWidgetFormInputHidden(),  
      'title'                   => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:400px;')),  
      'name'                    => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:400px;')),
      'last_name'               => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:400px;')),
      'email'                   => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:400px;')),  
      'phone'                   => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:400px;')),
      'skype'                   => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:400px;')),
      'job_title'               => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:400px;')),
      'source'                  => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:400px;')), 
      'city'                    => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:400px;')),
      'postal_code'             => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:400px;')),
      'address'                 => new sfWidgetFormInputText(array(), array('class'=>'form_input', 'style'=>'width:400px;')),  
      'app_user_id'             => new sfWidgetFormChoice(array('choices'=>$contact), array('style'=>'width:400px;')),
      'registered_companies_id' => new sfWidgetFormChoice(array('choices'=>$array_affiliated), array('style'=>'width:400px;')),  
      'contact_time_from'       => new sfWidgetFormTime(array('with_seconds' => true,'format'=> '%hour% : %minute% : %second%')),  
      'contact_time_to'         => new sfWidgetFormTime(array('with_seconds' => true,'format'=> '%hour% : %minute% : %second%')),    
      'enabled'                 => new sfWidgetFormInputCheckbox(),
      'company_id'              => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),  
      'title'              => new sfValidatorString(array('max_length' => 100, 'required' => false)),  
      'name'               => new sfValidatorString(array('max_length' => 100, 'required' => true), array('required'=>$i18N->__('Enter the name', NULL, 'errors'))),
      'last_name'          => new sfValidatorString(array('max_length' => 100, 'required' => true), array('required'=>$i18N->__('Enter the last name', NULL, 'errors'))),
      'email'              => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'phone'              => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'skype'              => new sfValidatorString(array('max_length' => 200, 'required' => false)),  
      'job_title'          => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'source'             => new sfValidatorString(array('max_length' => 100, 'required' => false)),  
      'city'               => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'postal_code'        => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'address'            => new sfValidatorString(array('max_length' => 100, 'required' => false)),  
      'app_user_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AppUser'), 'required' => false)),  
      'registered_companies_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RegisteredCompanies'), 'required' => false)),  
      'enabled'            => new sfValidatorBoolean(array('required' => false)),
      'company_id'         => new sfValidatorInteger(),
      'contact_time_from'  => new sfValidatorTime(array('required' => false), array('invalid' => 'Horario de contacto desde Inválida')),  
      'contact_time_to'    => new sfValidatorTime(array('required' => false), array('invalid' => 'Horario de contacto hasta Inválida')),    
    ));

    if(in_array($sf_user->getAttribute('user_role'),array('super_admin')))
    {   
        $choices_array= array(0=>$i18N->__('Select', NULL, 'messages'),1=>$i18N->__('Super Admin', NULL, 'messages'),2=>$i18N->__('Socio', NULL, 'messages'), 3=>$i18N->__('Clientes', NULL, 'messages'), 4=>$i18N->__('Socios Empresa', NULL, 'messages'));
        
        $this->setWidget('user_role_id', new sfWidgetFormChoice(array('choices'=>$choices_array),array('style'=>'width:400px;')));
   
    
        $this->setValidator('user_role_id', new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UserRole')), array('required'=>$i18N->__('Select a role', NULL, 'errors'), 'invalid'=>$i18N->__('Select the user role', NULL, 'errors'))));
     }    
    
    
    $this->validatorSchema->setPostValidator(
      new sfValidatorSchemaCompare('contact_time_from', sfValidatorSchemaCompare::LESS_THAN_EQUAL, 'contact_time_to',
        array(),
        array('invalid' => 'El Horario de contacto desde debe ser anterior a Horario de contacto hasta')
      )
    );
    
    
    $this->setDefault('country_id', 1);
    
    $this->widgetSchema->setNameFormat('user_rol[%s]');
  }

} // end class