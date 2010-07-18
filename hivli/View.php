<?php
include 'View/Helper.php';
class Hivli_View {
	
	private  $_viewPath;
	private  $_sitePath;
	private  $_viewParam = array(); 
	private  $_render = true;
	private  $_helpers;
	
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

	function getSitePath(){
		return $this->sitePath;
	}
	
	function getViewPath(){
		return $this->_viewPath;
	}
	
	function getPublicViewPath(){
		return $this->_publicViewPath;
	}
	
	function deactivate(){
		$this->_render = false;
	}
	
	function deactivateLayout(){
		$this->getHelper('Layout')->deactivateLayout();
	}
	
	function setViewParamFromArray($viewParamFromArray = array()){
		foreach ($viewParamFromArray as $key => $value){
			$this->_viewParam[$key] = $value;
		}
	}
	
	function setParam($key, $value){
		$this->_viewParam[$key] = $value;
	}
	
	function getParam($key){
		return $this->_viewParam[$key];
	}
	
	function getParams(){
		return $this->_viewParam;
	}
	
	function getHelper($helperName){
		if (!empty($this->_helper)){
			return $this->_helper->getHelper($helperName);
		} else {
			$this->_helper = new Hivli_View_Helper($this);
			return $this->_helper->getHelper($helperName);
		}
	}

	function render(){
		if($this->_render){
			if($this->getHelper('Layout')->isActive()){
				$this->getHelper('Layout')->render();
			} else {
				$this->getHelper('Script')->render();
			}
		}	
	}
}