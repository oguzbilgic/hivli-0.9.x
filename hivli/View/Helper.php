<?php
class Hivli_View_Helper {

	private $_helper;
	
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

	public function getHelper($helperName){
		$helperName = ucfirst(strtolower($helperName));
		if (isset($this->_helper[$helperName])){
			return $this->_helper[$helperName];
		} else {
			$helperFilePath = Hivli::get('View')->getViewPath() . 'helper/' . $helperName . '.php';
			if (is_file($helperFilePath)){
				require_once $helperFilePath;
				$helperClassName = $helperName.'Helper';
				$this->_helper[$helperName] = new $helperClassName;
				return $this->_helper[$helperName];	
			} else {
				$helperFilePath = 'Helper/' . $helperName . '.php';
				require_once $helperFilePath;
				$helperClassName = 'Hivli_View_Helper_' . $helperName;
				$this->_helper[$helperName] = new $helperClassName();
				return $this->_helper[$helperName];					
			}
		}		
	}
}

function helper($helper){
	return Hivli::get('View')->getHelper($helper);
}
