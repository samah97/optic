<?php 
include 'menu.php';
include '../action/filter.php';
$checkedContact = '';
$checkedLens = '';

if($_REQUEST['lenseType'] == 1){
    $checkedContact = 'checked';
    $checkedLens = '';
}elseif($_REQUEST['lenseType'] == 2){
    $checkedContact = '';
    $checkedLens = 'checked';
    }
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
<div class="row">
<div class="col-md-12">
	<a href='pages/editClient.php'/>
	<button class="btn btn-success" style='margin-bottom: 10px;'>Add New</button>
	</a>
</div>
</div>
<table class="table table-striped table-bordered table-hover" id="patients-table" style='background-color:white'>
<thead>
<tr>
<th>Id</th>
<th>Firstname</th>
<th>Date of birth</th>
<th>Address</th>
<th>Phone</th>
<th>Gender</th>
<!-- <th>Date Attendence</th>
<th>Date Reccieved</th>
<th>Lense Type</th> -->
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php

//$row = Common::cryptoo($_REQUEST['filterQuery'], 'd');
$data = getClientData();
$patientInfoObj = new PatientInfoEXT();
$columns = " a.patient_info_id, a.name, a.dob, a.phone,a.address, a.genderId";
$response = $patientInfoObj->getAllRecords($columns);


if($_REQUEST['filterQuery'] == null || $_REQUEST['filterQuery'] == ""){
    

}
else{
 //$row = Common::cryptoo($_REQUEST['filterQuery'], 'd');
    
// $query=$_REQUEST['filterQuery'];   
}

foreach ($response as $row){
?>
<tr>
<td><?php echo $row->patientInfoId ; ?></td>
<td><?php echo $row->name;?></td>
<td><?php echo $row->dob;?></td>
<td><?php echo $row->address;?></td>
<td><?php echo $row->phone;?></td>
<td><?php echo $row->genderId;?></td>
<td style='display:none'><a href="pages/DetailsClient.php?id=<?php echo $row->patientInfoId; ?>">View Details</a></td>
<td ><a href="pages/visits.php?patient=<?php echo $row->patientInfoId; ?>">Visits</a></td>
<!-- 
<?php if($row['lenseType']==1){?>
<td >Lens</td>
<?php }  else{?>
<td>Contact Lens</td>
<?php }?>
 -->

</tr>
<?php }
$_SESSION['clientList']=null;
?>
</tbody>
</table>
</div>

<?php include_once ("../footer.php");?>
