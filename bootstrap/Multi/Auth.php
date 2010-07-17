<?php
class Core_Bootstrap_Multi_Auth extends Core_Bootstrap_Multi_Abstract {

	function preRoute(){
		
		ini_set('session.cookie_domain', 'oguzbilgic.com');
	
		$Auth = Hivli::get('Auth');
		$Auth->setAuthStatus(true);
		$Auth->setDefaultRole('guest');

		$Auth->allow('guest', array('index'));

		$Auth->allow('user', 'page');
		$Auth->connectRoles('user', 'guest');

		$Auth->allow('admin');
		$Auth->setSecurityTriger('qadtyvgwxejbylmgbycrg');
	}

	function postRoute(){
		$Auth = Hivli::get('Auth');
		$Router = Hivli::get('Router');
		$View = Hivli::get("View");

		if ($Auth->hasIdentity()){
			$user = Data_User::getUserById($Auth->getIdentity());

			if ($user){
				$Auth->recordIdentityData($user);
				$Auth->setRole($user->get('role'));
				$View->setParam('user', $user);
				Data_User::db()->update(array('last_action_date' => time()), array('id' => $user->get('id')));
			} else {
				$Auth->clearIdentity();
			}
		} else {
			$View->setParam('user', new Model_User(array('role' => 'guest')));
		}

		if (!$Auth->isAllowed($Router->getControllerName(), $Router->getActionName())){
			$Router->redirect(array('controller' => 'page', 'action' => 'login', 'error' => 'no_permission'));
		}
	}
}