<?php
/**
 * Class that operate on table 'control'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
class ControlEXT extends ControlMySqlDAO{

    public function getAllRecords($data = array(),$strWhere = " 1 ",$order = " 1 ASC",$limit= PHP_INT_MAX,$offset = 0){
        $pdo = Database::getConnection();
        $Obj = new ControlMySqlExtDAO();
        $array = $Obj->getAllRecords($pdo,$data,$strWhere,$order,$limit,$offset);
        
        return $array;
    }
}
?>