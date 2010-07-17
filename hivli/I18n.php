<?php
class Hivli_I18n {
	
 	private $_languages;
 	private $_languagePath;
 	private $_language;
 	private $_dictionary;
	
	private static $_instance;
	
	private function __construcut(){
		self::getInstance();
	}
	
	public static function getInstance(){
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

	function addLanguages($languages){
		foreach ($languages as $code => $folder){
			$this->_languages[$code] = $folder;
		}
	}
	
	function setLanguagePath($path){
		$this->_languagePath = $path;
	}

    function setI18n($language){
    	$this->_language = $language;
    	$this->_updateDictionary();
    }
	
    private function _updateDictionary(){
		$languageFolderName = $this->_languages[$this->_language];
		$languageFolderPath = $this->_languagePath.$languageFolderName;
	
		foreach (glob ($languageFolderPath.'/*.php') as $languageFilePath ) {
			require_once ($languageFilePath);
		}
	
    	$this->_dictionary = $lang;
    }
    
    function getDictionary(){
    	return $this->_dictionary;
    }
    
    function getWordDef($word){
    	return $this->_dictionary[$word];
    }   
}