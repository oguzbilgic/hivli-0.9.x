<?php
class Bootstrap_Auth extends Hivli_Bootstrap_Abstract {

	function preRoute(){
			
		Hivli::get('Auth')->setAuthStatus(true);
		Hivli::get('Auth')->setDefaultRole('guest');

		Hivli::get('Auth')->allow('guest', array('index', 'api', 'error'));

		Hivli::get('Auth')->allow('user', 'user');
		Hivli::get('Auth')->connectRoles('user', 'guest');

		Hivli::get('Auth')->allow('admin');
		Hivli::get('Auth')->setSecurityTriger('qadtyvgwxejbylmgbycrg');
	}

	function postRoute(){

		if (Hivli::get('Auth')->hasIdentity()){
			$user = UserTable::findById(Hivli::get('Auth')->getIdentity());

			if ($user){
				Hivli::get('Auth')->recordIdentityData($user);
				Hivli::get('Auth')->setRole($user->get('role'));
				Hivli::get("View")->setParam('user', $user);
			} else {
				Hivli::get('Auth')->clearIdentity();
			}
		} else {
			$guest = new User();
			$guest->fromArray(array('role' => 'guest'));
			Hivli::get("View")->setParam('user', $guest);
		}

		if (!Hivli::get('Auth')->isAllowed(Hivli::get('Router')->getControllerName(), Hivli::get('Router')->getActionName())){
			Hivli::get('Router')->redirect(array('controller' => 'page', 'action' => 'login', 'error' => 'no_permission'));
		}
	}
}