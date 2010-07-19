<?
class Hivli_Controller_Abstract_Html extends Hivli_Controller_Abstract {
	
	function initBase(){
		Hivli::get('View')->setType('html');
		parent::initBase();
	}
}