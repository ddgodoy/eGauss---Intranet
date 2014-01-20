<?php

class Pop3
{
	static protected $socket;
	static protected $connect; 
	
	protected static function is_connect() { return self::$connect; }
	protected static function pop3_reply() { $line = fgets(self::$socket, 1024); return $line; }
	protected static  function pop3_command($command) { fputs(self::$socket, $command); $line = self::pop3_reply(); return $line; }
	
	/**
	 * leer mails rebotados
	 * @return array
	 */
	public static function getRebotados()
	{
		$mError = array();
		$pop = self::pop3php('rebotes@liprandibienesraices.com', 'la-virginia123');
	
		if ($pop) {
			$totla_email = self::get_total_msg();
				
			if ($totla_email > 0)
			{	   
				for ($i=1; $i <= $totla_email; $i++)
				{
					$mError[$i]['subject']   =	self::get_msg($i,'Subject').'<br>'.self::get_msgCuer($i);
                                        $mError[$i]['message_id'] =	self::get_msg($i,'Message-ID'); 
					
					self::delete_msg($i);
				}
			}
		}
		self::pop3_quit();
		
		return $mError;
	}
	
	/**
	 * login pop3
	 *
	 * @param string $username
	 * @param string $password
	 * @return boolean
	 */
	protected static function pop3php($username, $password)
	{
		self::pop3_connect();
		
		if (self::$socket)
		{
			$username = $username;

			if (self::validate_user($username))
			{
				if (self::validate_pass($password)) {
					self::$connect = 1; return true;
				} else {
				return false;
				}
			} else {
				return false;
			}
		}
	}
	
	/**
	 * pop3 connect
	 */
	protected static function pop3_connect()
	{
		self::$socket = fsockopen("mail.icox.com", "110");
		
		if (!self::$socket) {
			echo "Socket connection fail<br />"; exit();
		} else {
			$line = self::pop3_reply();
			$status = self::is_ok($line);
			
			if (!$status)
			{
				fclose(self::$socket);

				self::$socket = -1; echo "Socket connection fail<br />"; exit();
			}
		}
	}

	/**
	 * is ok
	 *
	 * @param string $cmd
	 * @return boolean
	 */
	protected static function is_ok($cmd)
	{	
		$status = substr($cmd, 0, 1);
		
		if ($status != "+") {
			return 0;
		}
		return 1;
	}
	
	/**
	 * Validate username
	 *
	 * @param string $username
	 * @return boolean
	 */
	protected static function validate_user($username)
	{
		$command = "USER ".$username."\r\n";
		$reply = self::pop3_command($command);
		$rtn = self::is_ok($reply);
		
		if (!$rtn) {
			fclose(self::$socket);
			self::$socket = -1;
		}
		return $rtn;
	}
	
	/**
	 * Validate password
	 *
	 * @param string $password
	 * @return boolean
	 */
	protected static function validate_pass($password)
	{
		$command = "PASS ".$password."\r\n";
		$reply = self::pop3_command($command);
		$rcc = self::is_ok($reply);
		
		if (!$rcc)
		{
			fclose(self::$socket);
			self::$socket = -1;
		}
		return $rcc;
	}

	/**
	 * Get total messages
	 *
	 * @return unknown
	 */
	protected static function get_total_msg()
	{
		$reply = self::pop3_command("STAT\r\n");
		$mail  = explode(" ", $reply);
		$total = $mail[1];

		return $total;
	}
	
	/**
	 * Get message
	 *
	 * @param integer $msgNum
	 * @param string $etiqueta
	 * @return string
	 */
	protected static function get_msg($msgNum, $etiqueta)
	{	
		$command = "RETR ".$msgNum."\r\n";
		$reply   = self::pop3_command($command);
		$rtn     = self::is_ok($reply);
		$subject = '';
		
		if ($rtn)
		{
			$count  = 0;
			$header = array();

			while(!preg_match("~^\.\r\n~", $reply))
			{
				$reply = self::pop3_reply();
				$header[$count] = $reply;
				$count++;
			}
			while(list($lineNum, $line) = each($header))
			{
				if (preg_match("~^$etiqueta:(.*)~i", $line, $match))
				{
					if ($etiqueta == 'Subject')
					{
						$subject .= trim($match[1]).'  ';
						$subject = htmlspecialchars($subject);
					}
					else
					{
						$subject = trim($match[1]);
						$subject = htmlspecialchars($subject);
					}
				}
			}
			if ($subject == '') { return "None"; }
			if ($etiqueta == 'Message-ID') { $subject = str_replace(array('&lt;','&gt;'), '', $subject); }
		}
		return $subject;
	}
	
	/**
	 * Get message content
	 *
	 * @param integer $msgNum
	 * @return string
	 */
	protected static function get_msgCuer($msgNum)
	{
		$temp    = '';
		$command = "RETR ".$msgNum."\r\n";
		$reply   = self::pop3_command($command);
		$rtn     = self::is_ok($reply);
		
		if ($rtn)
		{
			$count = 0;
			$msg   = array();
			$temp  = '';

			while(!preg_match("~^\.\r\n~", $reply))
			{
				$reply = self::pop3_reply();

				if ($count >= 39 && $count <= 49 ) {
					$temp .= $reply.'<br />';
				}
				$count++;
			}
		}
		return $temp;
	}      
	
	/**
	 * delete message
	 *
	 * @param integer $msgNum
	 */
	protected static function delete_msg($msgNum)
	{
		if (empty($msgNum)) {
			$sessid = session_id(); echo "$sessid"; exit();
		}
		else
		{
			$command = "DELE ".$msgNum."\r\n";
			$reply   = self::pop3_command($command);
			$status  = self::is_ok($reply);
			
			if (!$status) {
				fclose(self::$socket); self::$socket = -1; exit();
			}
		}
	}
	
	/**
	 * pop3 quit
	 */
	protected static function pop3_quit()
	{
		$reply = self::pop3_command("QUIT\r\n");
		$rtn   = self::is_ok($reply);
		
		if ($rtn) {
			fclose(self::$socket); self::$socket = -1;
		}
	}

} // end class