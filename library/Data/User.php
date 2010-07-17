<?php
class Data_User {

	public static function db() {
		return new Hivli_Database_Model('user');
	}

	public static function getUserById($id){
		$userData = self::db()->selectOne(array('id' => $id));
		return new Model_User($userData);
	}	
	
	public static function save(Model_User $user){		
		Data_User::db()->update($user->getAllData(), array('id' => $user->get('id')));
	}

	public static function isUserId($userId){
		$user = self::db()->selectOne(array('id' => $userId));
		if($user){
			return true;
		}
		return false;
	}

	public static function isNewUsername($username){
		$user = self::db()->selectOne(array('username' => $username));
		if($user){
			return false;
		}
		return true;
	}
	
	public static function isNewEmail($email){
		$user = self::db()->selectOne(array('email' => $email));
		if($user){
			return false;
		}
		return true;
	}
	
	public static function _isEmail($email){
		return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email);
	}
}