<?
class Core_Bootstrap_Multi_Controller extends Core_Bootstrap_Multi_Abstract {
	
	function preAction(){
		Hivli::get('Controller')->setControllerName(Hivli::get('Router')->getControllerName());
		Hivli::get('Controller')->setActionName(Hivli::get('Router')->getActionName());
		Hivli::get('Controller')->setControllerPath('application/' . Hivli::get('Router')->getAppFolder() . 'controller/');
	}
	
	function action(){
		Hivli::get('Controller')->action();
		
		$viewParams = Hivli::get('Controller')->getController()->getViewParams();
		if(!empty($viewParams)){
			Hivli::get('View')->setViewParamFromArray($viewParams);	
		}
	}
}