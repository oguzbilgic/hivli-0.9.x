<?php
class Data_User {

	public static function db() {
		return new Hivli_Database_Model('user');
	}
}