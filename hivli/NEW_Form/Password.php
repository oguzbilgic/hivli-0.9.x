<?
class Core_Library_Form_Password extends Core_Library_Form_Abstract{
	
	function getForm(){
		$form = '<label>' . $this->getLabel() . '</label> ';
		$form .= '<input ';
		$form .= 'type="password" ';
		$form .= 'name="' . $this->getName() . '" ';
		if ($this->hasValue()){
			$form .= ' value="' . $this->getValue() . '" ';
		}
		$form .= '>';
		return $form;
	}	
}