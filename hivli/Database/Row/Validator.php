<?
include 'Validator/Name.php';
include 'Validator/Type.php';
include 'Validator/Object_name.php';
class Hivli_Database_Row_Validator {
	
	public static function validate($rowObject){
		$objectStructure = Hivli::get('database')->getStructure()->getObject($rowObject->getObjectName());
		$objectFields = $objectStructure->getFields();
		
		
		
		foreach ($objectFields as $objectField){
			foreach ($objectField->attributes() as $key => $value){
				try{
					$validatorName = 'Hivli_Database_Row_Validator_' . ucfirst($key);
					eval($validatorName . "::validate('". $value ."', '". $rowObject->$objectField['name'] ."');");
				} catch (Exception $e){
					die('hata var');
				}
			}
		}
	}
}