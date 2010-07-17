<?
class Hivli_View_Helper_Fill extends Hivli_View_Helper_Abstract {

	function fill($params, $string){
		foreach ($params as $key => $value){
			$string = str_replace('{'.$key.'}', $value, $string);
		}
		return $string;
	}
	
	function _direct($args){
		return $this->fill($args['0'], $args['1']);
	}	
}