<?php
include 'Controller/Abstract.php';
class Hivli_Controller {
	
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
		$this->_controllerClassName = $controllerName.'Controller';
	}
	
	function setActionName($actionName){
		$this->_actionName = $actionName;
		$this->_actionMethodName = $actionName.'Action';
	}

	function setControllerPath($path){
		$this->_controllerPath = $path;
	}
	
	function getController(){
		return $this->_controller;
	}
		
	function _initStart(){
		$this->_includeController();
		$this->_controller = new $this->_controllerClassName;
		$this->_controller->initBase();
		$this->_controller->initStart();
	}
	
	function action(){
		$this->_initStart();
		$method = $this->_actionMethodName;
		$this->_controller->$method();
		$this->_initStop();
	}
	
	function _initStop(){
		$this->_controller->initStop();
	}

	private function _includeController(){
		$controllerFileName = $this->_controllerPath.$this->_controllerClassName.'.php';
		include $controllerFileName;
	}
}