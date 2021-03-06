<?
class Hivli_Bootstrap_View extends Hivli_Bootstrap_Abstract {
	
	function postDetectApp(){
		Hivli::get('View')->setSitePath('hivli/trunk/');
		Hivli::get('View')->setViewPath('application/' . Hivli::get('Router')->getAppFolder() . 'view/');
		Hivli::get('View')->setPublicViewPath(Hivli::get('Router')->getApplicationName() . '/');
	}
	
	function postRoute() {
		Hivli::get('View')->getHelper('Layout')->activateLayout();
		Hivli::get('View')->getHelper('Script')->setViewFile(Hivli::get('Router')->getControllerName() . '/' . Hivli::get('Router')->getActionName());
	}
	
	function postAction() {
		$viewParams = Hivli::get('Controller')->getController()->getParams();
		Hivli::get('View')->setViewParamFromArray($viewParams);	
	}
	
	function render(){
		Hivli::get('View')->render();
	}
}