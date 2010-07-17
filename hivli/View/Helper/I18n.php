<?
class Hivli_View_Helper_I18n extends Hivli_View_Helper_Abstract {

	function fill($params, $string){
		foreach ($params as $key => $value){
			$string = str_replace('{'.$key.'}', $value, $string);
		}
		return $string;
	}
}