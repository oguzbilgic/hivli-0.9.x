<?
class ApiController extends Hivli_Controller_Abstract_Api {
	
	function IndexAction(){
 		$this->view->response = 'ok';
 		$this->view->data = array('title', 'name', 'user');
	}
}