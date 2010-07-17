<?
class Core_Libarary_Model_Abstract {
	
	private $_data;
	
	function __construct($_data){
		$this->_data = $_data;
	}
	
	function get($key){
		return $this->_data[$key];
	}
	
	function set($key, $value =	 NULL){
		if (!empty($value)){
			$this->_data[$key] = $value;
		}
		return $this;
	}
	
	function getAllData(){
		return $this->_data;
	}
}
