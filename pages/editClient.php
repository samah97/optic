<?php include 'menu.php';  ?>
<?php

// ----------------------------------Objects Declaration-------------------------------------//
$visualProblemsObj = new VisualProblemEXT();
$functionalSignsObj = new FunctionalSignEXT();
$controlObj = new ControlEXT();
$typeOfCorrectionObj = new TypeCorrectionEXT();
$wearTypeObj = new WearTypeEXT();
$workStationObj = new WorkStationEXT();
$diseaseObj = new DiseaseEXT();
$medicationIntakeObj = new MedicationIntakeEXT();
$coverTestObj = new CoverTestEXT();
$occularMotilityObj = new OcularMotilityEXT();
// ----------------------------------End of Objects Declaration-------------------------------------//

$visualProblems = $visualProblemsObj->getAllRecords();
$functionalSigns = $functionalSignsObj->getAllRecords();
$control = $controlObj->getAllRecords();
$typeOfCorrection = $typeOfCorrectionObj->getAllRecords();
$wearType = $wearTypeObj->getAllRecords();
$workStation = $workStationObj->getAllRecords();
$disease = $diseaseObj->getAllRecords();
$medicationIntake = $medicationIntakeObj->getAllRecords();
$coverTest = $coverTestObj->getAllRecords();
$occularMotility = $occularMotilityObj->getAllRecords();
?>
<script>
var isEdit = <?php echo isset($isEdit) && $isEdit?"true":"false"; ?>;
</script>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="assets/global/plugins/datatables/datatables.min.css"
	rel="stylesheet" type="text/css" />
<link
	href="assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css"
	rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->

