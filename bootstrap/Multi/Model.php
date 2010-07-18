<?
class Core_Bootstrap_Multi_Model extends Core_Bootstrap_Multi_Abstract {
	
	function postDetectApp(){
		Hivli::get('Model')->addModelPath('library/');
		Hivli::get('Model')->addModelPath('hivli/');
		set_include_path(get_include_path() . PATH_SEPARATOR . 'library/'. PATH_SEPARATOR . 'hivli/');
	}	
}