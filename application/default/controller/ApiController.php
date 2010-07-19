<?
class ApiController extends Hivli_Controller_Abstract_Api {
	
	function IndexAction(){
		$this->view->response = array('response' => 'ok', 'data' => array('title', 'name', 'user'));
		Hivli::get('View')->setType('json');
	}
}