<div class="container">
	<div class="row">
		<!-- <div class="col-md-12">
			<h3 class="text-center">New Client</h3>
		</div> -->
		
		
		
		<!-- onSubmit="if(!validateForm()){return false;}" -->
		<div class="col-md-12">
			<form id="newClient" name="newClient"
				action="action/insertClient.php?fromPage=newClient" method="POST"
				>
				<div class="portlet light bordered" style="overflow: hidden;">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-social-dribbble font-purple-soft"></i> <span
								class="caption-subject font-purple-soft bold uppercase">New
								Client</span>
						</div>
					</div>
					<div class="portlet-body">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab_1_1" data-toggle="tab"> Personal
									Info </a></li>
							<li><a href="#tab_1_2" data-toggle="tab"> Reason of consultation
							</a></li>
							<li><a href="#tab_1_3" data-toggle="tab"> Refractions History </a>
							</li>
							<li><a href="#tab_1_4" data-toggle="tab"> Visual needs </a></li>
							<li><a href="#tab_1_5" data-toggle="tab"> Visual antecedents </a>
							</li>
							<li><a href="#tab_1_6" data-toggle="tab"> Preliminary examination
							</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="tab_1_1">
								<div class="container">
									<div class="col-md-6">
										<div class="form-group">
											<label for="fullName" class="col-md-3 control-label">Full
												Name</label>
											<div class="col-md-8">
												<div class="input-icon right">
													<input name="fullName" type="text"
														class="form-control rounded-form place-holder-color"
														id="fullName" value="" placeholder="full Name"
														onchange="onChange('req_first_name')">
												</div>
											</div>
											<span style="color: red">*</span>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="dob" class="col-md-3 control-label">Date of Birth</label>
											<div class="col-md-8">
												<div class="input-icon right">
													<input name="dob" type="text"
														class="form-control rounded-form place-holder-color datepicker"
														id="dob" value="" placeholder="Date of Birth"
														onchange="onChange('dob')">
												</div>
											</div>
											<span style="color: red">*</span>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="address" class="col-md-3 control-label">Address</label>
											<div class="col-md-8">
												<div class="input-icon right">
													<textarea
														class="form-control rounded-form place-holder-color"
														placeholder="Address" rows="5"
														onchange="onChange('address')" name="address" id="address"></textarea>
												</div>
											</div>
											<span style="color: red">*</span>
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
											<span style="color: red">*</span>
										</div>
									</div>

									<div class="form-group radio col-md-6">
										<label for="gender" class="col-md-3 control-label">Gender :</label>
										<br> <br> &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;<label><input
											type="radio" name="gender" id="male" value="male"
											<?php echo $checkedMale?>>Male</label>&nbsp;&nbsp;&nbsp; <label><input
											type="radio" name="gender" id="female" value="female"
											<?php echo $checkedFemale ?>>Female</label>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label for="occupation" class="col-md-3 control-label">Occupation</label>
											<div class="col-md-8">
												<div class="input-icon right">
													<input name="occupation" type="text"
														class="form-control rounded-form place-holder-color"
														id="occupation" value="" placeholder="Occupation">
												</div>
											</div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label for="refferedBy" class="col-md-3 control-label">Reffered
												By</label>
											<div class="col-md-8">
												<div class="input-icon right">
													<input name="refferedBy" type="text"
														class="form-control rounded-form place-holder-color"
														id="refferedBy" value="" placeholder="Reffered By">
												</div>
											</div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label for="hobbies" class="col-md-3 control-label">Hobbies</label>
											<div class="col-md-8">
												<div class="input-icon right">
													<input name="hobbies" type="text"
														class="form-control rounded-form place-holder-color"
														id="hobbies" placeholder="Hobbies">
												</div>
											</div>
										</div>
									</div>

								</div>
								<label style="color: red"> * are required</label>
							</div>
							<div class="tab-pane fade" id="tab_1_2">
								<br>
								<fieldset >
									<legend>Visual Problems</legend>
									<div id="section_vp">
							<?php
    foreach ($visualProblems as $row) {
        ?>
				    <div class="col-md-3">
										<div class="form-group">
											<div class="mt-checkbox-list" style='padding: 0px'>
												<label class="mt-checkbox"> <?php echo $row->title ?> <input
													type="checkbox" id="vs_<?php echo $row->visualProblemId ?>"
													value="<?php echo $row->visualProblemId ?>"
													name="visualProblems[]" /> <span></span>
												</label>
											</div>
										</div>
									</div>	
							    <?php
    }
    ?>
    </div>
							</fieldset>
								<fieldset id="section_fs">
									<legend>Functional Signs</legend>
									<div id="section_fs">
   						 <?php
        
        foreach ($functionalSigns as $row) {
            ?>
													    <div class="col-md-3">
										<div class="form-group">
											<div class="mt-checkbox-list" style='padding: 0px'>
												<label class="mt-checkbox"> <?php echo $row->title ?> <input
													type="checkbox"
													id="fs_<?php echo $row->functionalSignId ?>"
													value="<?php echo $row->functionalSignId ?>"
													name="functionalSigns[]" /> <span></span>
												</label>
											</div>
										</div>
									</div>	
							    <?php
        }
        ?>
							<div class="hidden" id="headaches_more">
										<div class="col-md-3">
											<div class="form-group">
												<div class="col-md-12">
													<div class="input-icon right">
														<input name="Localization" type="text"
															class="form-control rounded-form place-holder-color"
															id="Localization" value="" placeholder="Localization">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								</fieldset>
								<fieldset >
									<legend>Control</legend>
									<div id="section_control">
							<?php
    foreach ($control as $row) {
        ?>
									<div class="col-md-3">
										<div class="form-group">
											<div class="mt-checkbox-list" style='padding: 0px'>
												<label class="mt-checkbox"> <?php echo $row->title ?> <input
													type="checkbox" id="ct_<?php echo $row->controlId ?>"
													value="<?php echo $row->controlId ?>" name="control[]" /> <span></span>
												</label>
											</div>
										</div>
									</div>	
							    <?php
    }
    ?>
    </div>
    <div id="section_3_2">
							<div class="col-md-12">
										<div class="form-group">
											<label for="address" class="col-md-2 control-label">Date Of
												Appearance</label>
											<div class="col-md-10">
												<div class="input-icon right">
													<div class="input-icon right">
														<input name="dateOfAttendance" type="date"
															class="form-control rounded-form place-holder-color"
															id="DateOfAttendance" value=""
															placeholder="Date Of Attendance">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="address" class="col-md-2 control-label">Characteristics
												Of Appearance</label>
											<div class="col-md-10">
												<div class="input-icon right">
													<div class="input-icon right">
														<input name="characteristicsOfAppearance" type="text"
															class="form-control rounded-form place-holder-color"
															id="characteristicsOfAppearance" value=""
															placeholder="Characteristics Of Appearance">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="address" class="col-md-2 control-label">Time/Moment
												Of Appearance</label>
											<div class="col-md-10">
												<div class="input-icon right">
													<div class="input-icon right">
														<input name="timeMomentOfAppearance" type="Time"
															class="form-control rounded-form place-holder-color"
															id="timeMomentOfAppearance" value=""
															placeholder="Time/Moment Of Appearance">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="address" class="col-md-2 control-label">frequency
												of troubles</label>
											<div class="col-md-10">
												<div class="input-icon right">
													<div class="input-icon right">
														<input name="frequencyoftroubles" type="text"
															class="form-control rounded-form place-holder-color"
															id="frequencyoftroubles" value=""
															placeholder="frequency of troubles">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="address" class="col-md-2 control-label">The
												Activity, the context: </label>
											<div class="col-md-10">
												<div class="input-icon right">
													<div class="input-icon right">
														<input name="activityContext" type="text"
															class="form-control rounded-form place-holder-color"
															id="activityContext" value=""
															placeholder="activityContext">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="address" class="col-md-2 control-label">The
												associated symptoms: </label>
											<div class="col-md-10">
												<div class="input-icon right">
													<div class="input-icon right">
														<input name="associatedSymptoms" type="text"
															class="form-control rounded-form place-holder-color"
															id="associatedSymptoms" value=""
															placeholder="Associated Symptoms">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="address" class="col-md-2 control-label">The
												Chronicity</label>
											<div class="col-md-10">
												<div class="input-icon right">
													<div class="input-icon right">
														<input name="chronicity" type="text"
															class="form-control rounded-form place-holder-color"
															id="chronicity" value="" placeholder="Chronicity">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="address" class="col-md-2 control-label">The
												Evolution</label>
											<div class="col-md-10">
												<div class="input-icon right">
													<div class="input-icon right">
														<input name="evolution" type="text"
															class="form-control rounded-form place-holder-color"
															id="evolution" value="" placeholder="Evolution">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="address" class="col-md-2 control-label">The
												Factors of Relief</label>
											<div class="col-md-10">
												<div class="input-icon right">
													<div class="input-icon right">
														<input name="factorsOfRelief" type="text"
															class="form-control rounded-form place-holder-color"
															id="factorsOfRelief" value=""
															placeholder="factorsOfRelief">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="address" class="col-md-2 control-label">Type of
												compensation worn</label>
											<div class="col-md-10">
												<div class="input-icon right">
													<div class="input-icon right">
														<input name="typeCompenstaionWorn" type="text"
															class="form-control rounded-form place-holder-color"
															id="typeCompenstaionWorn" value=""
															placeholder="typeCompenstaionWorn">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>	
								</fieldset>
							</div>
							<div class="tab-pane fade" id="tab_1_3">
								<div class="col-md-12">
									<div class="form-group">
										<label for="address" class="col-md-2 control-label">Date Of
											last exam</label>
										<div class="col-md-10">
											<div class="input-icon right">
												<div class="input-icon right">
													<input name="dateOflastExam" type="date"
														class="form-control rounded-form place-holder-color"
														id="dateOflastExam" value=""
														placeholder="Date Of Last Exam">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="typeOfCorrection" class="col-md-4 control-label">Type
											of Correction:</label>
							<?php
    foreach ($typeOfCorrection as $row) {
        ?>
        					 <div class="col-md-4">
											<div class="form-group">
												<div class="mt-checkbox-list" style='padding: 0px'>
													<label class="mt-checkbox"> <?php echo $row->title ?> <input
														type="checkbox"
														id="tc_<?php echo $row->typeCorrectionId ?>"
														value="<?php echo $row->typeCorrectionId ?>"
														name="typeOfCorrection[]" /> <span></span>
													</label>
												</div>
											</div>
										</div>	
							    <?php
    }
    ?>
							</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="satisfaction" class="col-md-2">Satisfaction</label>
										<div class="col-md-10">
											<div class="input-group">
												<input type="password" class="form-control"
													name="satisfaction" id="satisfaction"
													placeholder="Satisfaction"> <span class="input-group-addon">
													% </span>
											</div>
										</div>
									</div>

								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="wearingFrequecy" class="col-md-2 control-label">Wearing
											Frequecy</label>
										<div class="col-md-10">
											<div class="input-icon right">
												<div class="input-icon right">
													<input name="wearingFrequecy" type="text"
														class="form-control rounded-form place-holder-color"
														id="wearingFrequecy" value=""
														placeholder="Wearing Frequecy">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="reasonforWearingCorrection"
											class="col-md-2 control-label">Reason for Wearing Correction</label>
										<div class="col-md-10">
											<div class="input-icon right">
												<div class="input-icon right">
													<input name="reasonforWearingCorrection" type="text"
														class="form-control rounded-form place-holder-color"
														id="reasonforWearingCorrection" value=""
														placeholder="reasonforWearingCorrection">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="examDetails" class="col-md-2 control-label">Exam
											Details</label>
										<div class="col-md-10">
											<div class="input-icon right">
												<div class="input-icon right">
													<textarea
														class="form-control rounded-form place-holder-color"
														placeholder="Exam Details" rows="5" name="examDetails"
														id="examDetails"></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>
								<h4>Eyeglasses</h4>
								<table class="table table-striped table-hover table-bordered"
									id="sample_editable_1">
									<thead>
										<tr>
											<th class="no-borders"></th>
											<th>Sphere</th>
											<th>Cylinder</th>
											<th>Axis</th>
											<th>Addition</th>
											<th>PD</th>
											<th>Prism</th>
											<th>Base</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><b>OD</b></td>
											<td><input type="text" class="form-control input-small"
												value=""></td>
											<td><input type="text" class="form-control input-small"
												value=""></td>
											<td><input type="text" class="form-control input-small"
												value=""></td>
											<td rowspan="2"><textarea class="form-control input-small"
													style='height: 85px; resize: none'">123</textarea></td>
											<td><input type="text" class="form-control input-small"
												value=""></td>
											<td><input type="text" class="form-control input-small"
												value=""></td>
											<td><input type="text" class="form-control input-small"
												value=""></td>
										</tr>
										<tr>
											<td><b>OS</b></td>
											<td><input type="text" class="form-control input-small"
												value=""></td>
											<td><input type="text" class="form-control input-small"
												value=""></td>
											<td><input type="text" class="form-control input-small"
												value=""></td>
											<td><input type="text" class="form-control input-small"
												value=""></td>
											<td><input type="text" class="form-control input-small"
												value=""></td>
											<td><input type="text" class="form-control input-small"
												value=""></td>
										</tr>
									</tbody>
								</table>

								<h4>Contact Lenses</h4>
								<table class="table table-striped table-hover table-bordered"
									id="sample_editable_2">
									<thead>
										<tr>
											<th class="no-borders"></th>
											<th>Sphere</th>
											<th>Cylinder</th>
											<th>Axis</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><b>OD</b></td>
											<td><input type="text" class="form-control input-small"
												value=""></td>
											<td><input type="text" class="form-control input-small"
												value=""></td>
											<td><input type="text" class="form-control input-small"
												value=""></td>

										</tr>
										<tr>
											<td><b>OS</b></td>
											<td><input type="text" class="form-control input-small"
												value=""></td>
											<td><input type="text" class="form-control input-small"
												value=""></td>
											<td><input type="text" class="form-control input-small"
												value=""></td>
										</tr>
									</tbody>
								</table>
								<div class="col-md-3">
									<div class="form-group">
										<div class="mt-checkbox-list" style='padding: 0px'>
											<label class="mt-checkbox"> Soft <input type="checkbox"
												id="wt_soft" value="soft" name="soft" /> <span></span>
											</label>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<div class="mt-checkbox-list" style='padding: 0px'>
											<label class="mt-checkbox"> Hard <input type="checkbox"
												id="wt_hard" value="hard" name="hard" /> <span></span>
											</label>
										</div>
									</div>
								</div>		
								<?php
        foreach ($wearType as $row) {
            ?>
				    <div class="col-md-3">
									<div class="form-group">
										<div class="mt-checkbox-list" style='padding: 0px'>
											<label class="mt-checkbox"> <?php echo $row->title ?> <input
												type="checkbox" id="wt_<?php echo $row->wearTypeId ?>"
												value="<?php echo $row->wearTypeId ?>" name="wearType[]" />
												<span></span>
											</label>
										</div>
									</div>
								</div>	
							    <?php
        }
        ?>
    	<div class="col-md-12">
									<div class="form-group">
										<label for="wearingFrequecy" class="col-md-3 control-label">Brand</label>
										<div class="col-md-8">
											<div class="input-icon right">
												<div class="input-icon right">
													<input name="brand" type="text"
														class="form-control rounded-form place-holder-color"
														id="brand" value="" placeholder=Brand">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="DK" class="col-md-3 control-label">DK</label>
										<div class="col-md-8">
											<div class="input-icon right">
												<div class="input-icon right">
													<input name="DK" type="text"
														class="form-control rounded-form place-holder-color"
														id="DK" value="" placeholder=DK">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
											<label for="address" class="col-md-3 control-label">Is preffered, why?</label>
											<div class="col-md-8">
												<div class="input-icon right">
													<textarea
														class="form-control rounded-form place-holder-color"
														placeholder="preffered Reason" rows="5"
														 name="prefferedReason" id="prefferedReason"></textarea>
												</div>
											</div>
										</div>
								</div>
