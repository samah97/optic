<?php
include_once("../head.php");

if(!Common::CheckValidSession()){
    header("Location: ".MAIN_URL);
}
$r = $_GET['r'];
if($r!= '' && is_numeric($r)){
    $visible = "";
    $r = $_GET['r'];
    if($r==1){
    
    $background = "green";
    $text = "Information have been saved successfully";
}elseif($r == 0){
    $background = "red";
    $text = "Error saving information";
}
}
else{
 $visible = "hidden";   
}
?>


<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="pages/report.php">OPTIC</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Client </a>
        <ul class="dropdown-menu">
          <li><a href="pages/editClient.php">New</a></li>
        </ul>
      </li>
      <li><a href="pages/brands.php">Brands</a></li>
	  <li class="topnav-right "><a href="action/logoutProcess.php">Logout <span class="glyphicon glyphicon-off"></span></a>
    </ul>
  </div>
</nav>


<div class="result <?php echo $background." ".$visible?> " >
<p class="text-center"><?php    echo $text; ?></p>

</div>

