<?php

include_once ("../include/common.php");
$patientInfoObj = new PatientInfoEXT();
$insert = $patientInfoObj->submitAllData();
echo json_encode($insert);
?>