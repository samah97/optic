<?php
/**
 * Class that operate on table 'preliminary_examination'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-03-16 13:07
 */
class PreliminaryExaminationMySqlExtDAO extends PreliminaryExaminationMySqlDAO{

    public function getByVisit($pdo,$visitId){
        $query = "SELECT * FROM preliminary_examination HWERE visit_id = $visitId ";
        $array = $pdo->select($query);
        return $this->readRow($array[0]);
    }
}
?>