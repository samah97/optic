<?php
/**
 * Class that operate on table 'patient_ambiance'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-03-31 19:15
 */
class PatientAmbianceMySqlExtDAO extends PatientAmbianceMySqlDAO{

    public function getRecord($pdo,$data,$strWhere){
        try{
            $query = "SELECT * FROM patient_ambiance WHERE $strWhere";
            $array = $pdo->select($query,$data);
        }catch (PDOException $e){
            return null;
        }
    }
}
?>