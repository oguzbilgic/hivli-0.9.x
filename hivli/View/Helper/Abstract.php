<?
class Hivli_View_Helper_Abstract {
	
	function __construct(){
		$this->View = Hivli::get('View');
	}
	
	private function __call($method, $args) {
		if (is_callable($method)) {
			return call_user_func_array($method, $args);
		} else {
			return $this->View->getHelper($method)->_direct($args);
		}
	}
}