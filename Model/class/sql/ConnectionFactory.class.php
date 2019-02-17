<?php
/*
 * Class return connection to database
 *
 * @author: http://phpdao.com
 * @date: 27.11.2007
 */
class ConnectionFactory{
	
	/**
	 * Zwrocenie polaczenia
	 *
	 * @return polaczenie
	 */
	static public function getConnection(){		
	    $conn = new mysqli(ConnectionProperty::getHost(), ConnectionProperty::getUser(), ConnectionProperty::getPassword(), ConnectionProperty::getDatabase());    
	    // Change character set to utf8
        mysqli_set_charset($conn,"utf8");
        /*mysqli_set_charset('utf8');
        mysqli_query("SET collation_connection = utf8_czech_ci"); */
        
	    if ($conn->connect_error) {
	        throw new Exception('could not connect to database');die();
	    }
		return $conn;
	}

	/**
	 * Zamkniecie polaczenia
	 *
	 * @param connection polaczenie do bazy
	 */
	static public function close($connection){
		mysqli_close($connection);
	}
}
?>