<?
class Core_Library_View_Helper_Modul extends Core_Library_View_Helper_Abstract {
	
	function render($modulName, $modulParams = NULL){
		foreach ($this->View->getParams() as $key => $value){
			$$key = $value ;
		}
		$$modulName = $modulParams;
		include $this->View->getViewPath() . 'modul/' . $modulName . '.php';
	}
	
	function _direct($args){
		if (isset($args['1'])){
			$this->render($args['0'], $args['1']);
		} else {
			$this->render($args['0']);
		}
	}
}

