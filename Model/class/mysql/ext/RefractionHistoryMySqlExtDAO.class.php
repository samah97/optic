<?php
/**
 * Class that operate on table 'refraction_history'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
class RefractionHistoryMySqlExtDAO extends RefractionHistoryMySqlDAO{

	public function getByVisit($pdo,$visitId){
	    $query = "SELECT * FROM refraction_history HWERE visit_id = $visitId ";
	    $array = $pdo->select($query);
	    return $this->readRow($array[0]);
	}
    
}
?>