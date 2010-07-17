<?php
class Table_User {

	public static function db() {
		return new Hivli_Database_Table_Abstract('user');
	}
}