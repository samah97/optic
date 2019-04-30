<?php
/**
 * Class that operate on table 'reason_consultation'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
class ReasonConsultationMySqlExtDAO extends ReasonConsultationMySqlDAO{

    public function getByVisit($pdo,$visitId){
        $query = "SELECT * FROM reason_consultation WHERE visit_id = $visitId ";
        $array = $pdo->select($query);
        
        return $this->readRow($array[0]);
    }
}
?>