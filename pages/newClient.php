<?php include 'menu.php'  ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h3 class="text-center">New Client</h3>
		</div>
		<div class="col-md-12">
		<form id="newClient" name="newClient" action="action/insertClient.php?fromPage=newClient" method="POST" onSubmit="if(!validateForm()){return false;}">
			<div class="col-md-6">
				<div class="form-group">
					<label for="firstName" class="col-md-3 control-label">First
						Name</label>
					<div class="col-md-8">
						<div class="input-icon right">
							<input name="firstName" type="text"
								class="form-control rounded-form place-holder-color"
								id="firstName" value="" placeholder="firstName"
								onchange="onChange('req_first_name')">
						</div>
					</div>
					<span style="color:red">*</span>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="lastName" class="col-md-3 control-label">Last
						Name</label>
					<div class="col-md-8">
						<div class="input-icon right">
							<input name="lastName" type="text"
								class="form-control rounded-form place-holder-color"
								id="lastName" value="" placeholder="Last name"
								onchange="onChange('lastName')">
						</div>
					</div>
					<span style="color:red">*</span>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="phone" class="col-md-3 control-label">Phone</label>
					<div class="col-md-8">
						<div class="input-icon right">
							<input name="phone" type="text"
								class="form-control rounded-form place-holder-color"
								id="phone" value="" placeholder="Phone"
								onchange="onChange('phone')">
						</div>
					</div>
					<span style="color:red">*</span>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="dob" class="col-md-3 control-label">Date of
						Birth</label>
					<div class="col-md-8">
						<div class="input-icon right">
							<input name="dob" type="text"
								class="form-control rounded-form place-holder-color datepicker"
								id="dob" value="" placeholder="Date of Birth"
								onchange="onChange('dob')">
						</div>
					</div>
					<span style="color:red">*</span>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="dateAttendance" class="col-md-3 control-label">Date
						Attendance</label>
					<div class="col-md-8">
						<div class="input-icon right">
							<input name="dateAttendance" type="text"
								class="form-control rounded-form place-holder-color datepicker"
								id="dateAttendance" value="" placeholder="Date Attendance"
								onchange="onChange('dateAttendance')">
						</div>
					</div>
					<span style="color:red">*</span>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="dateReceived" class="col-md-3 control-label">Date
						Received</label>
					<div class="col-md-8">
						<div class="input-icon right">
							<input name="dateReceived" type="text"
								class="form-control rounded-form place-holder-color datepicker"
								id="dateReceived" value="" placeholder="Date Received"
								onchange="onChange('dateReceived')">
						</div>
					</div>
					<span style="color:red">*</span>
				</div>
			</div>
			<div class="col-md-6">
					<div class="form-group">
						<label for="SOC" class="col-md-3 control-label">SOC</label>
						<div class="col-md-8">
							<div class="input-icon right">
								<input name="SOC" type="text"
									class="form-control rounded-form place-holder-color"
									id="SOC" value="" placeholder="SOC"
									onchange="onChange('SOC')">
							</div>
						</div>
						<span style="color:red">*</span>
					</div>
			</div>
			<div class="col-md-6">
					<div class="form-group">
						<label for="SOD" class="col-md-3 control-label">SOD</label>
						<div class="col-md-8">
							<div class="input-icon right">
								<input name="SOD" type="text"
									class="form-control rounded-form place-holder-color"
									id="SOD" value="" placeholder="SOD"
									onchange="onChange('SOD')">
							</div>
						</div>
						<span style="color:red">*</span>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="SOS" class="col-md-3 control-label">SOS</label>
						<div class="col-md-8">
							<div class="input-icon right">
								<input name="SOS" type="text"
									class="form-control rounded-form place-holder-color"
									id="SOS" value="" placeholder="SOS"
									onchange="onChange('SOS')">
							</div>
						</div>
						<span style="color:red">*</span>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="COD" class="col-md-3 control-label">COD</label>
						<div class="col-md-8">
							<div class="input-icon right">
								<input name="COD" type="text"
									class="form-control rounded-form place-holder-color"
									id="COD" value="" placeholder="COD"
									onchange="onChange('COD')">
							</div>
						</div>
						<span style="color:red">*</span>
					</div>
				</div>


				<div class="col-md-6">
					<div class="form-group">
						<label for="COS" class="col-md-3 control-label">COS</label>
						<div class="col-md-8">
							<div class="input-icon right">
								<input name="COS" type="text"
									class="form-control rounded-form place-holder-color"
									id="COS" value="" placeholder="COS"
									onchange="onChange('COS')">
							</div>
						</div>
						<span style="color:red">*</span>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label for="AOD" class="col-md-3 control-label">AOD</label>
						<div class="col-md-8">
							<div class="input-icon right">
								<input name="AOD" type="text"
									class="form-control rounded-form place-holder-color"
									id="AOD" value="" placeholder="AOD"
									onchange="onChange('AOD')">
							</div>
						</div>
						<span style="color:red">*</span>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label for="AOS" class="col-md-3 control-label">AOS</label>
						<div class="col-md-8">
							<div class="input-icon right">
								<input name="AOS" type="text"
									class="form-control rounded-form place-holder-color"
									id="AOS" value="" placeholder="AOS"
									onchange="onChange('AOS')">
							</div>
						</div>
						<span style="color:red">*</span>
					</div>
				</div>


				<div class="col-md-6">
					<div class="form-group">
						<label for="ADDOD" class="col-md-3 control-label">ADD OD</label>
						<div class="col-md-9">
							<div class="input-icon right">
								<input name="ADDOD" type="text"
									class="form-control rounded-form place-holder-color"
									id="ADDOD" value="" placeholder="ADD OD"
									onchange="onChange('ADDOD')">
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label for="ADDOS" class="col-md-3 control-label">ADD OS</label>
						<div class="col-md-9">
							<div class="input-icon right">
								<input name="ADDOS" type="text"
									class="form-control rounded-form place-holder-color"
									id="ADDOS" value="" placeholder="ADD OS"
									onchange="onChange('ADDOS')">
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
				<div class="form-group">
					<label for="lenseType" class="col-md-3 control-label">Lens
						Type</label>
					<div class="col-md-9">

						<select class="form-control rounded-form " name="lenseType"
							id="lenseType" onchange="showTypeForm();">
							<option value="-1" selected>--- Select Lens Type ---</option>
							<option value="1">Lens</option>
							<option value="2">Contact Lens</option>
						</select>
					</div>
				</div>
			</div>

			<div id="lenseForm" style="display: none">
				<div class="col-md-6">
					<div class="form-group">
						<label for="PDF" class="col-md-3 control-label">PDF</label>
						<div class="col-md-9">
							<div class="input-icon right">
								<input name="PDF" type="text"
									class="form-control rounded-form place-holder-color"
									id="PDF" value="" placeholder="PDF"
									onchange="onChange('PDF')">
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="PDN" class="col-md-3 control-label">PDN</label>
						<div class="col-md-9">
							<div class="input-icon right">
								<input name="PDN" type="text"
									class="form-control rounded-form place-holder-color"
									id="PDN" value="" placeholder="PDN"
									onchange="onChange('PDN')">
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label for="typeId" class="col-md-3 control-label"> Type</label>
						<div class="col-md-9">
							<select class="form-control rounded-form " name="typeId"
								id="typeId">
								<option value="-1" selected>--- Select Type ---</option>
