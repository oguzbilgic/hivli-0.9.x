<?
class Hivli_Controller_Abstract_Html extends Hivli_Controller_Abstract {
	
	function initBase() {			
		$this->view = new Object();
	}
		
	function getParams(){
		return $this->view->get(); 
	}
	
	function getType(){
		return 'html';
	}
}