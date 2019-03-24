<?php
/**
 * Class that operate on table 'cover_test'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-03-16 13:07
 */
class CoverTestEXT extends CoverTestMySqlDAO{

    public function getAllRecords($data = array(),$strWhere = " 1 ",$order = " 1 ASC",$limit= PHP_INT_MAX,$offset = 0){
        $pdo = Database::getConnection();
        $Obj = new CoverTestMySqlExtDAO();
        $array = $Obj->getAllRecords($pdo,$data,$strWhere,$order,$limit,$offset);
        
        return $array;
    }
}
?>