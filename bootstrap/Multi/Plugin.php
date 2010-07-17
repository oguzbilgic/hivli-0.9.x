<?
class Core_Bootstrap_Multi_Plugin extends Core_Bootstrap_Multi_Abstract {
	
	function postDetectApp(){
		$Router = Core_Library_Loader::get('Router');
		$Plugin = Core_Library_Loader::get('Plugin');
		$Plugin->addPluginPath('application/'.$Router->getAppFolder().'plugin/');
		$Plugin->runPluginAction('preDetectApp');	
	}
	
	function preRoute(){
		Core_Library_Loader::get('Plugin')->runPluginAction('preRoute');
	}
	
	function postRoute(){
		Core_Library_Loader::get('Plugin')->runPluginAction('postRoute');
	}
	
	function preAction(){
		Core_Library_Loader::get('Plugin')->runPluginAction('preAction');		
	}
	
	function postAction(){
		Core_Library_Loader::get('Plugin')->runPluginAction('postAction');	
	}
	
	function preRender(){
		Core_Library_Loader::get('Plugin')->runPluginAction('preRender');
	}
	
	function postRender(){
		Core_Library_Loader::get('Plugin')->runPluginAction('postRender');
	}
	
}