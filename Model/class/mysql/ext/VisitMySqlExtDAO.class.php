<?php
/**
 * Class that operate on table 'visit'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-03-23 16:00
 */
class VisitMySqlExtDAO extends VisitMySqlDAO{

	public function getCountVisit($patientInfoId){
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