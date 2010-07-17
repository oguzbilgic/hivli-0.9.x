<?php
class Data_Post {

	public static function db() {
		return new Hivli_Database_Table_Abstract('post');
	}
}