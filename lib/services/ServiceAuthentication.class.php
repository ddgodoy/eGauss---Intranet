<?php
/**
 * 
 */
class ServiceAuthentication
{
	/**
	 * Check user login / password values
	 *
	 * @param string $email
	 * @param string $password
	 * @param mixed $i18N
	 * @return array
	 */
	public static function validateUserLogin($email, $password, $i18N)
	{
		$aResult = array('continue'=>false, 'error'=>'');

		if ($oUser = AppUserTable::getInstance()->findOneByEmail($email)) {
			## user is enabled
			if ($oUser->getEnabled()) {
				## check password
				if (sha1($password . $oUser->getSalt()) == $oUser->getPassword()) {
					self::startSessionProcess($oUser);

					$aResult['continue'] = true;
				} else {
					$aResult['error'] = $i18N->__('The password is not correct', NULL, 'errors');
				}
			} else {
				$aResult['error'] = $i18N->__('The user is disabled', NULL, 'errors');
			}
		} else {
			$aResult['error'] = $i18N->__('The user is not registered', NULL, 'errors');
		}
		return $aResult;
	}
	
	/**
	 * Compulsive login by email
	 *
	 * @param string $email
	 */
	public static function compulsiveLogin($email)
	{
		if ($oUser = AppUserTable::getInstance()->findOneByEmail($email)) {
			if ($oUser->getEnabled()) {
				self::startSessionProcess($oUser);
			}
		}
	}
	
	/**
	 * Start user session
	 *
	 * @param mixed $oUser
	 */
	public static function startSessionProcess($oUser)
	{
		## set user last login date
		$oUser->setLastAccess(date('Y-m-d H:i:s'));
		$oUser->save();

		$sessionUser = sfContext::getInstance()->getUser();

		$sessionUser->setAuthenticated(true);
		$sessionUser->setAttribute('user_id'       , $oUser->getId());
		$sessionUser->setAttribute('user_name'     , $oUser->getName());
                $sessionUser->setAttribute('user_last_name', $oUser->getLastName());
		$sessionUser->setAttribute('user_photo'    , $oUser->getPhoto());
		$sessionUser->setAttribute('user_role'     , $oUser->UserRole->getCode());
		$sessionUser->setAttribute('user_company'  , $oUser->getCompanyId());
		$sessionUser->setAttribute('user_company_name', $oUser->Company->getName());
		$sessionUser->setAttribute('user_company_logo', $oUser->Company->getLogo());

		## add credentials
		$role_credentials = explode(',', $oUser->UserRole->getCredentials());
		$sessionUser->addCredentials($role_credentials);
	}

	/**
	 * Close user session
	 */
	public static function closeSessionProcess()
	{
		$sessionUser = sfContext::getInstance()->getUser();

		$sessionUser->setAuthenticated(false);
		$sessionUser->clearCredentials();
		$sessionUser->getAttributeHolder()->clear();
	}

} // end class