<?
class Hivli_Form_Abstract {
	
	private $_name;
	private $_label;
	private $_value;
	private $_isRequired = false;
	
	function __construct($name){
		$this->_name = $name;
	}
	
	function getName(){
		return $this->_name;
	}
	
	function setAsRequired(){
		$this->_isRequired = true;
	}
	
	function isRequired(){
		return $this->_isRequired;
	}
	
	function setLabel($label){
		$this->_label = $label;
	}
	
	function setValue($value){
		$this->_value = $value;
	}
	
	function getValue(){
		return $this->_value;
	}
	
	function getLabel(){
		if (empty($this->_label)){
			return $this->getName();
		}
		return $this->_label;
	}
	
	function hasValue(){
		if(!empty($this->_value)){
			return true;
		}
		return false;
	}
	
	function getForm(){}
	
	function isValid($value = NULL){
		if (empty($value) AND $this->isRequired()){
			return false;
		}
		return true;
	}
}