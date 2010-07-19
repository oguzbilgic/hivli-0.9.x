<?
class Hivli_View_Helper_Html extends Hivli_View_Helper_Abstract {
	
	function css($cssFileName){
		echo '<link rel="stylesheet" type="text/css" href="http://' . $_SERVER["SERVER_NAME"] . '/'. Hivli::get('View')->getsitePath() . 
				'public/' . Hivli::get('View')->getPublicViewPath() . 'css/' . $cssFileName . '.css" media="screen" />
				';
	}
	
	function js($jsFileName){
		echo '<script type="text/javascript" src="http://' . $_SERVER["SERVER_NAME"] . '/' . Hivli::get('View')->getsitePath() . 'public/'. 
				Hivli::get('View')->getPublicViewPath() . 'js/' . $jsFileName . '.js"></script>
				';
	}
	
	function imageUrl($url){
		return 'http://' . $_SERVER['SERVER_NAME'] . '/' . Hivli::get('View')->getsitePath() . 'public/' . Hivli::get('View')->getPublicViewPath() . 'images/' . $url;
	}
}