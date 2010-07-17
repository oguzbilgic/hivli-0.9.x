<?
class Core_Bootstrap_Multi_Router extends Core_Bootstrap_Multi_Abstract {
	
	function preDetectApp(){
		$Router = Hivli::get('Router');
		$Router->addApplication('default', 'hivli/trunk/', 'default/');
		$Router->setDefaultApplication('default');
	}
	
	function detectApp(){
		$Router = Hivli::get('Router');
		$Router->detectApp();
	}
	
	function route(){
		$Router = Hivli::get('Router');
		$Router->route();
	}
}