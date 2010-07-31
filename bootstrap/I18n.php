<?
class Bootstrap_I18n extends Hivli_Bootstrap_Abstract {
	
	var $_languages = array('tr' => 'turkish');
							
	function postDetectApp(){
		Hivli::get('I18n')->setLanguagePath('application/'.Hivli::get('Router')->getAppFolder().'i18n/');
	}
	
	function postRoute(){
		Hivli::get("I18n")->addLanguages($this->_languages);
		
		$language = Hivli::get('Router')->getSubdomain();
		
		if (!in_array($language, $this->_languages)){
			$language = 'tr';
		}
		
		Hivli::get("I18n")->setI18n($language);
	}
}