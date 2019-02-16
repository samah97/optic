<?php
include_once ("../head.php");

?>


<div class="container">
	<form method="POST" name="newClient"
		action="../action/insertClient.php">
		<div class="col-md-6">
			<label>First Name</label> <input type="text" name="fname" id="fname"></input>
		</div>
		<div class="col-md-6">
			<label>Last Name</label> <input type="text" name="lname" id="lname"></input>
		</div>
		<div class="col-md-6">
			<label>Phone</label> <input type="text" name="phone" id="phone"></input>
		</div>
		<div class="col-md-6">
			<label>Date Of Birth</label> <input type="date" name="dob" id="dob"></input>
		</div>
		<div class="col-md-6">
			<label>Date Attendance</label> <input type="date"
				name="dateAttendence" id="dateAttendence"></input>
		</div>
		<div class="col-md-6">
			<label>Date Received</label> <input type="date" name="dateReceived"
				id="dateReceived"></input>
		</div>
		<div class="col-md-6">
			<label>Lense Type</label> <select name="lenseType" id="lenseType"
				onchange="showTypeForm();">
				<option selected value=""></option>
				<option value="Lense">Lense</option>
				<option value="ContactLense">Contact Lense</option>
			</select> <input type="text" hidden name="lenseSelectedType"
				id="lenseSelectedType" value="">
		</div>
		<div class="col-md-6 lenseForm" id="lenseForm">
			<div class="lenseForm" style="display: none">

				<label>SOD</label> <input type="text" name="SOD" id="SOD"
					class="filterme"></input>
			</div>
			<div class="col-md-6">
				<label>SOS</label> <input type="text" name="SOS" id="SOS"
					class="filterme"></input>
			</div>
			<div class="col-md-6">
				<label>COD</label> <input type="text" name="COD" id="COD"
					class="filterme"></input>
			</div>
			<div class="col-md-6">
				<label>COS</label> <input type="text" name="COS" id="COS"
					class="filterme"></input>
			</div>
			<div class="col-md-6">
				<label>AOD</label> <input type="text" name="AOD" id="AOD"
					class="filterme"></input>
			</div>
			<div class="col-md-6">
				<label>AOS</label> <input type="text" name="AOS" id="AOS"
					class="filterme"></input>
			</div>
			<div class="col-md-6">
				<label>ADD OD</label> <input type="text" name="ADDOD" id="ADDOD"
					class="filterme"></input>
			</div>
			<div class="col-md-6">
				<label>ADD OS</label> <input type="text" name="ADDOS" id="ADDOS"
					class="filterme"></input>
			</div>
			<div class="col-md-6">
				<label>PDF</label> <input type="text" name="PDF" id="PDF"
					class="filterme"></input>
			</div>
			<div class="col-md-6">
				<label>PDN</label> <input type="text" name="PDN" id="PDN"
					class="filterme"></input>
			</div>
			<div class="col-md-6">
				<label>Type</label> <select name="typeId" id="typeId">
					<option value="" selected>
					
					<option>
<?php
$query = "SELECT * FROM `type` WHERE type.lenseOrContatLense=\"lense\"";
$r = exec_query(DBNAME, $query);
while ($row = mysqli_fetch_assoc($r)) {
    
    ?>

					
					
					
					<option value="<?php echo $row['typeId']; ?>"><?php echo $row['name']; ?></option>
<?php }?>
</select>
			</div>
			<div class="col-md-6">
				<label>Correction Type</label> <select name="correctionTypeId"
					id="correctionTypeId">
					<option value="" selected>
					
					<option>
<?php
$query = "SELECT * FROM `typecorrection`";
$r = exec_query(DBNAME, $query);
while ($row = mysqli_fetch_assoc($r)) {
    ?>

					
					
					
					<option value="<?php echo $row['correctionId']; ?>"><?php echo $row['name']; ?></option>
<?php }?>
</select>
			</div>
			<div class="col-md-6">
				<label>Coating</label> <select name="coatingId" id="coatingId">
					<option value="" selected>
					
					<option>
<?php
$query = "SELECT * FROM `coating`";
$r = exec_query(DBNAME, $query);
while ($row = mysqli_fetch_assoc($r)) {
    ?>

					
					
					
					<option value="<?php echo $row['coatingId']; ?>"><?php echo $row['name']; ?></option>
<?php }?>
</select>
			</div>
			<div class="col-md-6">
				<label>Frame</label> <select name="frameId" id="frameId">
					<option value="" selected>
					
					<option>
<?php
$query = "SELECT * FROM `frame`";
$r = exec_query(DBNAME, $query);
while ($row = mysqli_fetch_assoc($r)) {
    ?>

					
					
					
					<option value="<?php echo  $row['frameId']; ?>"><?php echo $row['name']; ?></option>
<?php }?>
</select>
			</div>
			<div class="col-md-6">
				<div class="contactLenseForm" id="contactLenseForm"
					style="display: none">
					<label>SOD</label> <input type="text" name="SOD" id="SOD"
						class="filterme"></input> <label>SOS</label> <input type="text"
						name="SOS" id="SOS" class="filterme"></input> <label>COD</label> <input
						type="text" name="COD" id="COD" class="filterme"></input> <label>COS</label>
					<input type="text" name="COS" id="COS" class="filterme"></input> <label>AOD</label>
					<input type="text" name="AOD" id="AOD" class="filterme"></input> <label>AOS</label>
					<input type="text" name="AOS" id="AOS" class="filterme"></input> <label>Dominant
						Eye</label> <input type="text" name="dominantEye" id="dominantEye"></input>
					<label>Felllow Eye</label> <input type="text" name="fellowEye"
						id="fellowEye"></input> <label>ADD OD</label> <input type="text"
						name="ADDOD" id="ADDOD" class="filterme"></input> <label>ADD OS</label>
					<input type="text" name="ADDOS" id="ADDOS" class="filterme"></input>
					<label>Type</label> <select name="typeId" id="typeId">
						<option value="">
						
						<option>
<?php
$query = "SELECT * FROM `type` WHERE type.lenseOrContatLense=\"ContactLense\"";
$r = exec_query(DBNAME, $query);
while ($row = mysqli_fetch_assoc($r)) {
    ?>

						
						
						
						<option value="<?php echo $row['typeId']; ?>"><?php echo $row['name']; ?></option>
<?php }?>
</select> <label>Brand</label> <select name="brandId" id="brandId">
						<option value="">
						
						<option>
<?php
$query = "SELECT * FROM brand";
$r = exec_query(DBNAME, $query);
while ($row = mysqli_fetch_assoc($r)) {
    ?>

						
						
						
						<option value="<?php echo $row['brandId']; ?>"><?php echo $row['name']; ?></option>
<?php }?>
</select>
				</div>
				<input type="submit" onclick="validateForm();">
<?php
$query = "select * from client";
$r = exec_query(DBNAME, $query);
$row = mysqli_fetch_assoc($r);
?>
<div type="text" hidden name="clientId" id="clientId">Client ID = <?php echo $row['clientId'];?> </div>
	
	</form>
</div>