<?
class IndexController extends Hivli_Controller_Abstract_Html {
	
	function indexAction(){
		/*
		$data = array(	'body' => 'Hello this is body',
						'title' => 'this is title',
						'user_id' => '10',
						'comment' => array(
											array('comment' => 'super'), 
											array('comment' => 'berbat')
							)
						);
		
		$post = new Row_Post();
		$post->fromArray($data);
		//print_r($post);
		$post->save();
		*/
 	}
 	
 	function apiAction(){
 		//api style view in non api controller
 		$this->view->response = 'ok';
 		$this->view->data = array('title', 'name', 'user');
 		Hivli::get('View')->setType('json');
 	}
}
 