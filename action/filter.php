<?php
/* require_once("../include/config.php");
require_once("../include/connection.php");
require_once("../include/global.php"); */
require_once("../include/common.php");


function getClientData($isOldClient = false){
$fromPage=$_REQUEST['fromPage'];
$id=Common::clearParameter($_REQUEST['clientId']);

$phone=  is_numeric($_REQUEST['phone'])?$_REQUEST['phone']:0 ;
$firstName=Common::clearParameter($_REQUEST['firstName']);
$lenseType=Common::clearParameter($_REQUEST['lenseType']);


if($isOldClient){
    $query="SELECT * FROM CLIENT WHERE attendanceNumber=0";
}else{
    $query="SELECT * FROM CLIENT where 1=1";
}
/* if($fromPage=="report")
    $query="SELECT * FROM CLIENT WHERE attendanceNumber=0";
else{
    $query="SELECT * FROM CLIENT where 1=1";
}   */


if($id != null && $id != ""){
    $query = $query . " AND clientId=".$id;
}


if($phone != null && $phone != ""){
    $query = $query. " AND phone=".$phone;
}
if($firstName != null && $firstName != ""){
    $query =  $query. " AND firstname='".$firstName."'";
}
if($lenseType != null){
    $query =  $query ." AND lenseType='".$lenseType."'";
}
//echo $query;die();
$filterQuery=$query;

$r= exec_query(DBNAME, $query);
$filterArr = array();
while ($row = mysqli_fetch_assoc($r)) {
  //$row = (object)$row;   
  
 //$x = $row['clientId'] .",'".$row['firstname']."','".$row['lastname']."','".$row['phone']."','".$row['DOB']."','".$row['DAttendence']."','".$row['DRecieved']."'";
  $filterArr[] = $row;
}

$filterQuery= $filterArr;
return $filterQuery;

//echo $filterQuery;
//$encrypted =  Common::cryptoo($filterQuery,'e');
/* 
$redirect = MAIN_URL."pages/report.php?filterQuery=".$encrypted;
header("Location: ".$redirect); */
//header('Location: http://www.example.com/');


/* if($fromPage=="report")
    header("location:../pages/report.php?filterQuery=".$encrypted);
else{
    header("location:../pages/oldClient.php?filterQuery=".$encrypted);
} */
}
