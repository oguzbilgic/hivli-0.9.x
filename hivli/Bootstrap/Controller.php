<?
class Hivli_Bootstrap_Controller extends Hivli_Bootstrap_Abstract {
	
	function preAction(){
		Hivli::get('Controller')->setControllerName(Hivli::get('Router')->getControllerName());
		Hivli::get('Controller')->setActionName(Hivli::get('Router')->getActionName());
		Hivli::get('Controller')->setControllerPath('application/' . Hivli::get('Router')->getAppFolder() . 'controller/');
	}
	
	function action(){
		Hivli::get('Controller')->action();
	}
}