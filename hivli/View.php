<?php
include 'View/Helper.php';
class Hivli_View {
	
	private  $_viewPath;
	private  $_sitePath;
	private  $_viewParams = array(); 
	private  $_viewType; 
	private  $_render = true;
	
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
	
	function setSitePath($sitePath){
		$this->sitePath = $sitePath;
	}
	
	function setViewPath($path){
		$this->_viewPath = $path;
	}
	
	function setPublicViewPath($path){
		$this->_publicViewPath = $path;
	}
	
	function setType($viewType){
		$this->_viewType = $viewType;
	}
	
	function setViewParamFromArray($viewParamFromArray = array()){
		foreach ($viewParamFromArray as $key => $value){
			$this->_viewParams[$key] = $value;
		}
	}
	
	function setParam($key, $value){
		$this->_viewParams[$key] = $value;
	}

	function getSitePath(){
		return $this->sitePath;
	}
	
	function getViewPath(){
		return $this->_viewPath;
	}
	
	function getPublicViewPath(){
		return $this->_publicViewPath;
	}
	
	function getType(){
		return $this->_viewType;
	}
		
	function getParam($key){
		return $this->_viewParams[$key];
	}
	
	function getParams(){
		return $this->_viewParams;
	}
	
	function getHelper($helperName){
		return Hivli_View_Helper::getInstance()->getHelper($helperName);
	}
	
	function isActive(){
		return $this->_render;
	}
	
	function deactivate(){
		$this->_render = false;
	}
	
	function deactivateLayout(){
		$this->getHelper('Layout')->deactivateLayout();
	}
	
	function render(){
		if(!$this->isActive()) return false;
		switch($this->getType()){
			case 'html':
				if($this->getHelper('Layout')->isActive()){
					$this->getHelper('Layout')->render();
				} else {
					$this->getHelper('Script')->render();
				}
				break;
			case 'json':
				$this->getHelper('Json')->render();
				break;
		}
		
	}
}