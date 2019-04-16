<?php
/**
 * Class that operate on table 'pre_pupillary_reflexs'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-03-16 13:07
 */
class PrePupillaryReflexsMySqlExtDAO extends PrePupillaryReflexsMySqlDAO{

    public function getRecord($pdo,$data,$strWhere){
        try{
            $query = "SELECT * FROM pre_pupilary_reflexs WHERE $strWhere";
            $array = $pdo->select($query,$data);
        }catch (PDOException $e){
            return null;
        }
    }
}
?>