<?
class UserTable extends Doctrine_Table{

	public static function findById($id){
		return Doctrine_Core::getTable('user')->findById($id);
	}
}