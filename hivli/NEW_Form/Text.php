<?
class Hivli_Form_Text extends Hivli_Form_Abstract{
	
	private $_isEmail = false;
	
	function isValid($value = NULL){
		//check as email
		if ($this->isEmail() AND !$this->_isValidEmail($value)){
			return false;
		}
		
		return parent::isValid($value);
	}
	
	function setAsEmail(){
		$this->_isEmail = true;
	}
	
	function isEmail(){
		return $this->_isEmail;
	}
	
	function _isValidEmail($email){
		return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email);
	}
	
	function getForm(){
		$form = '<label>' . $this->getLabel() . '</label>';
		$form .= '<input ';
		$form .= 'type="text"  name="' . $this->getName() . '" ';
		if ($this->hasValue()){
			$form .= ' value="' . $this->getValue() . '" ';
		}
		$form .= '>';
		return $form;
	}	
}