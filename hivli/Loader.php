<?php
class Core_Library_Loader {
	
	public static $_library = array('Auth' => 'Core_Library_Auth',
									'Controller' => 'Core_Library_Controller',	
									'Plugin' => 'Core_Library_Plugin',	
						  			'Database' => 'Core_Library_Database',	
						  			'Error' => 'Core_Library_Error',	
						  			'Model' => 'Core_Library_Model',	
						  			'Router' => 'Core_Library_Router',	
						  			'View' => 'Core_Library_View',	
						  			'Test' => 'Core_Library_Test',	
						  			'Log' => 'Core_Library_Log',	
						  			'I18n' => 'Core_Library_I18n');

	public static function get($classNick){	
		require_once $classNick . '.php';
		eval("\$class = " . self::$_library[$classNick] . "::getInstance();");
		$loadedClass = $class;
	
		return $loadedClass;
	}
}