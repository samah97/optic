<?php include 'menu.php'  ?>

<?php
if(! is_numeric($_REQUEST['id'])){
    $_REQUEST['id'] = 0;
}
if($_REQUEST['fromPage']=="oldClient"){
    $query="select * from client where clientId=".$_REQUEST['id'];
}
else{
    $query="select * from client where clientId=".$_REQUEST['id']." and attendanceNumber=0";
}
$r = exec_query(DBNAME, $query);
$row = mysqli_fetch_assoc($r);
$id = $row['clientId'];
?>
<div class="container">
<div class="col-md-2"><label>Id : <?php echo $row['clientId'];?></label></div>
<div class="col-md-2"><label>First Name : <?php echo $row['firstname'];?></label></div>
<div class="col-md-2"><label>Last Name : <?php echo $row['lastname'];?></label></div>
<div class="col-md-2"><label>Phone : <?php echo $row['phone'];?></label></div>
<div class="col-md-2"><label>Lens Type: <?php echo $row['lenseType']==1?"Lens":"Contact Lense";?></label></div>
<div class="col-md-2"><label>Attendance Number : <?php echo $row['attendanceNumber'];?></label></div>
<br><br>
</div>
<div class="container">
<table class="table">
<thead>
<tr>
<th>Lense Id</th>
<th>SOD</th>
<th>SOS</th>
<th>SOC</th>
<th>COD</th>
<th>COS</th>
<th>AOD</th>
<th>AOS</th>
<th>ADD OD</th>
<th>ADD OS</th>
<th>PDF</th>
<th>PDN</th>
<th>Type</th>
<th>Correction Type</th>
<th>Coating</th>
<th>Frame</th>
</tr>
</thead>
<tbody>
<?php 
$query = "SELECT `lenseId`, `clientId`, `SOD`, `SOS`, `SOC`, `COD`, `COS`, `AOD`, `AOS`, `ADDOD`, `ADDOS`, `PDF`, `PDN`, `typeId`, `typeCorrectionId`, `coatingId`, `frameId` FROM `lense` WHERE clientId=".$_REQUEST['id'];

$r = exec_query(DBNAME, $query);

while ($row = mysqli_fetch_assoc($r)) {
?>
<tr>
<td><?php echo $row['lenseId'] ; ?></td>
<td><?php echo $row['SOD'];?></td>
<td><?php echo $row['SOS'];?></td>
<td><?php echo $row['SOC'];?></td>
<td><?php echo $row['COD'];?></td>
<td><?php echo $row['COS'];?></td>
<td><?php echo $row['AOD'];?></td>
<td><?php echo $row['AOS'];?></td>
<td><?php echo $row['ADDOD'];?></td>
<td><?php echo $row['ADDOS'];?></td>
<td><?php echo $row['PDF'];?></td>
<td><?php echo $row['PDN'];?></td>
<?php $query2="SELECT name FROM type where typeId=".$row['typeId'];
$r2 = exec_query(DBNAME, $query2);
$row2 = mysqli_fetch_assoc($r2);
?>
<td><?php echo $row2['name'];?></td>
<?php $query3="SELECT name FROM typecorrection where correctionId=".$row['typeCorrectionId'];
$r3 = exec_query(DBNAME, $query3);
$row3 = mysqli_fetch_assoc($r3);
?>
<td><?php echo $row3['name'];?></td>
<?php $query4="SELECT name FROM coating where coatingId=".$row['coatingId'];
$r4 = exec_query(DBNAME, $query4);
$row4 = mysqli_fetch_assoc($r4);
?>
<td><?php echo $row4['name'];?></td>
<?php $query5="SELECT name FROM frame where frameId=".$row['frameId'];
$r5 = exec_query(DBNAME, $query5);
$row5 = mysqli_fetch_assoc($r5);
?>
<td><?php echo $row5['name'];?></td>

</tr>
<?php }
$_SESSION['clientList']=null;
?>
</tbody>
</table>
<?php if($_REQUEST['fromPage']=="oldClient"){
?>
<button type="button" class="btn btn-success" name="addAttendance" id="addAttendance" onclick="location.href='<?php echo MAIN_URL ?>pages/AddAttendance.php?id=<?php echo $id?>';">Add Attendance</button>
<?php }?>
</div>

<?php include_once ("../footer.php");?>
