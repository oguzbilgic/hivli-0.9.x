<?php
include 'Helper/Abstract.php';
class Hivli_View_Helper {
	
	var $View;
	var $_helper;
	
	function __construct(Hivli_View $view){
		$this->View = $view;
	}
	
	function getHelper($helperName){
		if (isset($this->_helper[$helperName])){
			return $this->_helper[$helperName];
		} else {
			$helperFilePath = $this->View->getViewPath() . 'helper/' . $helperName . '.php';
			if (is_file($helperFilePath)){
				require_once $helperFilePath;
				$helperClassName = $helperName.'Helper';
				$this->_helper[$helperName] = new $helperClassName;
				return $this->_helper[$helperName];	
			} else {
				$helperFilePath = 'Helper/' . $helperName . '.php';
				require_once $helperFilePath;
				$helperClassName = 'Hivli_View_Helper_' . $helperName;
				$this->_helper[$helperName] = new $helperClassName($this->View);
				return $this->_helper[$helperName];					
			}
		}		
	}
}
