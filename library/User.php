<?
class User extends Doctrine_Record {
    public function setTableDefinition(){
        $this->hasColumn('name', 'string', 255, array('notblank' => true));
        $this->hasColumn('username', 'string', 255, array('unique' => true, 'notblank' => true, 'nospace' => true));
        $this->hasColumn('password', 'string', 255, array('notblank' => true));
        $this->hasColumn('email', 'string', 255, array('email' => true, 'unique' => true, 'notblank' => true));
    }
   
    public function setUp(){
    	$this->hasMany('Post as posts', array( 'local' => 'id', 'foreign' => 'user_id'));
    }
}