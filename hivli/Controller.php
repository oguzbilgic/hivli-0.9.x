<?php
include 'Controller/Abstract.php';
class Hivli_Controller {

	const CONTROLLER_SUFFIX = 'Controller';
	const ACTION_SUFFIX = 'Action';
	
	private $_controllerPath;
	private $_controllerName;
	private $_controllerClassName;
	private $_controller;
	private $_actionName;
	private $_actionMethodName;
	
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
	
	function setControllerName($controllerName){
		$this->_controllerName = $controllerName;
		$this->_controllerClassName = $controllerName . self::CONTROLLER_SUFFIX;
	}
	
	function setActionName($actionName){
		$this->_actionName = $actionName;
		$this->_actionMethodName = $actionName . self::ACTION_SUFFIX;
	}

	function setControllerPath($path){
		$this->_controllerPath = $path;
	}
	
	function getController(){
		return $this->_controller;
	}
			
	function action(){
		include $this->_controllerPath . $this->_controllerClassName . '.php';
		$method = $this->_actionMethodName;
		
		$this->_controller = new $this->_controllerClassName;
		$this->_controller->initBase();
		$this->_controller->initStart();
		$this->_controller->$method();
		$this->_controller->initStop();
	}
}