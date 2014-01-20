<?php

class myUser extends sfBasicSecurityUser
{
        /**
	 * Automatic notification to customers on real_property registration
	 *
	 * @param boolean $go
	 * @param integer $real_property_id
	 * @param string $hostname
	 */
	public static function notifyCustomersAboutThis($real_property_id, $hostname)
	{
		if ($real_property_id) {
			$customers = SearchMatchTable::getInstance()->matchThisPropertyAndCustomersSearch($real_property_id);
			
			if (count($customers) > 0) {
				$mail_titulo = 'Una nueva propiedad en liprandi bienes raices coincide con tu búsqueda';
				
				ServiceOutgoingMessages::sendToMultipleAccounts(
					$customers,
					'property/notifyCustomers',
					array(
		  			'subject'   => $mail_titulo,
		  			'to_partial'=> array(
		  				'titulo'  => $mail_titulo,
		  				'sitio'   => sfConfig::get('app_project_url_name'),
		  				'go_to'   => 'http://'.$hostname.'/property?id='.$real_property_id
		  			)
		  		)
				);
			}
		}
	}
        
        /**
	 * Automatic notification to vendor on real_property registration
	 *
	 * @param boolean $go
	 * @param integer $real_property_id
	 * @param string $hostname
         * @param int $vendor 
	 */
	public static function notifyVendorAboutThis($real_property_id, $hostname, $vendor_id)
	{
                $vendor = AppUserTable::getInstance()->findOneById($vendor_id);
		if ($vendor) {
				$mail_titulo = 'Una nueva propiedad en liprandi bienes raíces se a registrado a tu nombre';
				
				ServiceOutgoingMessages::sendToSingleAccount(
                                        $vendor->getName().' '.$vendor->getLastName(),
					$vendor->getEmail(),
					'property/notifyVendor',
					array(
		  			'subject'   => $mail_titulo,
		  			'to_partial'=> array(
		  				'titulo'  => $mail_titulo,
		  				'sitio'   => sfConfig::get('app_project_url_name'),
		  				'go_to'   => 'http://'.$hostname.'/property-edit/'.$real_property_id
		  			)
		  		)
				);
			}
	}
        
        /**
	 * Automatic notification to user on response contact registration
	 *
	 * @param integer $contact_id
	 * @param string $hostname
         * @param int $user_id 
	 */
	public static function notifyUserResponseAboutThis($contact_id, $hostname, $user_id)
	{
                $vendor = AppUserTable::getInstance()->findOneById($user_id);
		if ($vendor) {
				$mail_titulo = 'Una consulta en liprandi bienes raíces se a registrado a tu nombre';
				
				ServiceOutgoingMessages::sendToSingleAccount(
                                        $vendor->getName().' '.$vendor->getLastName(),
					$vendor->getEmail(),
					'contact/notifyUser',
					array(
		  			'subject'   => $mail_titulo,
		  			'to_partial'=> array(
		  				'titulo'  => $mail_titulo,
		  				'sitio'   => sfConfig::get('app_project_url_name'),
		  				'go_to'   => 'http://'.$hostname.'/contact-response/'.$contact_id
		  			)
		  		)
				);
			}
	}
}
