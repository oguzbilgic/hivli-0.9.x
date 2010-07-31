<?
class Hivli_View_Helper_Modul {
	
	function render($modulName, $modulParams = NULL){
		foreach (Hivli::get('View')->getParams() as $key => $value){
			$$key = $value ;
		}
		$$modulName = $modulParams;
		include Hivli::get('View')->getViewPath() . 'modul/' . $modulName . '.php';
	}
}

