<?php 
include 'menu.php';
?>
<div class="container">
<div>
<form method="get" >
<div class="form-group col-md-4">
  <label for="usr">Id:</label>
  <input type="text" class="form-control" name="clientId" id="clientId" value = "<?php echo $_REQUEST['clientId']; ?>">
</div>
<div class="form-group col-md-4">
  <label for="usr">First Name:</label>
  <input type="text" class="form-control" name="firstName" id="firstName" value = "<?php echo $_REQUEST['firstName']; ?>">
</div>
<div class="form-group radio col-md-4">
  <label for="usr">Lens Type:</label>
  <br><br>
  &nbsp;&nbsp;&nbsp;&nbsp;<label>
  <input type="radio" name="lenseType" value="1" <?php echo $checkedContact ?>>Contact Lens</label>&nbsp;&nbsp;&nbsp;
  <label><input type="radio" name="lenseType" value="2" <?php echo $checkedLens ?>>Lens</label>
</div>
<div class="form-group col-md-4">
  <label for="usr">phone:</label>
  <input type="text" class="form-control" name="phone" id="phone" value = "<?php echo $_REQUEST['phone']; ?>">
</div>
<div class="form-group col-md-4">
</div>
<div class="form-group col-md-4">
	<button class="btn btn-success" style='margin-top:20px;' type="submit" >
				Submit
	</button>
</div>
</form>
</div>
<table class="table table-striped table-bordered table-hover" id="patients-table" style='background-color:white'>
<thead>
<tr>
<th>Id</th>
<th>Visit Date</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php
$strWhere = " 1 ";
if(isset($_GET['patient']) && is_integer($_GET['patient'])){
    $strWhere .= "AND a.patient_info_id = ".$_GET['patient'];
}
//$row = Common::cryptoo($_REQUEST['filterQuery'], 'd');
$visitObj = new VisitEXT();
$visits = $visitObj->getAllRecords("*",array(),$strWhere);

if($_REQUEST['filterQuery'] == null || $_REQUEST['filterQuery'] == ""){

}
else{
 //$row = Common::cryptoo($_REQUEST['filterQuery'], 'd');
    
// $query=$_REQUEST['filterQuery'];   
}

foreach ($visits as $row){
?>
<tr>
<td><?php echo $row->visitId ; ?></td>
<td><?php echo $row->datetime;?></td>
<td >
	<a href="pages/editClient.php?visit=<?php echo $row->visitId; ?>">Edit</a>
	<a href="pages/delete_visit.php?id=<?php echo $row->visitId; ?>">Delete</a>
</td>

</tr>
<?php }
$_SESSION['clientList']=null;
?>
</tbody>
</table>
</div>

<?php include_once ("../footer.php");?>
