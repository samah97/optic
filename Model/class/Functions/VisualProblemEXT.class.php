<?php
/**
 * Class that operate on table 'visual_problem'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
class VisualProblemEXT extends VisualProblemMySqlDAO{

	public function getAllRecords($data = array(),$strWhere = " 1 ",$order = " 1 ASC",$limit= PHP_INT_MAX,$offset = 0){
	    $pdo = Database::getConnection();
	    $Obj = new VisualProblemMySqlExtDAO();
	    $array = $Obj->getAllRecords($pdo,$data,$strWhere,$order,$limit,$offset);
	    
	    return $array;
	}
    
    
}
?>