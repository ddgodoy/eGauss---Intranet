<?php

class forgotenPasswordForm extends sfForm
{
	public function configure()
	{
		$i18N = sfContext::getInstance()->getI18N();

		$this->setWidgets(array(
			'email' => new sfWidgetFormInput(array(), array('style'=>'width:250px;')),
			'captcha' => new sfWidgetFormReCaptcha(array('public_key' => sfConfig::get('app_recaptcha_public_key'))),
		));
		$this->setValidators(array(
			'email' => new sfValidatorEmail (
				array('required' => true), 
				array('required'=>$i18N->__('Enter the email', NULL, 'errors'), 'invalid'=>$i18N->__('The email seems incorrect', NULL, 'errors'))
			),
			'captcha' => new sfValidatorReCaptcha(
				array('private_key' => sfConfig::get('app_recaptcha_private_key')),
				array('captcha'=>$i18N->__('Wrong captcha', NULL, 'errors'))),
		));

		$this->widgetSchema->setNameFormat('forgoten_password[%s]');

		## post validator
    $this->validatorSchema->setPostValidator(
      new sfValidatorCallback(array('callback' => array($this, 'checkUserEmail')))
    );
	}
	
	/**
	 * Check if the email is registered in DB
	 *
	 * @param mixed $validator
	 * @param mixed $values
	 * @return mixed
	 */
	public function checkUserEmail($validator, $values)
  {
  	$postEmail = $values['email'];
  	$i18N = sfContext::getInstance()->getI18N();

  	if (!empty($postEmail) && !$oUser = AppUserTable::getInstance()->findOneByEmail($postEmail)) {
  		throw new sfValidatorError($validator, $i18N->__('The user is not registered', NULL, 'errors'));
  	}
    return $values;
  }

} // end class