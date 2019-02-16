<?php
require_once("../include/config.php");
require_once("../include/connection.php");
require_once("../include/global.php");
require_once("../dbLayer/queries.php");

unset($_SESSION);
session_destroy();

header("location:../index.php");	



?>