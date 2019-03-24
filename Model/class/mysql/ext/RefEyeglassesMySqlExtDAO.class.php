<?php
/**
 * Class that operate on table 'ref_eyeglasses'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
class RefEyeglassesMySqlExtDAO extends RefEyeglassesMySqlDAO{

	public function getRecord($pdo,$data,$strWhere){
	    try{
	    $query = "SELECT * FROM ref_eyeglasses WHERE $strWhere";
	    $array = $pdo->select($query,$data);
	    }catch (PDOException $e){
	        return null;
	    }
	}
}
?>