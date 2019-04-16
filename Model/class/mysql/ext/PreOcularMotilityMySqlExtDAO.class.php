<?php
/**
 * Class that operate on table 'pre_ocular_motility'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-03-16 13:07
 */
class PreOcularMotilityMySqlExtDAO extends PreOcularMotilityMySqlDAO{

    public function getRecord($pdo,$data,$strWhere){
        try{
            $query = "SELECT * FROM pre_ocular_motility WHERE $strWhere";
            $array = $pdo->select($query,$data);
        }catch (PDOException $e){
            return null;
        }
    }
}
?>