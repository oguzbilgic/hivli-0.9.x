<?
class Hivli_View_Helper_I18n {

	function translate($params, $string){
		/*
			TODO this function has to know what is the name of translated array .
		*/
		foreach ($params as $key => $value){
			$string = str_replace('{'.$key.'}', $value, $string);
		}
		return $string;
	}
}