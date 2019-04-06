<?php
include_once ("../include/common.php");
$patientInfoObj = new PatientInfoEXT();
$columns = " a.patient_info_id, a.name, a.dob, a.phone, a.genderId";
$response = $patientInfoObj->getAllRecords($columns);
echo json_encode($response);
?>