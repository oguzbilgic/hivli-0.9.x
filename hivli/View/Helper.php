<?php
include 'Helper/Abstract.php';
class Hivli_View_Helper {
	
	/**
	 * Collection of preloaded helper classes. 
	 *
	 * @var array 
	 */
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
	
	/**
	 * Returns requested helper class
	 *	
	 * @param string $helperName Name of the requested helper
	 * @return Hivli_View_Helper_Abstract
	 */
	public function getHelper($helperName){
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
