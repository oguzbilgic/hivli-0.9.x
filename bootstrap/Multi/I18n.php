<?
class Core_Bootstrap_Multi_I18n extends Core_Bootstrap_Multi_Abstract {
	
	var $_languages = array('tr' => 'turkish');
							
	function postDetectApp(){
		$Router = Core_Library_Loader::get('Router');
		Core_Library_Loader::get('I18n')->setLanguagePath('application/'.$Router->getAppFolder().'i18n/');
	}
	
	function postRoute(){
		$Router = Core_Library_Loader::get('Router');
		$View = Core_Library_Loader::get("View");
		$I18n = Core_Library_Loader::get("I18n");
		$I18n->addLanguages($this->_languages);
		
		$language = $Router->getSubdomain();
		
		if (!in_array($language, $this->_languages)){
			$language = 'tr';
		}
		
		$I18n->setI18n($language);
		$View->setParam('lang', $I18n->getDictionary());
	}
}