<?php
$query = "SELECT * FROM `type` WHERE type.lenseOrContatLense=\"lense\"";
$r = exec_query(DBNAME, $query);
while ($row = mysqli_fetch_assoc($r)) {
    ?>
<option value="<?php echo $row['typeId']; ?>"><?php echo $row['name']; ?></option>
<?php } ?>
						</select>
						</div>
					</div>
				</div>


				<div class="col-md-6">
					<div class="form-group">
						<label for="typeCorrectionId" class="col-md-3 control-label">Correction
							Type</label>
						<div class="col-md-9">

							<select class="form-control rounded-form " name="typeCorrectionId"
								id="typeCorrectionId">
								<option value="-1" selected>--- Select Correction Type ---</option>
<?php
$query = "SELECT * FROM `typecorrection";
$r = exec_query(DBNAME, $query);
while ($row = mysqli_fetch_assoc($r)) {
    ?>
<option value="<?php echo $row['correctionId']; ?>"><?php echo $row['name']; ?></option>
<?php } ?>
						</select>
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label for="coatingId" class="col-md-3 control-label">Coating</label>
						<div class="col-md-9">

							<select class="form-control rounded-form " name="coatingId"
								id="coatingId">
								<option value="-1" selected>--- Select Coating ---</option>
<?php
$query = "SELECT * FROM `coating`";
$r = exec_query(DBNAME, $query);
while ($row = mysqli_fetch_assoc($r)) {
    ?>
<option value="<?php echo $row['coatingId']; ?>"><?php echo $row['name']; ?></option>
<?php } ?>
						</select>
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label for="frameId" class="col-md-3 control-label">Frame</label>
						<div class="col-md-9">

							<select class="form-control rounded-form " name="frameId"
								id="frameId">
								<option value="-1" selected>--- Select Frame---</option>
