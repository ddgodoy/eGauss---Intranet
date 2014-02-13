<?php
	use Doctrine\Common\ClassLoader;
	use Sirprize\Basecamp\Id;
	use Sirprize\Basecamp\Cli;
	use Sirprize\Basecamp\Comment\Collection;

/**
 * Bascamp functions
 */
class RunBasecamp
{
	/**
	 * Get service object
	 *
	 * @return object
	 */
	public static function getService()
	{
		$conf = self::getConnValues();
		$base = sfConfig::get('sf_root_dir').'/lib/vendor/basecamp';
		
		require_once $base.'/vendor/autoload.php';

		$logWriter = new \Zend_Log_Writer_Stream($base.'/log/'.gmdate('Ymd').'.log');
		$log = new \Zend_Log($logWriter);

		$service = new Cli($conf);
		$service->setLog($log);

		return $service;
	}

	/**
	 * Get new id object
	 *
	 * @param mixed $id
	 * @return object
	 */
	public static function getNewId($id) { return new Id($id); }
	
	/**
	 * Get basecamp config values
	 *
	 * @return array
	 */
	public static function getConnValues()
	{
		$config = array
		(
			'baseUri'  => 'https://icox.basecamphq.com/',
			'username' => 'dgodoy@icox.com',
			'password' => 'novell31'
		);
		return $config;
	}
	
	/**
	 * Get array de proyectos
	 *
	 * @return array
	 */
	public static function todosLosProyectos()
	{
		// $item->getCreatedOn();

		$service = self::getService();
		$arrDatos = array();
		$projects = $service->getProjectsInstance();
		$projects->startAll();
		
		if (count($projects) > 0)
		{
			foreach ($projects as $item) { $id = ''.$item->getId(); $arrDatos[$id] = $item->getName(); }
		}
		natcasesort($arrDatos);
		
		return $arrDatos;
	}

} // end class