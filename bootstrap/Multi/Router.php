<?
class Core_Bootstrap_Multi_Router extends Core_Bootstrap_Multi_Abstract {
	
	function preDetectApp(){
		$Router = Core_Library_Loader::get('Router');
		$Router->addApplication('default', 'hivli/trunk/', 'default/');
		$Router->setDefaultApplication('default');
	}
	
	function detectApp(){
		$Router = Core_Library_Loader::get('Router');
		$Router->detectApp();
	}
	
	function route(){
		$Router = Core_Library_Loader::get('Router');
		$Router->route();
	}
}