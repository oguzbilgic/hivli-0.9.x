<?
class Hivli_Controller_Abstract_Html extends Hivli_Contoller_Abstract {
	
	function initBase() {			
		$this->view = new Object();
	}
		
	function getViewParams(){
		return $this->view->get(); 
	}
}