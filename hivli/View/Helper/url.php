<?
class Hivli_View_Helper_Url extends Hivli_View_Helper_Abstract {
	
	function url($url, $isFilter = FALSE){
		if($isFilter){
			$url = $this->_filterUrl($url);
		}
		return 'http://' . $_SERVER['SERVER_NAME'] . '/' . Hivli::get('View')->getsitePath() . $url;
	}
	
	function imageUrl($url){
		return 'http://' . $_SERVER['SERVER_NAME'] . '/' . Hivli::get('View')->getsitePath() . 'public/' . Hivli::get('View')->getPublicViewPath() . 'images/' . $url;
	}
	
	function _filterUrl($string){
		$string = str_replace(' ', '-', $string);
		return $string;
	}
	
	function _direct($args){
		if (isset($args['1'])){
			return $this->url($args['0'], $args['1']);
		} else {
			return $this->url($args['0']);
		}
	}
}