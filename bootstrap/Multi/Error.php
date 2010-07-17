<? 
class Core_Bootstrap_Multi_Error extends Core_Bootstrap_Multi_Abstract {
	
	var $pages = array('index_index', 
						);
	
	function postRoute(){
		$Router = Core_Library_Loader::get('Router');
		$page = $Router->getControllerName().'_'.$Router->getActionName();
		if (!in_array($page, $this->pages)){
			$Router->redirect(array('controller' => 'index', 'action' => 'index', 'error' => '404'));
		}
	}
}