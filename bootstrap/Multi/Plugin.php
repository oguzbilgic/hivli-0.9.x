<?
class Core_Bootstrap_Multi_Plugin extends Core_Bootstrap_Multi_Abstract {
	
	function postDetectApp(){
		$Router = Hivli::get('Router');
		$Plugin = Hivli::get('Plugin');
		$Plugin->addPluginPath('application/'.$Router->getAppFolder().'plugin/');
		$Plugin->runPluginAction('preDetectApp');	
	}
	
	function preRoute(){
		Hivli::get('Plugin')->runPluginAction('preRoute');
	}
	
	function postRoute(){
		Hivli::get('Plugin')->runPluginAction('postRoute');
	}
	
	function preAction(){
		Hivli::get('Plugin')->runPluginAction('preAction');		
	}
	
	function postAction(){
		Hivli::get('Plugin')->runPluginAction('postAction');	
	}
	
	function preRender(){
		Hivli::get('Plugin')->runPluginAction('preRender');
	}
	
	function postRender(){
		Hivli::get('Plugin')->runPluginAction('postRender');
	}
	
}