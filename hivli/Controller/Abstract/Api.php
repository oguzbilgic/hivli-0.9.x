<?
class Hivli_Controller_Abstract_Api extends Hivli_Controller_Abstract {
	
	function initBase(){
		Hivli::get('View')->setType('json');
		parent::initBase();
	}
}