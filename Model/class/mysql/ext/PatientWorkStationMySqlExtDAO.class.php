<?php
/**
 * Class that operate on table 'patient_work_station'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-03-31 19:15
 */
class PatientWorkStationMySqlExtDAO extends PatientWorkStationMySqlDAO{

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