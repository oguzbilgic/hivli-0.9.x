<?php
session_start();
class Core_Library_Auth {
	
	private $_authStatus = false;
	private $_permissions;
	private $_identityRole;
	private $_defaultRole;
	private $_connections;
	private $_securityTriger;
	private $_identity = NULL;
	private $_identityData;

	private static $_instance;
	
	private function __construcut(){
		self::getInstance();		
	}
	
	public static function getInstance(){
		if (null === self::$_instance){
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	function setAuthStatus($status){
		$this->_authStatus = $status;
	}
	
	function setPermissions($permissions){
		$this->_permissions = $permissions;
	}
	
	function allow($role, $controllers = NULL, $actions = NULL){
		if (is_array($controllers)){
			foreach ($controllers as $controller){
				$this->allow($role, $controller, $actions);
			}
		}
		if (!is_array($controllers) && is_array($actions)){
			foreach ($actions as $action){
				$this->allow($role, $controllers, $action);
			}
		}
		if (!is_array($controllers) && !is_array($actions)){
			if (isset($controllers)){
				if (isset($actions)){
					$this->_permissions[$role][$controllers][] = $actions;
				} else {
					$this->_permissions[$role][$controllers] = 'ALL';
				}
			} else {
				$this->_permissions[$role] = 'ALL';
			}
		}
	}
	
	function setDefaultRole($role){
		$this->_defaultRole = $role;
	}
	
	function getDefaultRole(){
		return $this->_defaultRole;
	}
	
	function setSecurityTriger($securityTriger){
		$this->_securityTriger = $securityTriger;
	}
	
	function connectRoles($bigRole, $smallRole){
		$this->_connections[$bigRole] = $smallRole;
	}
	
	function isAllowed($controller, $action, $role = NULL){
		if (!empty($role)){
			$role = $role;
		} else if (!empty($this->_identityRole)){
			$role = $this->_identityRole;
		} else {
			$role = $this->getDefaultRole();
		}
		
		$permissions = $this->_permissions[$role];
		$connections = $this->_connections;
		
		if(!$this->_authStatus){
			return TRUE;
		}
		
		if ($permissions == 'ALL'){
			return TRUE;
		}
		
		if(isset($permissions[$controller])){
			if ( $permissions[$controller] == 'ALL'){
				return TRUE; 
			}
			if (in_array($action, $permissions[$controller])){
				return TRUE;
			}	
		}

		if (isset($connections[$role])){
			$newRole = $connections[$role];
			if($this->isAllowed($controller, $action, $newRole)){
				return TRUE;
			}
		}
		return false;
	}
	
	public function hasIdentity(){
		$this->checkSession();
		if (!empty($this->_identity)){
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	public function checkSession(){
		if (!empty($_SESSION[$this->_securityTriger.'_user_id'])){
			$this->createIdentity($_SESSION[$this->_securityTriger.'_user_id']);
		}
	}
	
	public function createIdentity($id){
		$this->_identity = $id;
		$_SESSION[$this->_securityTriger.'_user_id'] = $id;
	}
	
	public function clearIdentity(){
		unset($_SESSION[$this->_securityTriger.'_user_id']);
		unset($this->_identity);
		unset($this->_identityRole);
	}
	
	public function recordIdentityData($data){
		$this->_identityData = $data;
	}
	
	public function getIdentityData($field = false){
		if (!$field){
			return $this->_identityData;
		}
		return $this->_identityData[$field];
	}
	
	public function getIdentity(){
		$this->checkSession();
		return $this->_identity;	
	}

	function setRole($role){
		$this->_identityRole = $role;
	}
	
	function getRole(){
		return $this->_identityRole;
	}
	
	function isActive(){
		if ($this->_authStatus){
			return TRUE;
		}
		return FALSE;
	}
}