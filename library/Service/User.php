<?
class Service_User {
	
	const REGISTER_EMPTY_FORM = 'empty_form';
	const REGISTER_USED_USERNAME = 'used_username_or_email';
	const REGISTER_NOT_EMAIL = 'not_valid_email';
	const REGISTER_NOT_USERNAME = 'not_valid_username';
	const REGISTER_SUCCESS = 'success';
	
	const UPDATE_EMPTY_FORM = 'empty_form';
	const UPDATE_NOT_EMAIL = 'not_valid_email';
	const UPDATE_SUCCESS = 'success';
	
	public static function login($username = NULL, $password = NULL){
		if (empty($username) OR empty($password)){
			return false;
		}
		
		$user = Data_User::db()->selectOne(array('username' => $username, 'password' => $password));
		if ($user){
			Hivli::get('Auth')->createIdentity($user['id']);
			Data_User::db()->update(array('last_action_date' => time()), array('id' => $user['id']));
			return true;
		}
		
		return false;
	}
	
	public static function register($username = NULL, $password = NULL, $name = NULL, $email = NULL, $role = NULL){
	
		//Finish action if form is empty
		if (empty($username) OR empty($password) OR empty($name) OR empty($email) OR empty($role)){
			return Service_User::REGISTER_EMPTY_FORM;
		}
		
		//Finish action if email is not valid
		if (!Data_User::_isEmail($email)){
			return Service_User::REGISTER_NOT_EMAIL;
		}
		
		//Finish action if username is not valid
		if (!ctype_alnum($username) OR strlen($username) >= 25 OR strlen($username) <= 5){
			return Service_User::REGISTER_NOT_USERNAME;
		}
		
		//Finish action if email or username is already taken
		if (!Data_User::isNewUsername($username) OR !Data_User::isNewEmail($email)){
			return Service_User::REGISTER_USED_USERNAME;
		}
		
		//register user
		$newUser = array('username' => $username, 'password' => $password, 'name' => $name, 
						 	'email' => $email, 'date_added' => time(), 'role' => $role);
						
		Data_User::db()->add($newUser);
		return Service_User::REGISTER_SUCCESS;
	}
	
	public static function update($password = NULL, $name = NULL, $email = NULL, $id = NULL){
		
		//Finish action if form is empty
		if (empty($password) OR empty($name) OR empty($email) OR empty($id)){
			return Service_User::UPDATE_EMPTY_FORM;
		}
		
		//Finish action if email is not valid
		if (!Data_User::_isEmail($email)){
			return Service_User::UPDATE_NOT_EMAIL;
		}
		
		//update user
		$update = array('password' => $password, 'email' => $email, 'name' => $name);
		Data_User::db()->update($update, array('id' => $id));
		return Service_User::UPDATE_SUCCESS;
	}
}