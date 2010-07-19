<?
class Hivli_View_Helper_Abstract {
	
	private function __call($method, $args) {
		if (is_callable($method)) {
			return call_user_func_array($method, $args);
		} else {
			return Hivli::get('View')->getHelper($method)->_direct($args);
		}
	}
}