<?php
$query = "SELECT * FROM `frame`";
$r = exec_query(DBNAME, $query);
while ($row = mysqli_fetch_assoc($r)) {
    ?>
<option value="<?php echo  $row['frameId']; ?>"><?php echo $row['name']; ?></option>
<?php } ?>
						</select>
						</div>
					</div>
				</div>

			</div>
			<div id="contactLenseForm" style="display: none">
			
				<div class="col-md-6">
					<div class="form-group">
						<label for="dominantEye" class="col-md-3 control-label">Dominant Eye</label>
						<div class="col-md-9">
							<div class="input-icon right">
								<input name="dominantEye" type="text"
									class="form-control rounded-form place-holder-color"
									id="dominantEye" value="" placeholder="dominantEye"
									onchange="onChange('dominantEye')">
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="fellowEye" class="col-md-3 control-label">Fellow Eye</label>
						<div class="col-md-9">
							<div class="input-icon right">
								<input name="fellowEye" type="text"
									class="form-control rounded-form place-holder-color"
									id="FelllowtEye" value="" placeholder="Felllow Eye"
									onchange="onChange('fellowEye')">
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="cTypeId" class="col-md-3 control-label">Type</label>
						<div class="col-md-9">

							<select class="form-control rounded-form" name="cTypeId"
								id="cTypeId">
								<option value="-1" selected>--- Select Type---</option>
<?php
$query = "SELECT * FROM `type` WHERE type.lenseOrContatLense=\"ContactLense\"";
$r = exec_query(DBNAME, $query);
while ($row = mysqli_fetch_assoc($r)) {
    ?>
    <option value="<?php echo $row['typeId']; ?>"><?php echo $row['name']; ?></option>
<?php }?>
						</select>
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label for="cBrandId" class="col-md-3 control-label">Brand</label>
						<div class="col-md-9">

							<select class="form-control rounded-form" name="cBrandId"
								id="cBrandId">
								<option value="-1" selected>--- Select Brand---</option>
<?php
$query = "SELECT * FROM brand";
$r = exec_query(DBNAME, $query);
while ($row = mysqli_fetch_assoc($r)) {
    ?>
	<option value="<?php echo $row['brandId']; ?>"><?php echo $row['name']; ?></option>
<?php }?>
						</select>
						</div>
					</div>
				</div>
			</div>
<?php
$query = "select max(clientId) from client";
$r = exec_query(DBNAME, $query);
$row = mysqli_fetch_assoc($r);
?>
<div type="text" hidden name="clientId" id="clientId" value="<?php echo $row['clientId'];?>">Client ID</div>
			
			<div class="col-md-12">
			<button class="btn btn-success pull-right" style='margin-top:20px;' type="submit" >
				Submit
			</button>
			</div>
		</div>
	</div>

	<script>
$(document).ready(function(){
/* $('#dob').datepicker();
$('#dateAttendance').datepicker();
$('#dateReceived').datepicker(); */
	$('.datepicker').datepicker({
		format: 'dd/mm/yyyy' 
		});
});
</script>