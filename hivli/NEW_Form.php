<?
class Hivli_Form {
	
	private $_name;
	private $_method = 'post';
	private $_action;
	private $_fields;
	
	function __construct(){
		$this->_name = get_class();
	}
	
	function getName(){
		return $this->_name;
	}
	
	function getAction(){
		return $this->_action;
	}
	
	function setAction($action){
		$this->_action = $action;
	}
	
	function addField(Hivli_Form_Abstract $field){
		$this->_fields[$field->getName()] = $field;
	}
	
	function getField($fieldName){
		return $this->_fields[$fieldName];
	}
	
	function isValid($posts){
		foreach ($this->_fields as $field){
			if (!$field->isValid($posts[$field->getName()])){
				return false;
			}
		}
		return true;
	}
	
	function fill($posts){
		foreach ($this->_fields as $field){
				$field->setValue($posts[$field->getName()]);
		}
	}
		
	function setLabel($fieldName, $label){
		$this->getField($fieldName)->setLabel($label);
	}
	
	function setValue($fieldName, $value){
		$this->getField($fieldName)->setValue($value);
	}
	
	function setMethod($method){
		$this->_method = $method;
	}
	
	function getMethod(){
		return $this->_method;
	}
	
	function getForm(){
		$form = '<form method="' . $this->getMethod() . '" action="' . $this->getAction() . '">';
		
		foreach ($this->_fields as $field){
			$form .= $field->getForm();
		}
		
		$form .= '<input class="button" type="submit" value="Submit">';
		$form .= '</form>';
		
		return $form;
	}
}




/**
 * form
 */
class registerForm extends Hivli_Form {
	
	function __construct(){
		parent::__construct();
		
		$name = new Hivli_Form_Text('name');
		$name->setAsRequired();

		$username = new Hivli_Form_Text('username');
		$username->setAsRequired();

		$email = new Hivli_Form_Text('email');
		$email->setAsRequired();
		$email->setAsEmail();

		$password = new Hivli_Form_Password('password');
		$password->setAsRequired();
		
		$this->addField($name);
		$this->addField($username);
		$this->addField($email);
		$this->addField($password);
	}
}

/**
 * controller
 */
$form = new registerForm;
$posts = Hivli::get('Router')->getPosts();

if ($form->isValid($posts)){
	echo ' onayy<br/>';
	$form->fill($posts);
}

/**
 * View
 */

$form->setLabel('name' , 'Isim : ');
$form->setLabel('username' , 'Kullanici adi : ');
$form->setLabel('email' , 'Email : ');
$form->setLabel('password' , 'Sifre : ');
$form->setAction('/mp3iti/');
echo $form->getForm();