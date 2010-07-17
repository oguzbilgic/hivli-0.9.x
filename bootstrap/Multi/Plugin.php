<?
class Core_Bootstrap_Multi_Plugin extends Core_Bootstrap_Multi_Abstract {
	
	function postDetectApp(){
		$Plugin = Hivli::get('Plugin');
		Hivli::get('Plugin')->addPluginPath('application/'.Hivli::get('Router')->getAppFolder().'plugin/');
		Hivli::get('Plugin')->runPluginAction('preDetectApp');	
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