<?php
class metaWidget extends Hivli_View_Helper_Widget_Abstract {
	
	function action(){
		$Router = Hivli::get('Router');
		$View = Hivli::get("View");
		$I18nHelper = $View->getHelper('I18n');
		$I18n = Hivli::get("I18n");
		
		$dictionary = $I18n->getDictionary();
		
		$title = $dictionary['meta_title'];
		$desc = $dictionary['meta_desc'];
		$keyword = $dictionary['meta_keyword'];
		
		if ($Router->isParam('music')){
			$music = str_replace('-', ' ', $Router->getParam('music'));
			$title = $I18nHelper->fill(array('string' => $music), $dictionary['music_title']);
			$desc = $I18nHelper->fill(array('string' => $music), $dictionary['music_desc']);
			$keyword = $I18nHelper->fill(array('string' => $music), $dictionary['music_keyword']);
		}
		
		$this->view->title = $title;
		$this->view->desc = $desc;
		$this->view->keyword = $keyword;
	}
}