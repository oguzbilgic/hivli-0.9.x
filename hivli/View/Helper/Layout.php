<?
class Hivli_View_Helper_Layout extends Hivli_View_Helper_Abstract {
	
	var $_layoutFile = 'layout';
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

	function setLayoutFile($layout){
		$this->_layoutFile = $layout;
	}
	
	function getLayoutFile(){
		return $this->_layoutFile;
	}
	
	function render(){
		foreach ($this->View->getParams() as $key => $value){
			$$key = $value ;
		}
		
		include $this->View->getViewPath() . 'layout/' . $this->getLayoutFile() . '.php';
	}
	
	
	
	function content(){
		$this->View->getHelper('Script')->render();
	}
	
}