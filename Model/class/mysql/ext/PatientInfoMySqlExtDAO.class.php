<?php
/**
 * Class that operate on table 'patient_info'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
class PatientInfoMySqlExtDAO extends PatientInfoMySqlDAO{

    public function getAllRecords($pdo,$columns= " * ",$data = array(),$strWhere = " 1 ",$order = " 1 DESC",$limit = PHP_INT_MAX,$offset = 0){
	    $query = "SELECT $columns FROM
                patient_info a
                LEFT OUTER JOIN gender b ON a.genderId = b.gender_id
                WHERE $strWhere ORDER BY $order LIMIT $limit OFFSET $offset";
                
	    $array = $pdo->select($query,$data);
	    
	    return $this->getListObj($array);
	}
}
?>