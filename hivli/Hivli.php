<?php
class Hivli {
	
	public static $_classes = array('auth',
									'bootstrap',
									'controller',
									'database',
									'i18n',
									'log',
									'model',
									'plugin',
									'router',
									'test',
									'view'
									);

	public static function get($classNick){	
		if(in_array(strtolower($classNick), self::$_classes)){
			require_once ucfirst(strtolower($classNick)) . '.php';
			$className = 'Hivli_' . ucfirst(strtolower($classNick));
			eval("\$class = " . $className . "::getInstance();");
			return $class;
		}
	}
}

class HVL extends Hivli {
	
	public static function GT($classNick){
		return parent::get($classNick);
	}
}