<?php

class ServiceOutgoingMessages
{
	/**
	 * Send single email
	 *
	 * @param string $name
	 * @param string $email
	 * @param string $partial
	 * @param array $data
	 * @return boolean
	 */
	public static function sendToSingleAccount($name, $email, $partial, $data)
	{
		sfProjectConfiguration::getActive()->loadHelpers(array("Partial"));

		$transport = Swift_SmtpTransport::newInstance(sfConfig::get('app_outgoing_smtp_server'), sfConfig::get('app_outgoing_smtp_port'), 'ssl')
    						 ->setUsername(sfConfig::get('app_outgoing_smtp_account'))
    						 ->setPassword(sfConfig::get('app_outgoing_smtp_password'));

		$obMailer = Swift_Mailer::newInstance($transport);
               
		$mailBody = get_partial($partial, array('data' => $data['to_partial']));

		$oMessage = Swift_Message::newInstance($data['subject'])
			         ->setFrom(array(sfConfig::get('app_no_replay_email_account') => sfConfig::get('app_project_reference_name')))
			         ->setTo(array($email => $name))
			         ->setBody($mailBody, 'text/html');

		return $obMailer->send($oMessage);
	}
	
	/**
	 * Send multiple emails
	 *
	 * @param array $accounts
	 * @param string $partial
	 * @param array $data
	 * @param mixed $attach
	 * @return integer
	 */
	public static function sendToMultipleAccounts($accounts, $partial, $data, $attach = false)
	{
		sfProjectConfiguration::getActive()->loadHelpers(array("Partial"));

		$transport = Swift_SmtpTransport::newInstance(sfConfig::get('app_outgoing_smtp_server'), sfConfig::get('app_outgoing_smtp_port'), 'ssl')
    						 ->setUsername(sfConfig::get('app_outgoing_smtp_account'))
    						 ->setPassword(sfConfig::get('app_outgoing_smtp_password'));

		$obMailer = Swift_Mailer::newInstance($transport);

		## limit of emails in persistent connection: 100
		$obMailer->registerPlugin(new Swift_Plugins_AntiFloodPlugin(100));

//		$logger = new Swift_Plugins_Loggers_ArrayLogger();
//		$obMailer->registerPlugin(new Swift_Plugins_LoggerPlugin($logger));
		
		$mailBody = get_partial($partial, array('data' => $data['to_partial']));

		$oMessage = Swift_Message::newInstance($data['subject'])
			         ->setFrom(array(sfConfig::get('app_no_replay_email_account') => sfConfig::get('app_project_reference_name')))
			         ->setBody($mailBody, 'text/html');

                if ($attach) {
                  $oMessage->attach(Swift_Attachment::fromPath($attach));
                }
                $numSent = 0;
                $failedRecipients = array();

                            foreach ($accounts as $address => $name)
                            {
                              $oMessage->setTo(array($address => $name));
                              $numSent += $obMailer->send($oMessage, $failedRecipients);
                            }
                            return $numSent;
                    }

} // end class