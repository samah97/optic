<?php
/**
 * Class that operate on table 'ocular_motility'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-03-16 13:07
 */
class OcularMotilityEXT extends OcularMotilityMySqlDAO{

    public function getAllRecords($data = array(),$strWhere = " 1 ",$order = " 1 ASC",$limit= PHP_INT_MAX,$offset = 0){
        $pdo = Database::getConnection();
        $Obj = new OcularMotilityMySqlExtDAO();
        $array = $Obj->getAllRecords($pdo,$data,$strWhere,$order,$limit,$offset);
        
        return $array;
    }
}
?>