<?
class Core_Library_View_Helper_I18n extends Core_Library_View_Helper_Abstract {

	function fill($params, $string){
		foreach ($params as $key => $value){
			$string = str_replace('{'.$key.'}', $value, $string);
		}
		return $string;
	}
}