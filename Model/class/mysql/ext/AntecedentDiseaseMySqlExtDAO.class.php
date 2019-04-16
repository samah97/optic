<?php
/**
 * Class that operate on table 'antecedent_disease'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
class AntecedentDiseaseMySqlExtDAO extends AntecedentDiseaseMySqlDAO{

    public function getRecord($pdo,$data,$strWhere){
        try{
            $query = "SELECT * FROM patient_work_station WHERE $strWhere";
            $array = $pdo->select($query,$data);
        }catch (PDOException $e){
            return null;
        }
    }
}
?>