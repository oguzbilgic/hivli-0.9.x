<?
class Hivli_View_Helper_Script extends Hivli_View_Helper_Abstract {
	
	var $_viewFile;

	function setViewFile($viewFile){
		$this->_viewFile = $viewFile;
	}

	function render(){
		foreach (Hivli::get('View')->getParams() as $key => $value){
			switch (Hivli::get('View')->getType()){
				case 'html':
					$$key = $value ;
					break;
				case 'json':
					$$key = json_encode($value);
			}
		}
		
		include $this->View->getViewPath() . 'script/' .$this->_viewFile . '.' . Hivli::get('View')->getType() . '.php';
	}

	function modul($modulName, $modulParams = NULL){
		$this->View->getHelper('Modul')->render($modulName, $modulParams);
	}
}