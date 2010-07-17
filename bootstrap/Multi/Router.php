<?
class Core_Bootstrap_Multi_Router extends Core_Bootstrap_Multi_Abstract {
	
	function preDetectApp(){
		Hivli::get('Router')->addApplication('default', 'hivli/trunk/', 'default/');
		Hivli::get('Router')->setDefaultApplication('default');
	}
	
	function detectApp(){
		Hivli::get('Router')->detectApp();
	}
	
	function route(){
		Hivli::get('Router')->route();
	}
}