</div>
								<div class="tab-pane fade" id="tab_1_4">
									<fieldset>
									<legend>Proffesional Activity</legend>
									<div class="col-md-12">
									<div class="col-md-3">
										<div class="form-group">
	 									<label>Mostly</label>
										</div>
									</div>
									 <div class="col-md-3">
										<div class="form-group">
											<div class="mt-checkbox-list" style='padding: 0px'>
												<label class="mt-checkbox"> Far <input
													type="checkbox" id="far"
													value="far"
													name="far" /> <span></span>
												</label>
											</div>
										</div>
									</div>	
									 <div class="col-md-3">
										<div class="form-group">
											<div class="mt-checkbox-list" style='padding: 0px'>
												<label class="mt-checkbox"> Near <input
													type="checkbox" id="near"
													value="near"
													name="near" /> <span></span>
												</label>
											</div>
										</div>
									</div>	
								</div>
								<div class="col-md-12">
								<div class="col-md-3">
										<div class="form-group">
	 									<label>Required Attention Degree</label>
										</div>
									</div>
									 <div class="col-md-3">
										<div class="form-group">
											<div class="mt-checkbox-list" style='padding: 0px'>
												<label class="mt-checkbox"> Partially <input
													type="checkbox" id="partially"
													value="partially"
													name="partially" /> <span></span>
												</label>
											</div>
										</div>
									</div>	
									 <div class="col-md-3">
										<div class="form-group">
											<div class="mt-checkbox-list" style='padding: 0px'>
												<label class="mt-checkbox"> Fully <input
													type="checkbox" id="fully"
													value="fully"
													name="fully" /> <span></span>
												</label>
											</div>
										</div>
									</div>
								</div>	
								<div class="col-md-12">
									<div class="form-group">
											<label for="Visual task duration" class="col-md-3 control-label">Visual task duration</label>
											<div class="col-md-8">
												<div class="input-icon right">
													<input name="visualTaskDuration" type="text"
														class="form-control rounded-form place-holder-color"
														id="visualTaskDuration" value="" placeholder="Visual Task Duration"
														>
												</div>
											</div>
										</div>
								</div>	
								<div class="col-md-12">
									<div class="form-group">
											<label for="workDistance" class="col-md-3 control-label">Working Distance</label>
											<div class="col-md-8">
												<div class="input-icon right">
													<input name="workDistance" type="text"
														class="form-control rounded-form place-holder-color"
														id="workDistance" value="" placeholder="Work Distance"
														>
												</div>
											</div>
										</div>
								</div>	
								<div class="col-md-12">
								<label  class="col-md-3 control-label">Work Station</label>
								<?php
        foreach ($workStation as $row) {
            ?>
				    <div class="col-md-3">
									<div class="form-group">
										<div class="mt-checkbox-list" style='padding: 0px'>
											<label class="mt-checkbox"> <?php echo $row->title ?> <input
												type="checkbox" id="ws_<?php echo $row->workStationId ?>"
												value="<?php echo $row->workStationId ?>" name="workStation[]" />
												<span></span>
											</label>
										</div>
									</div>
								</div>	
							    <?php
        }
        ?>
								</div>	
								<div class="col-md-12">
									<div class="form-group">
											<label for="workDistance" class="col-md-3 control-label">Lightning</label>
											<div class="col-md-8">
												<div class="input-icon right">
													<input name="lightning" type="text"
														class="form-control rounded-form place-holder-color"
														id="lightning" value="" placeholder="Lightning"
														>
												</div>
											</div>
										</div>
								</div>
							
								<div class="col-md-3">
									<div class="form-group">
										<div class="mt-checkbox-list" style='padding: 0px'>
											<label class="mt-checkbox"> Needs a good color vision <input
												type="checkbox" id="colorVisionNeeded"
												value="" name="colorVisionNeeded" />
												<span></span>
											</label>
										</div>
									</div>
								</div>
									<div class="col-md-3">
									<div class="form-group">
										<div class="mt-checkbox-list" style='padding: 0px'>
											<label class="mt-checkbox"> Ambiance<input
												type="checkbox" id="ambiance"
												value="" name="ambiance" />
												<span></span>
											</label>
										</div>
									</div>
								</div>
									<div class="col-md-3">
									<div class="form-group">
										<div class="mt-checkbox-list" style='padding: 0px'>
											<label class="mt-checkbox">Dust<input
												type="checkbox" id="dust"
												value="" name="dust" />
												<span></span>
											</label>
										</div>
									</div>
								</div>
									<div class="col-md-3">
									<div class="form-group">
										<div class="mt-checkbox-list" style='padding: 0px'>
											<label class="mt-checkbox">Chemical products<input
												type="checkbox" id="chemicalProducts"
												value="" name="chemicalProducts" />
												<span></span>
											</label>
										</div>
									</div>
								</div>
									<div class="col-md-3">
									<div class="form-group">
										<div class="mt-checkbox-list" style='padding: 0px'>
											<label class="mt-checkbox">Stress<input
												type="checkbox" id="stress"
												value="" name="stress" />
												<span></span>
											</label>
										</div>
									</div>
								</div>
									<div class="col-md-3">
									<div class="form-group">
										<div class="mt-checkbox-list" style='padding: 0px'>
											<label class="mt-checkbox">Trauma Risk<input
												type="checkbox" id="traumaRisk"
												value="" name="traumaRisk" />
												<span></span>
											</label>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
											<label for="otherVisualNeeds" class="col-md-3 control-label">Other</label>
											<div class="col-md-8">
												<div class="input-icon right">
													<input name="otherVisualNeeds" type="text"
														class="form-control rounded-form place-holder-color"
														id="otherVisualNeeds" value="" placeholder="Other Visual Needs"
														>
												</div>
											</div>
										</div>
								</div>	
								<div class="col-md-12">
									<div class="form-group">
											<label for="activityDescription" class="col-md-3 control-label">Discription of the activity</label>
											<div class="col-md-8">
												<div class="input-icon right">
													<input name="activityDescription" type="text"
														class="form-control rounded-form place-holder-color"
														id="activityDescription" value="" placeholder="Activity Description"
														>
												</div>
											</div>
										</div>
								</div>		
									</fieldset>
									<fieldset>
									<legend>Extra Proffessional Activities</legend>
									<textarea
									class="form-control rounded-form place-holder-color"
									placeholder="extraProffesionalActivities" rows="5"
									 name="extraProffesionalActivities" id="extraProffesionalActivities"></textarea>
									</fieldset>
								</div>
							<div class="tab-pane fade" id="tab_1_5">
							<div class="col-md-12">
									<div class="form-group">
											<label for="ocularPothologies" class="col-md-3 control-label">Ocular Pathologies</label>
											<div class="col-md-8">
												<div class="input-icon right">
													<input name="ocularPathologies" type="text"
														class="form-control rounded-form place-holder-color"
														id="ocularPathologies" value="" placeholder="Ocular Pathologies"
														>
												</div>
											</div>
										</div>
								</div>
							<div class="col-md-12">
									<div class="form-group">
											<label for="occularSurgeries" class="col-md-3 control-label">Ocular Surgeries</label>
											<div class="col-md-8">
												<div class="input-icon right">
													<input name="ocularSurgeries" type="text"
														class="form-control rounded-form place-holder-color"
														id="ocularSurgeries" value="" placeholder="Ocular Surgeries"
														>
												</div>
											</div>
										</div>
								</div>	
								<div class="col-md-12">
									<div class="form-group">
											<label for="Traumatism" class="col-md-3 control-label">Traumatism</label>
											<div class="col-md-8">
												<div class="input-icon right">
													<input name="traumatism" type="text"
														class="form-control rounded-form place-holder-color"
														id="traumatism" value="" placeholder="Traumatism"
														>
												</div>
											</div>
										</div>
								</div>
									
								<div class="col-md-12">
									<div class="form-group">
											<label for="orthopticTreatments" class="col-md-3 control-label">Orthoptic Treatments</label>
											<div class="col-md-8">
												<div class="input-icon right">
													<input name="orthopticTreatments" type="text"
														class="form-control rounded-form place-holder-color"
														id="orthopticTreatments" value="" placeholder="Orthoptic Treatments"
														>
												</div>
											</div>
										</div>
								</div>
									<?php
		foreach ($disease as $row) {
            ?>
				    <div class="col-md-3">
									<div class="form-group">
										<div class="mt-checkbox-list" style='padding: 0px'>
											<label class="mt-checkbox"> <?php echo $row->title ?> <input
												type="checkbox" id="disease_<?php echo $row->diseaseId ?>"
												value="<?php echo $row->diseaseId ?>" name="disease[]" />
												<span></span>
											</label>
										</div>
									</div>
								</div>	
							    <?php
        }
        ?>
        <h3>Medication Intake</h3>								
									<?php
		foreach ($medicationIntake as $row) {
            ?>
				    <div class="col-md-3">
									<div class="form-group">
										<div class="mt-checkbox-list" style='padding: 0px'>
											<label class="mt-checkbox"> <?php echo $row->title ?> <input
												type="checkbox" id="medicationIntake_<?php echo $row->medicationIntakeId ?>"
												value="<?php echo $row->medicationIntakeId ?>" name="medicationIntake[]" />
												<span></span>
											</label>
										</div>
									</div>
								</div>	
							    <?php
        }
        ?>
        <div class="col-md-12">
									<div class="form-group">
											<label for="otherDisease" class="col-md-3 control-label">Other</label>
											<div class="col-md-8">
												<div class="input-icon right">
													<input name="otherDisease" type="text"
														class="form-control rounded-form place-holder-color"
														id="otherDisease" value="" placeholder="Other"
														>
												</div>
											</div>
										</div>
								</div>
													<div class="clearfix margin-bottom-20"></div>
								
					</div>
					
					<div class="tab-pane fade" id="tab_1_6">
            		<table class="table table-striped table-hover table-bordered"
									id="keratometry_table">
									<thead>
										<tr>
											<th class="no-borders">Keratometry</th>
											<th>1st meridian (m.m.)</th>
											<th>Axis</th>
											<th>2nd meridian (m.m.)</th>
											<th>Axis</th>
											<th>Anterior Astigmatism</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><b>OD</b></td>
											<td><input type="text" class="form-control input-small"
												value=""></td>
											<td><input type="text" class="form-control input-small"
												value=""></td>
											<td><input type="text" class="form-control input-small"
												value=""></td>
											<td><input type="text" class="form-control input-small"
												value=""></td>
											<td><input type="text" class="form-control input-small"
												value=""></td>
										</tr>
										<tr>
											<td><b>OS</b></td>
											<td><input type="text" class="form-control input-small"
												value=""></td>
											<td><input type="text" class="form-control input-small"
												value=""></td>
											<td><input type="text" class="form-control input-small"
												value=""></td>
											<td><input type="text" class="form-control input-small"
												value=""></td>
											<td><input type="text" class="form-control input-small"
												value=""></td>		
										</tr>
									</tbody>
								</table>
								<div class="col-md-12">
								<h4><label>Distance</label></h4>
								</div>
								<div class="col-md-3">
										<div class="form-group">
											<div class="mt-checkbox-list" style='padding: 0px'>
												<label class="mt-checkbox"> Near <input
													type="checkbox" id="disstance_near"
													value="near"
													name="near" /> <span></span>
												</label>
											</div>
										</div>
									</div>	
									
								<div class="col-md-3">
										<div class="form-group">
											<div class="mt-checkbox-list" style='padding: 0px'>
												<label class="mt-checkbox"> 33 <input
													type="checkbox" id="disstance_33"
													value="33"
													name="33" /> <span></span>
												</label>
											</div>
										</div>
									</div>	
									
								<div class="col-md-3">
										<div class="form-group">
											<div class="mt-checkbox-list" style='padding: 0px'>
												<label class="mt-checkbox"> 50 <input
													type="checkbox" id="disstance_50"
													value="55"
													name="55" /> <span></span>
												</label>
											</div>
										</div>
									</div>	
									
								<div class="col-md-3">
										<div class="form-group">
											<div class="mt-checkbox-list" style='padding: 0px'>
												<label class="mt-checkbox"> 70 <input
													type="checkbox" id="disstance_70"
													value="70"
													name="70" /> <span></span>
												</label>
											</div>
										</div>
									</div>	
									
								<div class="col-md-3">
										<div class="form-group">
											<div class="mt-checkbox-list" style='padding: 0px'>
												<label class="mt-checkbox"> working distance <input
													type="checkbox" id="disstance_working"
													value="workingDistance"
													name="workingDistance" /> <span></span>
												</label>
											</div>
										</div>
								</div>		
								<table class="table table-striped table-hover table-bordered"
									id="measurement_table">
									<thead>
										<tr>
											<th colspan="2" class="no-borders">V.A measurement</th>
											<th>Far</th>
											<th>Bincular - Faar</th>
											<th>Bincular - Near</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td rowspan=2><b>Unaided V.A</b></td>
											<td><b>OD</b></td>
											<td><input type="text" class="form-control input-small"
												value=""></td>
											<td rowspan="2"><input id="bicularFarUNaided" type="text" class="form-control input-small"
												value=""></td>	
											<td rowspan="2"><input id="bicularNearUnaided" type="text" class="form-control input-small"
												value=""></td>	
										</tr>
										<tr>
											<td>OS</td>
											<td><input type="text" class="form-control input-small"
												value=""></td>
										</tr>
										<tr>
										<td rowspan=2>Aided V.A</td>
										<td>OD</td>
										<td><input type="text" class="form-control input-small"
												value=""></td>
										<td rowspan="2"><input id="bicularFarUNaided" type="text" class="form-control input-small"
												value=""></td>	
											<td rowspan="2"><input id="bicularNearUnaided" type="text" class="form-control input-small"
												value=""></td>	
										</tr>
										<tr>
										<td>OS</td>
										<td><input type="text" class="form-control input-small"
												value=""></td>
										</tr>
									</tbody>
								</table>								
        			<div class="col-md-12">
        			<div class="col-md-3">Unilateral and alternate cover test</div>
        			<div class="col-md-9">
        			<?php 
        			foreach ($coverTest as $row) {
        			   ?>
        			   <div class="col-md-3">
									<div class="form-group">
										<div class="mt-checkbox-list" style='padding: 0px'>
											<label class="mt-checkbox"> <?php echo $row->title ?> <input
												type="checkbox" id="coverTestObj_<?php echo $row->coverTestId ?>"
												value="<?php echo $row->coverTestId ?>" name="coverTestId[]" />
												<span></span>
											</label>
										</div>
									</div>
						</div>
					<?php }?>
        			</div>	
        			</div>
					<div class="col-md-12">
					<div class="col-md-3">
					<div class="form-group">
					<label>Punctum Proximum od convergence</label>
					</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<div class="mt-checkbox-list" style='padding: 0px'>
								<label class="mt-checkbox">Bris Distance<input
									type="checkbox" id="brisDistance"
									value="brisDistance"
									name="brisDistance"/> 	<span></span>
								</label>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<div class="mt-checkbox-list" style='padding: 0px'>
								<label class="mt-checkbox">Recoverment<input
									type="checkbox" id="recoverment"
									value="recoverment"
									name="recoverment"/> <span></span>
								</label>
							</div>
						</div>
					</div>
					<div class="col-md-3">
        			<label>Ocular motility</label>
        						<div class="form-group">
							<input type="text" id="xOverY" class="form-control input-small" value="xOverY"></td>
						</div>
					</div>
					</div>
					<div class="col-md-12">
        			<div class="col-md-3">
        			<div class="form-group">
        			<label>Ocular motility</label>
        			</div>
        			</div>
        			<div class="col-md-3">
						<div class="form-group">
							<div class="mt-checkbox-list" style='padding: 0px'>
								<label class="mt-checkbox">normal otherwise click on affected <input
									type="checkbox" id="normal"
									value="normal"
									name="normal"/><span></span>
								</label>
							</div>
						</div>
					</div>
					</div>
					<div class="col-md-12" style="background-color: lightgrey;">
					<div class="col-md-6">	
        			<table>
        			<tr>
        			<?php 
        			$realPath="../eye/";
        			$imagesPath = BASE_URL."eye/";
        			$curPosition = $occularMotility[0]->position;
        			$i=0;
        			foreach ($occularMotility as $row) {
        			    $i=="9"?$i=0:$i=$i;
        			    if($i==3 || $i==6){
        			       ?>
        			        </tr>
        			        <tr>
        			    <?php }
        			    if($row->position != $curPosition){
        			        $curPosition = $row->position;
        			        ?>
        			        </tr>
        			        </table>
        			        </div>
        			        <div class="col-md-6">
        			        <table>
        			        <tr>
        			        <?php 
        			    }
        			?>
        			 <td>
        			 <div class="nopad text-center">
                        <label class="image-checkbox" id="affectedPart_<?php echo $row->ocularMotilityId?>">
                          <img class="img-responsive"  src="<?php echo $imagesPath.$row->image?>" onclick="checkAffected('eye_<?php echo $row->ocularMotilityId?>','affectedPart_<?php echo $row->ocularMotilityId?>')"/>
                          <input type="hidden"  id="eye_<?php echo $row->ocularMotilityId?>"
                           name="image[]" value="eye_<?php echo $row->ocularMotilityId?>" />
                          <i class="fa fa-check hidden"></i>
                        </label>
                      </div>
                    </td>  
					<?php
					$i++; 
        			}?>
        			</tr>
        			</table>
        			</div>
        			</div>
        			<div class="col-md-12">
									<div class="form-group">
											<label for="stereoacuity" class="col-md-3 control-label">Stereoacuity Wirt test</label>
											<div class="col-md-7">
												<div class="input-icon right">
													<input name="stereoacuity" type="text"
														class="form-control rounded-form place-holder-color"
														id="stereoacuity" value="">
												</div>
											</div>
										<label for="stereoacuity" class="col-md-1 control-label">arcsecond</label>
										</div>
					</div>	
					<div class="col-md-12">
					<h3>Pupillary reflexs</h3>
					</div>
					<div class="col-md-12">
						<div class="col-md-3"><label>Photomotor</label></div>
						<div class="form-group">
							<div class="mt-checkbox-list col-md-3" style='padding: 0px'>
								<label class="mt-checkbox">Normal, if not, Describe<input
									type="checkbox" id="photomotor"
									value="photomotor"
									name="photomotor"/> <span></span>
								</label>
							</div>
						</div>
						<div class="col-md-3">
						<div class="input-icon right">
							<input name="photomotorDescription" type="text"
								class="form-control rounded-form place-holder-color"
								id="photomotorDescription" value="" placeholder="Description">
						</div>
						</div>
					</div>	
					<div class="col-md-12">
						<div class="col-md-3"><label>Consenual</label></div>
						<div class="form-group">
							<div class="mt-checkbox-list col-md-3" style='padding: 0px'>
								<label class="mt-checkbox">Normal, if not, Describe<input
									type="checkbox" id="consenual"
									value="consenual"
									name="consenual"/> <span></span>
								</label>
							</div>
						</div>
						<div class="col-md-3">
						<div class="input-icon right">
							<input name="consenualDescription" type="text"
								class="form-control rounded-form place-holder-color"
								id="consenualDescription" value="" placeholder="Description">
						</div>
						</div>
					</div>	
					<div class="col-md-12">
						<div class="col-md-3"><label>Accommodative</label></div>
						<div class="form-group">
							<div class="mt-checkbox-list col-md-3" style='padding: 0px'>
								<label class="mt-checkbox">Normal, if not, Describe<input
									type="checkbox" id="accommodative"
									value="accommodative"
									name="accommodative"/> <span></span>
								</label>
							</div>
						</div>
						<div class="col-md-3">
						<div class="input-icon right">
							<input name="accommodativeDescription" type="text"
								class="form-control rounded-form place-holder-color"
								id="accommodativeDescription" value="" placeholder="Description">
						</div>
						</div>
					</div>
					<div class="col-md-12">
					<fieldset>
					<legend>Deduction</legend>
					<textarea
					class="form-control rounded-form place-holder-color"
					rows="5" name="deduction" id="deduction"></textarea>
					</fieldset>
					</div>	
        			</div>	
            		</div>
					<div class="col-md-12">
						<button class="btn btn-success pull-right"
							style='margin-top: 20px;' type="submit">Save</button>
					</div>
				</div>
		
		<!-- BEGIN PAGE LEVEL PLUGINS -->
		<!-- <script
	src="<?php echo BASE_URL ?>plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js"
	type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->

		<script src="js/patient-page.js"></script>
		<!-- BEGIN PAGE LEVEL SCRIPTS -->
<!-- 		<script src="assets/pages/scripts/table-datatables-editable.min.js"
			type="text/javascript"></script>
 -->		<!-- END PAGE LEVEL SCRIPTS -->

<?php
// include_once("report.php");
include_once ("../footer.php");
?>