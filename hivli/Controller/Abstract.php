<?php
class Hivli_Controller_Abstract {
	
	function initBase() {			
		$this->view = new Object();
	}
		
	function initStart(){}
		
	function initStop(){}
	
	function getViewParams(){
		return $this->view->get(); 
	}
}