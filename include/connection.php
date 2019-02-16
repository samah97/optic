<?php
function exec_query($db,$query,$insertedId = false)
{
$con=mysqli_connect("localhost","root","",$db);
if(!$con)
die ("Error while connecting".mysqli_error($con));

$r= mysqli_query($con,$query);
if(!$r)
	die("error in query: ".$query." Error: ".mysqli_error($con));

if($insertedId){
 $r= mysqli_insert_id($con);
 
}	
	
mysqli_close($con);
return $r;
}

function formatDate($date,$mainFormat="d/m/Y",$toFormat="Y-m-d")
{
    $date = trim($date);
    $date = date_create_from_format($mainFormat,$date);
    
    return date_format($date, $toFormat);
}


//exec_query(DBNAME,$query);

// DB connection here
?>