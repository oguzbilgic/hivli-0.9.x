<?
class Hivli_Bootstrap_Model extends Hivli_Bootstrap_Abstract {
	
	function postDetectApp(){		
		Hivli::get('Model')->addModelPath('application/' . Hivli::get('Router')->getAppFolder() . 'model/');
		set_include_path(get_include_path() . PATH_SEPARATOR . 'library/'. PATH_SEPARATOR . 'hivli/');
	}	
}