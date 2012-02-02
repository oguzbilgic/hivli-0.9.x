<?
class Hivli_View_Helper_Html {
  
  function css($cssFileName){
    echo '<link rel="stylesheet" type="text/css" href="http://' . $_SERVER["SERVER_NAME"] 
      . '/css/' . $cssFileName . '.css" media="screen" />';
  }
  
  function js($jsFileName, $version = null){
    echo '<script type="text/javascript" src="http://' . $_SERVER["SERVER_NAME"] . '/js/' . $jsFileName . '.js' . $version . '"/>';
  }
  
  function image($url){
    return 'http://' . $_SERVER['SERVER_NAME'] . '/images/' . $url;
  }
  
  function uri($uri){
    $uri = str_replace(' ', '-', $uri);
    return 'http://' . $_SERVER['SERVER_NAME'] . '/' . Hivli::get('View')->getsitePath() . $uri;
  }
  
  function googleJs($jsLibrary){
    switch($jsLibrary){
      case 'jquery':
        echo '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"/>';
        break;
    }
  }
}
