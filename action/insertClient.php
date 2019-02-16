<?php
require_once("../include/config.php");
require_once("../include/connection.php");
require_once("../include/global.php");
require_once '../head.php';

extract($_POST);

$dob = formatDate($dob);
$dateAttendance = formatDate($dateAttendance);
$dateReceived = formatDate($dateReceived);

if($fromPage=="newClient"){
$insertClient = "INSERT INTO `client` (`firstname`, `lastname`, `phone`, `DOB`, `DAttendence`, `DRecieved`, `lenseType`, `attendanceNumber`) VALUES ('$firstName','$lastName','$phone','$dob','$dateAttendance','$dateReceived','$lenseType',0)";
}
else{
    $q="select max(attendanceNumber) as mAttendance from clients where clientId=".$clientId;
    $r=exec_query(DBNAME, $q);
    $row=mysqli_fetch_assoc($r);
    $attendance=$row['mAttendance']+1;
    $insertClient = "INSERT INTO `client`(`clientId`, `firstname`, `lastname`, `phone`, `DOB`, `DAttendence`, `DRecieved`, `lenseType`, `attendanceNumber`) VALUES ($clientId,'$firstName','$lastName','$phone','$dob','$dateAttendance','$dateReceived','$lenseType',$attendance)";
}

$clientId = exec_query(DBNAME, $insertClient,true);


if($clientId>0){
$lense="";    
if($lenseType==1){
    $lense="INSERT INTO `lense`(`clientId`, `SOD`, `SOS`, `SOC`, `COD`, `COS`, `AOD`, `AOS`, `ADDOD`, `ADDOS`, `PDF`, `PDN`, `typeId`, `typeCorrectionId`, `coatingId`, `frameId`) VALUES ('".$clientId."','".$_POST['SOD']."','".$_POST['SOS']."','".$_POST['SOC']."','".$_POST['COD']."','".$_POST['COS']."','".$_POST['AOD']."','".$_POST['AOS']."','".$_POST['ADDOD']."','".$_POST['ADDOS']."','".$_POST['PDF']."','".$_POST['PDN']."','".$_POST['typeId']."','".$_POST['typeCorrectionId']."','".$_POST['coatingId']."','".$_POST['frameId']."')";
}
elseif($lenseType==2){
    $lense = "INSERT INTO `contactlense`(`clientId`,`SOD`, `SOS`, `COD`, `COS`, `AOD`, 
        `AOS`, `dominant`, `fellow`, `typeId`, 
        `brandId`, `addOD`, `addOS`) VALUES ('".$clientId."','".$_POST['SOD']."','".$_POST['SOS']."','".$_POST['COD']."','".$_POST['COS']."','".$_POST['AOD']."','".$_POST['AOS']."','".$_POST['dominantEye']."','". $_POST['fellowEye']."','".$_POST['cTypeId']."','".$_POST['cBrandId']."','".$_POST['ADDOD']."','".$_POST['ADDOS']."')";
}


$insertedLens = exec_query(DBNAME, $lense,true);
    
if($insertedLens>0){
$r = 1;
}
else{
    $r=0;
}

header("Location:".MAIN_URL."pages/menu.php?r=$r");


}

?>