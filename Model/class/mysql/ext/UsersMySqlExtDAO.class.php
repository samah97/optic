<?php
/**
 * Class that operate on table 'users'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:56
 */
class UsersMySqlExtDAO extends UsersMySqlDAO{

	public function getUser($pdo,$username,$password){
	    
	    try{
	        $data = array(
	            "username"=>$username,
	            "password"=>$password
	        );
	        
	        $query = "SELECT * FROM users where username = :username AND password = :password";
	        $result = $pdo->select($query,$data);
	        
	        return $this->readRow($result[0]);
	    }catch (PDOException $e){
	        return null;
	    }
	    
	    
	}
    
    
}
?>