<?
include 'Widget/Abstract.php';
class Hivli_View_Helper_Widget extends Hivli_View_Helper_Abstract {
	
	function render($widgetName, $widgetParams = NULL){
		include Hivli::get('View')->getViewPath() . 'widget/' . $widgetName . 'Widget.php';
		$widgetClassName = $widgetName . 'Widget';
		$widget = new $widgetClassName;
		$widget->prepare();
		$widget->action();
		
		foreach (Hivli::get('View')->getParams() as $key => $value){
			$$key = $value ;
		}
		
		foreach ($widget->view->get() as $key => $value){
			$$key = $value;
		}
		
		include Hivli::get('View')->getViewPath() . 'widget/view/' . $widgetName . '.php';
	}
	
	function _direct($args){
		if (isset($args['1'])){
			$this->render($args['0'], $args['1']);
		} else {
			$this->render($args['0']);
		}
	}
}

