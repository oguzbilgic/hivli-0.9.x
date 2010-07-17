<?
class DataApi_Youtube {

	const API_URL = "http://gdata.youtube.com/feeds/api/videos?v=2&alt=jsonc";
	
	private static function _createUrl($params = array()){
		$url = self::API_URL;
		foreach ($params as $key => $value){
			$url .= '&' . $key . '=' . urlencode($value); 
		}
		return $url;
	}
	
	private static function _getApiResponse($params = array()){
		return json_decode(file_get_contents(self::_createUrl($params)))->data;
	}
	
	public static function getVideos($string, $startIndex = 1, $maxResults = 25){
		return self::_getApiResponse(array('q' => $string, 'start-index' => $startIndex, 'max-results' => $maxResults));
	}
	
	public static function getVideo($id){
		return self::_getApiResponse(array('q' => $id, 'start-index' => 1, 'max-results' => 1))->items[0];
	}
}