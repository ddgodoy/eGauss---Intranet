<?php

class ServiceForgotenPassword
{
	/**
	 * Send token to user by email
	 *
	 * @param string $user_email
	 * @param string $user_name
	 * @param string $token
	 * @return boolean
	 */
	public static function sendUserTokenByEmail($user_email, $user_name, $token)
	{
		sfProjectConfiguration::getActive()->loadHelpers(array("Partial", "Url"));

		$i18N = sfContext::getInstance()->getI18N();
		$pRef = sfConfig::get('app_project_reference_name');
		$sUrl = url_for('authentication/requestNewPassword', true).'?token='.$token;

		$mailer = Swift_Mailer::newInstance(Swift_MailTransport::newInstance());
		$mailBody = get_partial('authentication/forgotenMailToUser', array('project'=>$pRef, 'user'=>$user_name, 'url'=>$sUrl));

		$message = Swift_Message::newInstance($pRef.' - '.$i18N->__('New password request'))
			         ->setFrom(array(sfConfig::get('app_no_replay_email_account') => $pRef))
			         ->setTo(array($user_email => $user_name))
			         ->setBody($mailBody, 'text/html');

		return $mailer->send($message);
	}
	
	/**
	 * Check if user token is valid
	 *
	 * @param string $token
	 * @return mixed $user_object
	 */
	public static function isValidToken($token)
	{
		$oUser = AppUserTable::getInstance()->findOneByRecoverToken($token);

		return $oUser;
	}

} // end class