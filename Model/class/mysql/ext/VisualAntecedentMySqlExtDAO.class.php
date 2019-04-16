<?php
/**
 * Class that operate on table 'visual_antecedent'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
class VisualAntecedentMySqlExtDAO extends VisualAntecedentMySqlDAO{

    public function getByVisit($pdo,$visitId){
        $query = "SELECT * FROM visual_antecedent HWERE visit_id = $visitId ";
        $array = $pdo->select($query);
        return $this->readRow($array[0]);
    }
}
?>