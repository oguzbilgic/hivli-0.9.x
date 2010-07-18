<?
class IndexController extends Hivli_Controller_Abstract {
	
	function indexAction(){
		$post = Table_Post::db()->selectOne(array('id' => '1'));
		$post->id = 'asacscd';
		$post->validate();
						
		print_r($post);
 	}
}
 