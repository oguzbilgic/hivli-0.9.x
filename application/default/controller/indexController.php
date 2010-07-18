<?
class IndexController extends Hivli_Controller_Abstract_Html {
	
	function indexAction(){
		
		$newUser = new User();
		$newUser['username'] = 'yenasasi uye';
		$newUser['name'] = 'Oguz';
		$newUser['password'] = 'pass';
		$newUser['email'] = 'deneme@google.com';
		
		try {
			$newUser->save();
		} catch(Doctrine_Validator_Exception $e){
			print_r($newUser->getErrorStack()->toArray());
		}
 	}
}
 