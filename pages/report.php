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
<table class="table">
<thead>
<tr>
<th>Id</th>
<th>Firstname</th>
<th>Lastname</th>
<th>Phone</th>
<th>Date of birth</th>
<th>Date Attendence</th>
<th>Date Reccieved</th>
<th>Lense Type</th>
<th>View Details</th>
</tr>
</thead>
<tbody>
<?php

//$row = Common::cryptoo($_REQUEST['filterQuery'], 'd');
$data = getClientData();

if($_REQUEST['filterQuery'] == null || $_REQUEST['filterQuery'] == ""){
    

}
else{
 //$row = Common::cryptoo($_REQUEST['filterQuery'], 'd');
    
// $query=$_REQUEST['filterQuery'];   
}

foreach ($data as $row){
?>
<tr>
<td><?php echo $row['clientId'] ; ?></td>
<td><?php echo $row['firstname'];?></td>
<td><?php echo $row['lastname'];?></td>
<td><?php echo $row['phone'];?></td>
<td><?php echo $row['DOB'];?></td>
<td><?php echo $row['DAttendence'];?></td>
<td><?php echo $row['DRecieved'];?></td>
<?php if($row['lenseType']==1){?>
<td>Lens</td>
<?php }  else{?>
<td>Contact Lens</td>
<?php }?>
<td><a href="pages/DetailsClient.php?id=<?php echo $row['clientId']; ?>">View Details</a></td>
</tr>
<?php }
$_SESSION['clientList']=null;
?>
</tbody>
</table>
</div>

<?php include_once ("../footer.php");?>
