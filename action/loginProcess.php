<?php
/* require_once("../include/config.php");
require_once("../include/connection.php");
require_once("../include/global.php");
require_once("../dbLayer/queries.php");
 */
require_once("../include/common.php");

$userName =  $_POST['userName'];
$password = $_POST['userPassword'];

$userObj = new UsersEXT();
$loginResult = $userObj->login($userName,$password);

if($loginResult->result == 1){
    $user = $loginResult->user;
    $_SESSION['session'] = $user->session;
    header("Location: ".MAIN_URL."pages/report.php");
    exit;
	}
else{
	$msg=$loginResult->message;
	header("location: ".MAIN_URL."?msg=".$msg);
}

?>
