<?
class Core_Bootstrap_Multi_I18n extends Core_Bootstrap_Multi_Abstract {
	
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
		Hivli::get("View")->setParam('lang', Hivli::get("I18n")->getDictionary());
	}
}