<?php

/**
 * authentication actions.
 *
 * @package    sf_icox
 * @subpackage authentication
 * @author     pinika
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class authenticationActions extends sfActions
{
 /**
  * User already authenticated
  */
  public function preExecute()
  {
       if ($this->getUser()->isAuthenticated()) { $this->redirect('@homepage'); }
  }
 
 /**
  * Executes login action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {      
        ServiceAuthentication::closeSessionProcess();
  	$i18N = $this->getContext()->getI18N();

  	$this->auth_error    = array();
        $this->auth_email    = trim($request->getParameter('auth_email'));
        $this->auth_password = trim($request->getParameter('auth_password'));
        
        ## post request
        if ($request->getParameter('auth_submit')) {
                if (empty($this->auth_email)) {
                        $this->auth_error['email'] = $i18N->__('Enter the email', NULL, 'errors');
                }
                if (empty($this->auth_password)) {
                        $this->auth_error['password'] = $i18N->__('Enter the password', NULL, 'errors');
                }
                if (!$this->auth_error) {
                        ## check user login values
                        $statusLogin = ServiceAuthentication::validateUserLogin($this->auth_email, $this->auth_password, $i18N);

                        if ($statusLogin['continue']) {
                                if ($this->getUser()->hasCredential('clientes') || $this->getUser()->hasCredential('socios_empresa'))
                                {
                                    $this->redirect('@contracts');
                                }
                                else 
                                {
                                    $this->redirect('@homepage');
                                }
                                
                        } else {
                                $this->auth_error['validate'] = $statusLogin['error'];
                        }
                }
        }
       // $this->setLayout('layout_login');
  }

  /**
   * Executes Forgoten password action
   *
   * @param sfWebRequest $request
   */
  public function executeForgotenPassword(sfWebRequest $request)
  {
  	$this->otherError = '';
  	$this->processCompleted = false;
  	$this->form = new forgotenPasswordForm();

  	if ($request->getMethod() == 'POST') {
  		$captcha = array(
				'recaptcha_challenge_field' => $request->getParameter('recaptcha_challenge_field'),
				'recaptcha_response_field'  => $request->getParameter('recaptcha_response_field'),
			);
			$this->form->bind(array_merge($request->getParameter($this->form->getName()), array('captcha' => $captcha)));

			if ($this->form->isValid()) {
				$user_token = sha1(MD5(uniqid('')));
				$oUser = AppUserTable::getInstance()->findOneByEmail($this->form->getValue('email'));
				$sendEmail = ServiceForgotenPassword::sendUserTokenByEmail($oUser->getEmail(), $oUser->getName(), $user_token);
				
				if ($sendEmail) {
					## Update user token
					$oUser->setRecoverToken($user_token);
					$oUser->save();
					##
					$this->processCompleted = true;
				} else {
					$this->otherError = 'Cannot send the email';
		}}}
  	//$this->setLayout('layout_login');
  }
  
  /**
   * Executes Request new password action
   *
   * @param sfWebRequest $request
   */
  public function executeRequestNewPassword(sfWebRequest $request)
  {
  	$this->rp_error = '';
  	$this->rp_token = $request->getParameter('token');

  	if (empty($this->rp_token)) {
  		$this->rp_error = 'empty token';
  	} else {
			$oUser = ServiceForgotenPassword::isValidToken($this->rp_token);

			if ($oUser) {
				$this->rp_email = $oUser->getEmail();
	  		$this->rp_password = trim($request->getParameter('rp_password'));
				$this->rp_repeat_password = trim($request->getParameter('rp_repeat_password'));

				if ($request->getMethod() == 'POST') {
					if (!empty($this->rp_password)) {
						if (!empty($this->rp_repeat_password)) {
							$this->rp_error = AppUser::checkProfilePassword($this->rp_password, $this->rp_repeat_password);
	
							if (empty($this->rp_error)) {
								## change password
								$oUser->setPassword($this->rp_password);
								$oUser->setRecoverToken(NULL);
								$oUser->save();
	
								## start session for user and redirect
								ServiceAuthentication::compulsiveLogin($oUser->getEmail());
	
								$this->redirect('home/index');
							}
						} else { $this->rp_error = 'Repeat the password'; }
					} else { $this->rp_error = 'Enter the password'; }}
			} else { $this->rp_error = 'token not valid'; }
  	}
  	//$this->setLayout('layout_login');
  }

} // end class