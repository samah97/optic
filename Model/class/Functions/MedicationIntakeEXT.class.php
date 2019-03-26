<?php
/**
 * Class that operate on table 'medication_intake'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-03-04 22:53
 */
class MedicationIntakeEXT extends MedicationIntakeMySqlDAO{
    public function getAllRecords($data = array(),$strWhere = " 1 ",$order = " 1 ASC",$limit= PHP_INT_MAX,$offset = 0){
        $pdo = Database::getConnection();
        $Obj = new MedicationIntakeMySqlExtDAO();
        $array = $Obj->getAllRecords($pdo,$data,$strWhere,$order,$limit,$offset);
        
        return $array;
    }
	
}
?>