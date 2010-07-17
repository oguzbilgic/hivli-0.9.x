<?php
class Hivli_Controller_Abstract {
	
	function initBase() {			
		$this->view = new Object();
		$this->Router = Hivli::get('Router');
		$this->Controller = Hivli::get('Controller');
		$this->Model = Hivli::get('Model');
		$this->View = Hivli::get('View');
		$this->Auth = Hivli::get('Auth');
	}
		
	function initStart(){}
		
	function initStop(){}
	
	function getViewParams(){
		return $this->view->get(); 
	}
}