<?
class Post extends Doctrine_Record {
    public function setTableDefinition(){
        $this->hasColumn('title', 'string', 255);
        $this->hasColumn('body', 'string', 255);
        $this->hasColumn('user_id', 'integer');
    }
    
    public function setUp(){
    	$this->hasOne('user', array( 'local' => 'user_id', 'foreign' => 'id'));
    }
}