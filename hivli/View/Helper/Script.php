<?
class Hivli_View_Helper_Script extends Hivli_View_Helper_Abstract {
	
	var $_viewFile;

	function setViewFile($viewFile){
		$this->_viewFile = $viewFile;
	}

	function render(){
		foreach ($this->View->getParams() as $key => $value){
			$$key = $value ;
		}
		include $this->View->getViewPath() . 'script/' .$this->_viewFile . '.php';
	}

	function modul($modulName, $modulParams = NULL){
		$this->View->getHelper('Modul')->render($modulName, $modulParams);
	}
}