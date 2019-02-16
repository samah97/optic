<?php
require_once("../include/config.php");
require_once("../include/connection.php");
require_once("../include/global.php");
require_once("../dbLayer/queries.php");


$userName =  $_REQUEST['userName'];
$password = md5($_REQUEST['userPassword']);



if(login($userName,$password) == 1){
    
	header("location:../pages/report.php");	
	}
else{
	$msg="User not found";
	header("location:../index.php?msg=".$msg);
}

?>
