<?
class Core_Bootstrap_Multi_View extends Core_Bootstrap_Multi_Abstract {
	
	function postDetectApp(){
		$View = Hivli::get('View');
		$Router = Hivli::get('Router');
		$View->setSitePath('hivli/');
		$View->setViewPath('application/' . $Router->getAppFolder() . 'view/');
		$View->setPublicViewPath($Router->getApplicationName() . '/');
	}
	
	function postRoute() {
		$View = Hivli::get('View');
		$Router = Hivli::get('Router');
		$View->getHelper('Layout')->activateLayout();
		$View->getHelper('Script')->setViewFile($Router->getControllerName() . '/' . $Router->getActionName());
	}
	
	function render(){
		$View = Hivli::get('View');
		$View->render();
	}
}