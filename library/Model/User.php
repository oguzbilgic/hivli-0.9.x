<?php
class Model_User extends Core_Libarary_Model_Abstract {
	
	function __tostring(){
		return $this->get('name');
	}
	
	function isAdmin(){
		if ($this->get('role') == 'admin'){
			return true;
		}
		return false;
	}
	
	function getRole(){
		return $this->get('role');
	}
}
