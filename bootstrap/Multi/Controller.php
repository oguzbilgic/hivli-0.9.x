<?
class Core_Bootstrap_Multi_Controller extends Core_Bootstrap_Multi_Abstract {
	
	function preAction(){
		$Controller = Hivli::get('Controller');
		$Router = Hivli::get('Router');
		$Controller->setControllerName($Router->getControllerName());
		$Controller->setActionName($Router->getActionName());
		$Controller->setControllerPath('application/' . $Router->getAppFolder() . 'controller/');
	}
	
	function action(){
		$Controller = Hivli::get('Controller');
		$Controller->action();
		
		$viewParams = $Controller->getController()->getViewParams();
		if(!empty($viewParams)){
			$view = Hivli::get('View');
			$view->setViewParamFromArray($viewParams);	
		}
	}
}