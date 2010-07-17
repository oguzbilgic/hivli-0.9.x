<?
class Core_Bootstrap_Multi_I18n extends Core_Bootstrap_Multi_Abstract {
	
	var $_languages = array('tr' => 'turkish');
							
	function postDetectApp(){
		$Router = Hivli::get('Router');
		Hivli::get('I18n')->setLanguagePath('application/'.$Router->getAppFolder().'i18n/');
	}
	
	function postRoute(){
		$Router = Hivli::get('Router');
		$View = Hivli::get("View");
		$I18n = Hivli::get("I18n");
		$I18n->addLanguages($this->_languages);
		
		$language = $Router->getSubdomain();
		
		if (!in_array($language, $this->_languages)){
			$language = 'tr';
		}
		
		$I18n->setI18n($language);
		$View->setParam('lang', $I18n->getDictionary());
	}
}