<?
class Hivli_View_Helper_Layout {
	
	var $_layoutFileName = 'layout';
	var $_isActive = false;
	
	function activateLayout(){
		$this->_isActive = true;
	}
	
	function deactivateLayout(){
		$this->_isActive = false;
	}
	
	function isActive(){
		return $this->_isActive;
	}

	function setLayoutFileName($layoutName){
		$this->_layoutFileName = $layoutName;
	}
	
	function getLayoutFileName(){
		return $this->_layoutFileName;
	}
	
	function render(){
		foreach (Hivli::get('View')->getParams() as $key => $value){
			switch (Hivli::get('View')->getType()){
				case 'html':
					$$key = $value ;
					break;
				case 'json':
					$$key = json_encode($value);
			}
		}
		
		include Hivli::get('View')->getViewPath() . 'layout/' . $this->getLayoutFileName() . '.' . Hivli::get('View')->getType() . '.php';
	}
}