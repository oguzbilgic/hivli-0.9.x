<?
class Hivli_Bootstrap_Router extends Hivli_Bootstrap_Abstract {
	
	function preDetectApp(){
		Hivli::get('Router')->addApplication('default', 'hivli/', 'default/');
		Hivli::get('Router')->setDefaultApplication('default');
	}
	
	function detectApp(){
		Hivli::get('Router')->detectApp();
	}
	
	function route(){
		Hivli::get('Router')->route();
	}
}