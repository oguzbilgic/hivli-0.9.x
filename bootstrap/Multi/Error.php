<? 
class Core_Bootstrap_Multi_Error extends Core_Bootstrap_Multi_Abstract {
	
	var $pages = array('index_index');
	
	function postRoute(){
		$page = Hivli::get('Router')->getControllerName() . '_' . Hivli::get('Router')->getActionName();
		if (!in_array($page, $this->pages)){
			Hivli::get('Router')->redirect(array('controller' => 'index', 'action' => 'index', 'error' => '404'));
		}
	}
}