<?php
class Core_Library_Controller_Abstract {
	
	function initBase() {			
		$this->view = new Object();
		$this->Router = Core_Library_Loader::get('Router');
		$this->Controller = Core_Library_Loader::get('Controller');
		$this->Model = Core_Library_Loader::get('Model');
		$this->View = Core_Library_Loader::get('View');
		$this->Auth = Core_Library_Loader::get('Auth');
	}
		
	function initStart(){}
		
	function initStop(){}
	
	function getViewParams(){
		return $this->view->get(); 
	}
}

//old classes
class Core_Controller_Base extends Core_Library_Controller_Abstract{}