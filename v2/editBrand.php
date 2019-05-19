<?php
include_once ("../include/common.php");
$brandsObj = new BrandEXT();
$update =$brandsObj->editBrands();
echo json_encode($update);
?>