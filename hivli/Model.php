<?php
include 'Model/Abstract.php';
class Hivli_Model {
	
	private $_models;
	
	private static $_instance;
	
	private function __construcut(){
		self::getInstance();
	}
	
	public static function getInstance(){
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
	
	function addModelPath($path){
		$this->_modelPaths[] = $path;
	}
		
	function getClass($className){
		$className = str_replace('_', '/', $className);
		foreach($this->_modelPaths as $path){
			if (is_file($path . $className . '.php')){
				require_once($path . $className . '.php');
			}
		}
	}
}

function __autoload($class_name)
{
    $Model = Hivli::get('Model');
	$Model->getClass($class_name);
}