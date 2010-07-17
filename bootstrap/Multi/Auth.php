<?php
class Core_Bootstrap_Multi_Auth extends Core_Bootstrap_Multi_Abstract {

	function preRoute(){
			
		Hivli::get('Auth')->setAuthStatus(true);
		Hivli::get('Auth')->setDefaultRole('guest');

		Hivli::get('Auth')->allow('guest', array('index'));

		Hivli::get('Auth')->allow('user', 'page');
		Hivli::get('Auth')->connectRoles('user', 'guest');

		Hivli::get('Auth')->allow('admin');
		Hivli::get('Auth')->setSecurityTriger('qadtyvgwxejbylmgbycrg');
	}

	function postRoute(){

		if (Hivli::get('Auth')->hasIdentity()){
			$user = Data_User::getUserById(Hivli::get('Auth')->getIdentity());

			if ($user){
				Hivli::get('Auth')->recordIdentityData($user);
				Hivli::get('Auth')->setRole($user->get('role'));
				Hivli::get("View")->setParam('user', $user);
				Data_User::db()->update(array('last_action_date' => time()), array('id' => $user->get('id')));
			} else {
				Hivli::get('Auth')->clearIdentity();
			}
		} else {
			Hivli::get("View")->setParam('user', new Model_User(array('role' => 'guest')));
		}

		if (!Hivli::get('Auth')->isAllowed(Hivli::get('Router')->getControllerName(), Hivli::get('Router')->getActionName())){
			Hivli::get('Router')->redirect(array('controller' => 'page', 'action' => 'login', 'error' => 'no_permission'));
		}
	}
}