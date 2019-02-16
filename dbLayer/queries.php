<?php
require_once("../include/config.php");
require_once("../include/connection.php");
require_once("../include/global.php");


function login($userName,$password){

    $query="SELECT * FROM Users WHERE userName = '". addslashes($userName)."' AND password = '".addslashes($password)."'";
    
$r=exec_query(DBNAME,$query);
$row= mysqli_fetch_assoc($r);

$_SESSION['session'] =$row['session'] ;

return mysqli_num_rows($r);

}

function selectType(){


$query="SELECT * FROM `type` WHERE type.lenseOrContatLense=\"lense\"";
$r=exec_query(DBNAME,$query);	


return mysqli_num_rows($r);	
}









?>