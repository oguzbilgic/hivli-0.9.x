<?
class Hivli_View_Helper_Json {
	
	function render(){
		echo json_encode(Hivli::get('View')->getParams());		
	}	
}