<?
class Hivli_Database_Row_Validator_Type {
	
	public static function validate($validator, $value){
		switch ($validator){
			case 'id':
				if(!is_int($value)){
					throw new Exception('id degil');
				}
				break;
			case 'string':
				break;
			case 'text':
				break;
			case 'timestamp':
				break;
			case 'time_added':
				break;
			case 'time_updated':
				break;
			case 'email':
				break;
			case 'int':
				break;
		}
	}	
}