<?php
/**
 * Class that operate on table 'visit'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-03-23 16:00
 */
class VisitMySqlExtDAO extends VisitMySqlDAO{

    public function getAllRecords($pdo,$columns= " * ",$data = array(),$strWhere = " 1 ",$order = " 1 DESC",$limit = PHP_INT_MAX,$offset = 0){
        $query = "SELECT $columns FROM
        visit a
        WHERE $strWhere ORDER BY $order LIMIT $limit OFFSET $offset";
        
        $array = $pdo->select($query,$data);
        return $this->getListObj($array);
    }
    
	public function getCountVisit($pdo,$patientInfoId){
	    try{
	        
	        $data = array("id"=>$patientInfoId);
	        
	        $query = "SELECT COUNT(visit_id) As count
                    FROM visit 
                    WHERE patient_info_id =:id";
	        
	        $array = $pdo->select($query,$data);
	        return $this->readRow($array[0]);
	    }catch(PDOException $e){
	        return null;
	    }
	}
}
?>