<?
class Core_Bootstrap_Multi_View extends Core_Bootstrap_Multi_Abstract {
	
	function postDetectApp(){
		$View = Core_Library_Loader::get('View');
		$Router = Core_Library_Loader::get('Router');
		$View->setSitePath('hivli/');
		$View->setViewPath('application/' . $Router->getAppFolder() . 'view/');
		$View->setPublicViewPath($Router->getApplicationName() . '/');
	}
	
	function postRoute() {
		$View = Core_Library_Loader::get('View');
		$Router = Core_Library_Loader::get('Router');
		$View->getHelper('Layout')->activateLayout();
		$View->getHelper('Script')->setViewFile($Router->getControllerName() . '/' . $Router->getActionName());
	}
	
	function render(){
		$View = Core_Library_Loader::get('View');
		$View->render();
	}
}