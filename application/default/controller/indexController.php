<?
class IndexController extends Hivli_Controller_Abstract {
	
	function indexAction(){
		$post = Data_Post::db()->select(array('id' => '1'), null, array('user_id'));
						
		print_r($post);
 	}
}
 