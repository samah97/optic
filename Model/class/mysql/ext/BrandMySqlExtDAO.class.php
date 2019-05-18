<?php
/**
 * Class that operate on table 'brand'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-05-13 21:08
 */
class BrandMySqlExtDAO extends BrandMySqlDAO{

    public function getAllRecords($pdo,$data = array(),$strWhere = " 1 ",$order= " 1 ASC",$limit = PHP_INT_MAX,$offset = 0){
        try{
            $query = "SELECT * FROM  brand 
                      WHERE $strWhere ORDER BY $order LIMIT $limit OFFSET $offset";
            
            $array = $pdo->select($query,$data);
            return $this->getListObj($array);
        }catch (PDOException $e){
            return null;
        } 
    }
}
?>