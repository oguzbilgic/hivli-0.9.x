<?
class Core_Bootstrap_Multi_Php extends Core_Bootstrap_Multi_Abstract {
	
	function postRoute(){
		ini_set("memory_limit", "100M");
		ini_set("default_charset", "utf-8");
	}
	
	function postRender(){
		//echo 'Peak: ' . number_format(memory_get_peak_usage(), 0, '.', ',') . " bytes <br />";
		//echo 'End: ' . number_format(memory_get_usage(), 0, '.', ',') . " bytes";
	}
}