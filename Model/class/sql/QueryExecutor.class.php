<?php
/**
 * Object executes sql queries
 *
 * @author: http://phpdao.com
 * @date: 27.11.2007
 */
class QueryExecutor{    
	/**
	 * Wykonaniew zapytania do bazy
	 *
	 * @param sqlQuery obiekt typu SqlQuery
	 * @return wynik zapytania 
	 */
	public static function execute($sqlQuery){
	    $connection = ConnectionFactory::getConnection(); 
	    $query = $sqlQuery->getQuery();
	    $result=$connection->query($query);
	    if(!$result){
	        throw new Exception(mysqli_connect_error($connection));
	    }	    
	    $i=0;
	    $tab = array();
	    while ($row = mysqli_fetch_array($result)){
	        $tab[$i++] = $row;
	    }
	    mysqli_free_result($result);	    
	    return $tab;
	}
	
	
	public static function executeUpdate($sqlQuery){
		$connection = ConnectionFactory::getConnection();	 
		$query = $sqlQuery->getQuery();
		$result = $connection->query($query);
		
		if(!$result){
			throw new Exception(mysqli_connect_error($connection));
		}
		return mysqli_affected_rows($connection);		
	}

	public static function executeInsert($sqlQuery){
	    $connection = ConnectionFactory::getConnection();
	    $query = $sqlQuery->getQuery();
	    $result = $connection->query($query);	
	    if(!$result){
	        throw new Exception(mysqli_connect_error($connection));
	    }
	    return mysqli_insert_id($connection);
	}
			
	/**
	 * Wykonaniew zapytania do bazy
	 *
	 * @param sqlQuery obiekt typu SqlQuery
	 * @return wynik zapytania 
	 */
	public static function queryForString($sqlQuery){
		$transaction = Transaction::getCurrentTransaction();
		if(!$transaction){
			$connection = new Connection();
		}else{
			$connection = $transaction->getConnection();
		}
		$result = $connection->executeQuery($sqlQuery->getQuery());
		if(!$result){
			throw new Exception(mysqli_error());
		}
		$row = mysqli_fetch_array($result);		
		return $row[0];
	}

}
?>