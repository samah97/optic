<?php include 'menu.php';  ?>
<?php

function getCheckboxData($tableName,$id,$valueName,$checkedId = null,$htmlName = "",$htmlId = "",$IdWRowId = false){
    $html = "";

    foreach($tableName as $row){
        if($htmlId != ""){
            $htmlId = $IdWRowId?$htmlId."_".$row->$id:$htmlId;
        }
        $checked= "";
        if($checkedId != null){
            if(is_array($checkedId)){
                    foreach($checkedId as $checkedRow){
                        if($row->$id == $checkedRow->$id){
                            $checked = "checked";
                        }
                    }
            }elseif($row->$id == $checkedId){
                $checked = "checked";
            }
        }
        
    $html .='<div class="col-md-3">
										<div class="form-group">
											<div class="mt-checkbox-list" style="padding: 0px">
												<label class="mt-checkbox"> '.$row->$valueName.'<input
													type="checkbox" id="'.$htmlId.'"
													value="'.$row->$id.'"
													name="'.$htmlName.'" '.$checked.'/> <span></span>
												</label>
											</div>
										</div>
		</div>';        
    }
    return  $html;
}

function getRadioButtonData($tableName,$id,$valueName,$checkedId = null,$htmlName = "",$htmlId = "",$IdWRowId = false){
    $html = "";
    
    foreach($tableName as $row){
        if($htmlId != ""){
            $htmlId = $IdWRowId?$htmlId."_".$row->$id:$htmlId;
        }
        $checked= "";
        if($checkedId != null){
            if(is_array($checkedId)){
                foreach($checkedId as $checkedRow){
                    if($row->$id == $checkedRow->$id){
                        $checked = "checked";
                    }
                }
            }elseif($row->$id == $checkedId){
                $checked = "checked";
            }
        }
        
        $html .=' <div class="col-md-3">
									<div class="form-group">
										<div class="mt-checkbox-list" style="padding: 0px">
											<label class="mt-radio">'.$row->title.'<input
												type="radio" id="'.$htmlId.'"
												value="'.$row->$rowId.'" name="'.$htmlName.'" />
												<span></span>
											</label>
										</div>
									</div>
								</div>	';
    }
    return  $html;
}


$visitId = $_GET['visit'];
$patientId = $_GET['patient'];
if( ! is_numeric($visitId) ||  $visitId < 0 ){
    $visitId = 0;
}
if( ! is_numeric($patientId) ||  $patientId < 0 ){
    $patientId = 0;
}



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
$pupillaryReflexsObj = new PupillaryReflexsEXT();
$harmonDistanceObj = new HarmonDistanceEXT();
$visitObj = new VisitEXT();
$patientInfoObj = new PatientInfoEXT();
$reasonConsulationObj = new ReasonConsultationEXT();
$refractionsHistoryObj = new RefractionHistoryEXT();
$visualNeedsObj = new VisualNeedEXT();
$visualAntecedentsObj = new VisualAntecedentEXT();
$preliminaryExaminationObj = new PreliminaryExaminationEXT();
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
$pupillaryReflexs = $pupillaryReflexsObj->getAllRecords();
$harmonDistance = $harmonDistanceObj->getAllRecords();
if($visitId > 0){
    $isEdit =  true;
    
    $visit = $visitObj->getVisit($visitId);
    if($visit->visitId > 0 ){
        $patientInfo = $patientInfoObj->getPatientInfo($visit->patientInfoId);
        $reasonConsulation = $reasonConsulationObj->getDataByVisit($visitId);
        
        $refractionHistory = $refractionsHistoryObj->getDataByVisit($visitId);
        $refractionHistory->correctionTypeId = json_decode($refractionHistory->correctionTypeId);
        
        $visualNeed = $visualNeedsObj->getDataByVisit($visitId);
        $visualAntecedent = $visualAntecedentsObj->getDataByVisit($visitId);
        $preliminaryExamination = $preliminaryExaminationObj->getDataByVisit($visitId);
        
    }else{
        header("Location: /login");
    }
}elseif($patientId > 0){
    $patientInfo = $patientInfoObj->getPatientInfo($patientId);
}


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
				action="action/insertClient.php?fromPage=newClient" method="POST">
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
											<label for="name" class="col-md-3 control-label">Full
												Name</label>
											<div class="col-md-8">
												<div class="input-icon right">
													<input name="name" type="text"
														class="form-control rounded-form place-holder-color"
														id="name" value="<?= $patientInfo->name ?>" placeholder="full Name"
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
														id="dob" value="<?= Common::formatDate($patientInfo->dob) ?>" placeholder="Date of Birth"
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
														onchange="onChange('address')" name="address" id="address"><?= $patientInfo->address ?></textarea>
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
														id="phone" value="<?= $patientInfo->phone ?>" placeholder="Phone"
														onchange="onChange('phone')">
												</div>
											</div>
											<span style="color: red">*</span>
										</div>
									</div>
								
									<div class="form-group radio col-md-6">
										<label for="gender" class="col-md-3 control-label">Gender :</label>
										<br> <br> &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;<label><input
											type="radio" name="genderId" id="male" value="1"
											<?= $patientInfo->genderId == 1?"checked":"" ?>>Male</label>&nbsp;&nbsp;&nbsp; <label><input
											type="radio" name="genderId" id="female"  value="2"
											<?= $patientInfo->genderId == 2?"checked":""  ?>>Female</label>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label for="occupation" class="col-md-3 control-label">Occupation</label>
											<div class="col-md-8">
												<div class="input-icon right">
													<input name="occupation" type="text"
														class="form-control rounded-form place-holder-color"
														id="occupation" value="<?= $patientInfo->occupation ?>" placeholder="Occupation">
												</div>
											</div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label for="reffered" class="col-md-3 control-label">Reffered
												By</label>
											<div class="col-md-8">
												<div class="input-icon right">
													<input name="referred" type="text"
														class="form-control rounded-form place-holder-color"
														value="<?= $patientInfo->referred ?>"
														id="referred"  placeholder="Reffered By">
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
														value="<?= $patientInfo->hobbies ?>"
														id="hobbies" value="" placeholder="Hobbies">
												</div>
											</div>
										</div>
									</div>

								</div>
								<label style="color: red"> * are required</label>
								
							</div>
							<div class="tab-pane fade" id="tab_1_2">
								<br>
								<fieldset>
									<legend>Visual Problems</legend>
									<div id="section_vp">
							<?php
							echo getCheckboxData($visualProblems, 'visualProblemId', 'title',$reasonConsulation->visualProblems,'visualProblems[]','vs',true);
							
							
    /*foreach ($visualProblems as $row) {
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
    }*/
    ?>
    						</div>
							</fieldset>
								<fieldset>
									<legend>Functional Signs</legend>
   						 <div id="section_fs">
   						 <?php
   						 echo getCheckboxData($functionalSigns, 'functionalSignsId', 'title',$reasonConsulation->functionalSigns,'functionalSigns[]','fs',true);
       /* foreach ($functionalSigns as $row) {
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
							    <?php*/
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
								<fieldset>
									<legend>Control</legend>
							<div id="section_control">
							<?php
							echo getCheckboxData($control, 'controlId', 'title',$reasonConsulation->control,'control[]','ct',true);
							
   /* foreach ($control as $row) {
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
    }*/
    ?></div>
    <div id="section_3_2">
							<div class="col-md-12">
										<div class="form-group">
											<label for="address" class="col-md-2 control-label">Date Of
												Appearance</label>
											<div class="col-md-10">
												<div class="input-icon right">
													<div class="input-icon right">
														<input name="dateAppearance" type="date"
															class="form-control rounded-form place-holder-color"
															id="dateAppearance" value="<?= $reasonConsulation->dateAppearance?>"
															placeholder="Date Of Appearance">
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="form-group">
											<label for="characteristicsAppearance" class="col-md-2 control-label">Characteristics
												Of Appearance</label>
											<div class="col-md-10">
												<div class="input-icon right">
													<div class="input-icon right">
														<input name="characteristicsAppearance" type="text"
															class="form-control rounded-form place-holder-color"
															id="characteristicsAppearance" value="<?= $reasonConsulation->characteristicsAppearance ?>"
															placeholder="Characteristics Of Appearance">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="timeAppearance" class="col-md-2 control-label">Time/Moment
												Of Appearance</label>
											<div class="col-md-10">
												<div class="input-icon right">
													<div class="input-icon right">
														<input name="timeAppearance" type="Time"
															class="form-control rounded-form place-holder-color"
															id="timeAppearance" value="<?= $reasonConsulation->timeAppearance ?>"
															placeholder="Time/Moment Of Appearance">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="frequencyTroubles" class="col-md-2 control-label">frequency
												of troubles</label>
											<div class="col-md-10">
												<div class="input-icon right">
													<div class="input-icon right">
														<input name="frequencyTroubles" type="text"
															class="form-control rounded-form place-holder-color"
															id="frequencyTroubles" 
															value="<?= $reasonConsulation->frequencyTroubles ?>"
															placeholder="Frequency of troubles">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="activityContext" class="col-md-2 control-label">The
												Activity, the context: </label>
											<div class="col-md-10">
												<div class="input-icon right">
													<div class="input-icon right">
														<input name="activityContext" type="text"
															class="form-control rounded-form place-holder-color"
															id="activityContext"
															value="<?= $reasonConsulation->activityContext ?>"
															placeholder="Activity context">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="associatedSymptoms" class="col-md-2 control-label">The
												associated symptoms: </label>
											<div class="col-md-10">
												<div class="input-icon right">
													<div class="input-icon right">
														<input name="associatedSymptoms" type="text"
															class="form-control rounded-form place-holder-color"
															id="associatedSymptoms"
															value="<?= $reasonConsulation->associatedSymptoms ?>"
															placeholder="Associated Symptoms">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="chronicity" class="col-md-2 control-label">The
												Chronicity</label>
											<div class="col-md-10">
												<div class="input-icon right">
													<div class="input-icon right">
														<input name="chronicity" type="text"
															class="form-control rounded-form place-holder-color"
															id="chronicity"
															value="<?= $reasonConsulation->chronicity ?>"
															placeholder="Chronicity">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="evolution" class="col-md-2 control-label">The
												Evolution</label>
											<div class="col-md-10">
												<div class="input-icon right">
													<div class="input-icon right">
														<input name="evolution" type="text"
															class="form-control rounded-form place-holder-color"
															id="evolution"
															value="<?= $reasonConsulation->evolution ?>"
															placeholder="Evolution">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="factorsRelief" class="col-md-2 control-label">The
												Factors of Relief</label>
											<div class="col-md-10">
												<div class="input-icon right">
													<div class="input-icon right">
														<input name="factorsRelief" type="text"
															class="form-control rounded-form place-holder-color"
															id="factorsRelief"
															value="<?= $reasonConsulation->factorsRelief ?>"
															placeholder="Factors Of Relief">
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
														<input name="compensationWormType" type="text"
															class="form-control rounded-form place-holder-color"
															id="compensationWormType"
															value="<?= $reasonConsulation->compensationWormType ?>" 
															placeholder="Compenstaion Worm Type">
													</div>
												</div>
											</div>
										</div>
									</div>
							</div>
								</fieldset>
							</div>
							<div class="tab-pane fade" id="tab_1_3">
								<div class="section_3_main">
								<div class="col-md-12">
									<div class="form-group">
										<label for="address" class="col-md-2 control-label">Date Of
											last exam</label>
										<div class="col-md-10">
											<div class="input-icon right">
												<div class="input-icon right">
													<input name="dateLastExam" type="date"
														class="form-control rounded-form place-holder-color"
														id="dateLastExam"
														value="<?= $refractionHistory->dateLastExam ?>" 
														placeholder="Date Of Last Exam">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="correctionTypeId" class="col-md-4 control-label">Type
											of Correction:</label>
							<?php
							
							echo getCheckboxData($typeOfCorrection, 'typeCorrectionId', 'title',$refractionHistory->correctionTypeId,'typeOfCorrection[]','tc',true);
							
  /*  foreach ($typeOfCorrection as $row) {
        ?>
        					 <div class="col-md-4">
											<div class="form-group">
												<div class="mt-checkbox-list" style='padding: 0px'>
													<label class="mt-checkbox"> <?php echo $row->title ?> <input
														type="checkbox"
														id="tc_<?php echo $row->typeCorrectionId ?>"
														value="<?php echo $row->typeCorrectionId ?>"
														name="correctionTypeId[]" /> <span></span>
													</label>
												</div>
											</div>
										</div>	
							    <?php
    }*/
    ?>
							</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="satisfaction" class="col-md-2">Satisfaction</label>
										<div class="col-md-10">
											<div class="input-group">
												<input type="text" class="form-control"
													name="satisfaction" id="satisfaction"
													value="<?= $refractionHistory->satisfaction ?>"
													placeholder="Satisfaction"> <span class="input-group-addon">
													% </span>
											</div>
										</div>
									</div>

								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="wearingFrequency" class="col-md-2 control-label">Wearing
											Frequecy</label>
										<div class="col-md-10">
											<div class="input-icon right">
												<div class="input-icon right">
													<input name="wearingFrequency" type="text"
														class="form-control rounded-form place-holder-color"
														id="wearingFrequency"
														value="<?= $refractionHistory->wearingFrequency ?>"
														placeholder="Wearing Frequecy">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="reasonCorrection"
											class="col-md-2 control-label">Reason for Wearing Correction</label>
										<div class="col-md-10">
											<div class="input-icon right">
												<div class="input-icon right">
													<input name="reasonCorrection" type="text"
														class="form-control rounded-form place-holder-color"
														id="reasonCorrection"
														value="<?= $refractionHistory->reasonCorrection ?>"
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
														id="examDetails"><?= $refractionHistory->examDetails ?></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>
								</div>
								<div id="eyeGlassesTable">
								<h4>Eyeglasses</h4>
								<table class="table table-striped table-hover table-bordered"
									name="refEyeglasses" id="refEyeglasses">
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
												value="<?= $refractionHistory->refEyeglass->sphereOd ?>" name="eye_sphereOd" id="eye_sphereOd"></td>
											<td><input type="text" class="form-control input-small"
												value="" name="eye_cylinderOd" id="eye_cylinderOd"></td>
											<td><input type="text" class="form-control input-small"
												value="<?= $refractionHistory->refEyeglass->axisOd ?>" name="eye_axisOd" id="eye_axisOd"></td>
											<td rowspan="2"><textarea class="form-control input-small"
													style='height: 85px; resize: none'" name="eye_addition" id="eye_addition"><?= $refractionHistory->refEyeglass->addition ?></textarea></td>
											<td><input type="text" class="form-control input-small"
												value="<?= $refractionHistory->refEyeglass->pdOd ?>" name="eye_pdOd" id="eye_pdOd"></td>
											<td><input type="text" class="form-control input-small"
												value="<?= $refractionHistory->refEyeglass->prismOd ?>" name="eye_prismOd" id="eye_prismOd"></td>
											<td><input type="text" class="form-control input-small"
												value="<?= $refractionHistory->refEyeglass->baseOd ?>" name="eye_baseOd" id="eye_baseOd"></td>
										</tr>
										<tr>
											<td><b>OS</b></td>
											<td><input type="text" class="form-control input-small"
												value="<?= $refractionHistory->refEyeglass->sphereOs ?>" name="eye_sphereOs" id="eye_sphereOs"></td>
											<td><input type="text" class="form-control input-small"
												value="<?= $refractionHistory->refEyeglass->cylinderOs ?>" name="eye_cylinderOs" id="eye_cylinderOs"></td>
											<td><input type="text" class="form-control input-small"
												value="<?= $refractionHistory->refEyeglass->axisOs ?>" name="eye_axisOs" id="eye_axisOs" ></td>
											<td><input type="text" class="form-control input-small"
												value="<?= $refractionHistory->refEyeglass->pdOs ?>"  name="eye_pdOs" id="eye_pdOs"></td>
											<td><input type="text" class="form-control input-small"
												value="<?= $refractionHistory->refEyeglass->prismOs ?>"  name="eye_prismOs" id="eye_prismOs"></td>
											<td><input type="text" class="form-control input-small"
												value="<?= $refractionHistory->refEyeglass->baseOs ?>"  name="eye_baseOs" id="eye_baseOs"></td>
										</tr>
									</tbody>
								</table>
								</div>
								<div id="contactLensTable">				
								<h4>Contact Lenses</h4>
								<table class="table table-striped table-hover table-bordered"
									name="refContact" id="refContact">
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
												value="<?= $refractionHistory->refContact->sphereOd ?>" name="contact_sphereOd" id="contact_sphereOd"></td>
											<td><input type="text" class="form-control input-small"
												value="<?= $refractionHistory->refContact->cylinderOd ?>" name="contact_cylinderOd" id="contact_cylinderOd"></td>
											<td><input type="text" class="form-control input-small"
												value="<?= $refractionHistory->refContact->axisOd ?>" name="contact_axisOd" id="contact_axisOd"></td>

										</tr>
										<tr>
											<td><b>OS</b></td>
											<td><input type="text" class="form-control input-small"
												value="<?= $refractionHistory->refContact->sphereOs ?>" name="contact_sphereOs" id="contact_sphereOs"></td>
											<td><input type="text" class="form-control input-small"
												value="<?= $refractionHistory->refContact->cylinderOs ?>" name="contact_cylinderOs" id="contact_cylinderOs"></td>
											<td><input type="text" class="form-control input-small"
												value="<?= $refractionHistory->refContact->axisOs ?>" name="contact_axisOs" id="contact_axisOs"></td>
										</tr>
									</tbody>
								</table>
								</div>
								<div class="section_3_main">	
								<?php
								echo getRadioButtonData($wearType, 'wearTypeId','title',$refractionHistory->wearingType,'wearTypeId[]','wt',true);
       /* foreach ($wearType as $row) {
            ?>
				    <div class="col-md-3">
									<div class="form-group">
										<div class="mt-checkbox-list" style='padding: 0px'>
											<label class="mt-radio"> <?php echo $row->title ?> <input
												type="radio" id="wt_<?php echo $row->wearTypeId ?>"
												value="<?php echo $row->wearTypeId ?>" name="wearTypeId" />
												<span></span>
											</label>
										</div>
									</div>
								</div>	
							    <?php
        }*/
        ?>
    	<div class="col-md-12">
									<div class="form-group">
										<label for="wearingFrequecy" class="col-md-3 control-label">Brand</label>
										<div class="col-md-8">
											<div class="input-icon right">
												<div class="input-icon right">
													<input name="brand" type="text"
														class="form-control rounded-form place-holder-color"
														id="brand" value="<?= $refractionHistory->brand ?>" placeholder="Brand">
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
														id="DK" value="<?= $refractionHistory->dk ?>" placeholder="DK">
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
														 name="prefferedReason" id="prefferedReason"><?= $refractionHistory->prefferedReason ?></textarea>
												</div>
											</div>
										</div>
								</div>
								</div>
</div>
								<div class="tab-pane fade" id="tab_1_4">\
									<fieldset>
									<legend>Proffesional Activity</legend>
									<div class="section_4">
									<div class="col-md-12">
									<div class="col-md-3">
										<div class="form-group">
	 									<label>Mostly</label>
										</div>
									</div>
									 <div class="col-md-3">
										<div class="form-group">
											<div class="mt-checkbox-list" style='padding: 0px'>
												<label for="isFar" class="mt-checkbox"> Far <input
													type="checkbox" id="isFar"
													name="isFar" /> <span></span>
												</label>
											</div>
										</div>
									</div>	
									 <div class="col-md-3">
										<div class="form-group">
											<div class="mt-checkbox-list" style='padding: 0px'>
												<label for="isNear" class="mt-checkbox"> Near <input
													type="checkbox" id="isNear"
													name="isNear" /> <span></span>
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
												<label for="isPartially" class="mt-checkbox"> Partially <input
													type="checkbox" id="isPartially"
													name="isPartially" /> <span></span>
												</label>
											</div>
										</div>
									</div>	
									 <div class="col-md-3">
										<div class="form-group">
											<div class="mt-checkbox-list" style='padding: 0px'>
												<label for="isFully" class="mt-checkbox"> Fully <input
													type="checkbox" id="isFully"
													name="isFully" /> <span></span>
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
													<input name="taskDuration" type="text"
														class="form-control rounded-form place-holder-color"
														id="taskDuration" value="" placeholder="Visual Task Duration"
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
								</div>
								<div id="section_work_station">
								<div class="col-md-12">
								<label  class="col-md-3 control-label">Work Station</label>
								<?php
								echo getCheckboxData($workStation, 'workStationId', 'title',$visualNeedsObj->workStation,'workStation[]','ws',true);
								
      /*  foreach ($workStation as $row) {
            ?>
				    <div class="col-md-3">
									<div class="form-group">
										<div class="mt-checkbox-list" style='padding: 0px'>
											<label for="ws_<?php echo $row->workStationId ?>" class="mt-checkbox"> <?php echo $row->title ?> <input
												type="checkbox" id="ws_<?php echo $row->workStationId ?>"
												value="<?php echo $row->workStationId ?>" name="workStation[]" />
												<span></span>
											</label>
										</div>
									</div>
								</div>	
							    <?php
        }*/
        ?>
        </div>
								</div>	
								<div class="section_4">
								<div class="col-md-12">
									<div class="form-group">
											<label for="lighting" class="col-md-3 control-label">Lightning</label>
											<div class="col-md-8">
												<div class="input-icon right">
													<input name="lighting" type="text"
														class="form-control rounded-form place-holder-color"
														id="lighting" value="" placeholder="Lightning"
														>
												</div>
											</div>
										</div>
								</div>
							
								<div class="col-md-3">
									<div class="form-group">
										<div class="mt-checkbox-list" style='padding: 0px'>
											<label class="mt-checkbox"> Needs a good color vision <input
												type="checkbox" id="isNeedColor"
												name="isNeedColor" />
												<span></span>
											</label>
										</div>
									</div>
								</div>
								</div>
								<div id="section_ambiance">
								
								<?php 		
								echo getCheckboxData($ambiance, 'ambianceId', 'title',$visualNeedsObj->ambiance,'ambiance[]','ambiance',true);
								/*foreach($ambiance as $row){ ?>
									<div class="col-md-3">
									<div class="form-group">
										<div class="mt-checkbox-list" style='padding: 0px'>
											<label for="ambiance_<?php echo $row->ambianceId ?>" class="mt-checkbox"> <?php echo $row->title ?><input
												type="checkbox" value="<?php echo $row->ambianceId ?>" id="ambiance_<?php echo $row->ambianceId ?>"
												name="ambianceId[]" />
												<span></span>
											</label>
										</div>
									</div>
								</div>
								<?php }*/ ?>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<div class="mt-checkbox-list" style='padding: 0px'>
											<label for="ambiance_other" class="mt-checkbox">Other<input
												type="checkbox" value= "0" id="ambiance_other"
												name="ambianceId[]" />
												<span></span>
											</label>
										</div>
									</div>
								</div>
								<div class="section_4">
								<div class="col-md-12 hidden divAmbianceOther">
									<div class="form-group">
											<label for="ambianceOther" class="col-md-3 control-label">Other</label>
											<div class="col-md-8">
												<div class="input-icon right">
													<input name="ambianceOther" type="text"
														class="form-control rounded-form place-holder-color"
														id="ambianceOther"  placeholder="Other Visual Needs"
														>
												</div>
											</div>
										</div>
								</div>	
									<div class="col-md-3">
									<div class="form-group">
										<div class="mt-checkbox-list" style='padding: 0px'>
											<label class="mt-checkbox">Trauma Risk<input
												type="checkbox" id="isTraumaRisk"
												name="isTraumaRisk" />
												<span></span>
											</label>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
											<label for="description" class="col-md-3 control-label">Discription of the activity</label>
											<div class="col-md-8">
												<div class="input-icon right">
													<input name="description" type="text"
														class="form-control rounded-form place-holder-color"
														id="description"  placeholder="Activity Description"
														>
												</div>
											</div>
										</div>
								</div>	
								</div>	
									</fieldset>
									<fieldset>
									<legend>Extra Proffessional Activities</legend>
									<div class="section_4">
									<textarea
									class="form-control rounded-form place-holder-color"
									placeholder="extraProffesionActivity" rows="5"
									 name="extraProffessionActivity" id="extraProffessionActivity"></textarea>
									</div>
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
								<div id="section_disease"></div>
									<?php
									echo getCheckboxData($disease, 'diseaseId', 'title',$visualAntecedentsObj->disease,'disease[]','disease',true);		
		/*foreach ($disease as $row) {
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
        }*/
        ?>
        <h3>Medication Intake</h3>								
									<?php
									echo getRadioButtonData($medicationIntake, 'medicationIntakeId', 'title',$visualAntecedentsObj->medicationIntake,'medicationIntake[]','medicationIntake',true);
									
		/*foreach ($medicationIntake as $row) {
            ?>
				    <div class="col-md-3">
									<div class="form-group">
										<div class="mt-checkbox-list" style='padding: 0px'>
											<label class="mt-radio"> <?php echo $row->title ?> <input
												type="radio" id="medicationIntake_<?php echo $row->medicationIntakeId ?>"
												value="<?php echo $row->medicationIntakeId ?>" name="medicationIntakeId" />
												<span></span>
											</label>
										</div>
									</div>
								</div>	
							    <?php
        }*/
        ?>
        				    <div class="col-md-3">
									<div class="form-group">
										<div class="mt-checkbox-list" style='padding: 0px'>
											<label for="medicationIntake_other" class="mt-radio">Other<input
												type="radio" id="medicationIntake_other" class="showOnToggle"
												value="0" name="medicationIntakeId" toShow="divMedicationIntakeOther" />
												<span></span>
											</label>
										</div>
									</div>
								</div>	
								<div class="col-md-12 divMedicationIntakeOther hidden">
									<div class="form-group">
											<label for="medicationIntakeOther" class="col-md-3 control-label">Orthoptic Treatments</label>
											<div class="col-md-8">
												<div class="input-icon right">
													<input name="medicationIntakeOther" type="text"
														class="form-control rounded-form place-holder-color"
														id="medicationIntakeOther" placeholder="Please specify"
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
											<td><input type="text" name="keratometry_firstMerdianOd" id="keratometry_firstMerdianOd" class="form-control input-small"
												value=""></td>
											<td><input type="text" name="keratometry_firstAxisOd" id="keratometry_firstAxisOd" class="form-control input-small"
												value=""></td>
											<td><input type="text" name="keratometry_secondMerdianOd" id="keratometry_secondMerdianOd"  class="form-control input-small"
												value=""></td>
											<td><input type="text"name="keratometry_secondAxisOd" id="keratometry_secondAxisOd" class="form-control input-small"
												value=""></td>
											<td><input type="text" name="keratometry_anteriorAstigmatismOd" id="keratometry_anteriorAstigmatismOd" class="form-control input-small"
												value=""></td>
										</tr>
										<tr>
											<td><b>OS</b></td>
											<td><input type="text" name="keratometry_firstMerdianOs" id="keratometry_firstMerdianOs" class="form-control input-small"
												value=""></td>
											<td><input type="text" name="keratometry_firstAxisOs" id="keratometry_firstAxisOs" class="form-control input-small"
												value=""></td>
											<td><input type="text" name="keratometry_secondMerdianOs" id="keratometry_secondMerdianOs" class="form-control input-small"
												value=""></td>
											<td><input type="text" name="keratometry_secondAxisOs" id="keratometry_secondAxisOs" class="form-control input-small"
												value=""></td>
											<td><input type="text" name="keratometry_anteriorAstigmatismOs" id="keratometry_anteriorAstigmatismOs" class="form-control input-small"
												value=""></td>		
										</tr>
									</tbody>
								</table>
								<div class="section_6">
								<div class="col-md-12">
								<h4><label>Distance</label></h4>
								</div>
								
								<?php $hasChecked = false; ?>
								<?php foreach($harmonDistance as $row){ ?>
								<?php $checked = $hasChecked == true?"":"checked"; ?>
								<?php $hasChecked = true; ?>
								<div class="col-md-3">
										<div class="form-group">
											<div class="mt-checkbox-list" style='padding: 0px'>
												<label class="mt-radio"> <?php  echo $row->title ?> <input
													type="radio" id="distance_<?php  echo $row->harmonDistanceId ?>"
													value="<?php  echo $row->harmonDistanceId ?>"
													name="harmonDistanceId" <?php echo $checked; ?> /> <span></span>
												</label>
											</div>
										</div>
								</div>
								<?php } ?>	
								</div>
								<table class="table table-striped table-hover table-bordered"
									id="measurement_table">
									<thead>
										<tr>
											<th colspan="2" class="no-borders">V.A measurement</th>
											<th>Far</th>
											<th>Bincular - Far</th>
											<th>Bincular - Near</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td rowspan=2><b>Unaided V.A</b></td>
											<td><b>OD</b></td>
											<td><input type="text" name="unaidedFarOd" id="unaidedFarOd" class="form-control input-small"
												value=""></td>
											<td rowspan="2"><input name="unaidedBinocularFar" id="unaidedBinocularFar" type="text" class="form-control input-small"
												value=""></td>	
											<td rowspan="2"><input name="unaidedBinocularNear" id="unaidedBinocularNear" type="text" class="form-control input-small"
												value=""></td>	
										</tr>
										<tr>
											<td>OS</td>
											<td><input type="text" name="unaidedFarOs" id="unaidedFarOs" class="form-control input-small"
												value=""></td>
										</tr>
										<tr>
										<td rowspan=2>Aided V.A</td>
										<td>OD</td>
										<td><input type="text" name="aidedFarOd" id="aidedFarOd" class="form-control input-small"
												value=""></td>
										<td rowspan="2"><input id="aidedBinocularFar" name="aidedBinocularFar" type="text" class="form-control input-small"
												value=""></td>	
											<td rowspan="2"><input id="aidedBinocularNear" name="aidedBinocularNear" type="text" class="form-control input-small"
												value=""></td>	
										</tr>
										<tr>
										<td>OS</td>
										<td><input type="text" name="aidedFarOs" id="aidedFarOs" class="form-control input-small"
												value=""></td>
										</tr>
									</tbody>
								</table>								
        			<div class="section_6">
        			<div class="col-md-12">
        			<div class="col-md-3">Unilateral and alternate cover test</div>
        			<div class="col-md-9">
        			<!-- TODO: Add in Backend  -->
        			<?php 
        			echo getCheckboxData($coverTest, 'coverTestId', 'title',$preliminaryExaminationObj->coverTest,'coverTest[]','coverTest',true);
        			/*
        			foreach ($coverTest as $row) {
        			   ?>
        			   <div class="col-md-3">
									<div class="form-group">
										<div class="mt-checkbox-list" style='padding: 0px'>
											<label class="mt-checkbox"> <?php echo $row->title ?> <input
												type="checkbox" id="coverTest_<?php echo $row->coverTestId ?>"
												value="<?php echo $row->coverTestId ?>" name="coverTestId[]" />
												<span></span>
											</label>
										</div>
									</div>
						</div>
					<?php }*/?>
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
									type="checkbox" id="convegenceRecoverement"
									name="convegenceRecoverement"/> <span></span>
								</label>
							</div>
						</div>
					</div>
					<div class="col-md-3">
        			<label>X/Y</label>
        						<div class="form-group">
							<input type="text" id="convergenceXy" name="convergenceXy" class="form-control input-small" value="xOverY"></td>
						</div>
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
                          <img class="img-responsive"  src="<?php echo $imagesPath.$row->image?>" onclick="checkAffected('preOcularMotilityData_<?php echo $row->ocularMotilityId?>','affectedPart_<?php echo $row->ocularMotilityId?>')"/>
                          <input type="hidden"  id="preOcularMotilityData_<?php echo $row->ocularMotilityId?>"
                           name="preOcularMotilityData[]" value="<?php echo $row->ocularMotilityId?>" />
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
        			<div class="section_6">
        			<div class="col-md-12">
									<div class="form-group">
											<label for="stereoacuity" class="col-md-3 control-label">Stereoacuity Wirt test</label>
											<div class="col-md-7">
												<div class="input-icon right">
													<input name="stereoWirtTest" type="text"
														class="form-control rounded-form place-holder-color"
														id="stereoWirtTest" value="">
												</div>
											</div>
										<label for="stereoacuity" class="col-md-1 control-label">arcsecond</label>
										</div>
					</div>	
					</div>	
					<div class="col-md-12">
					<h3>Pupillary reflexs</h3>
					<!-- TODO Get From Database -->
					</div>
					<div id="section_pupillary_reflexs">
					
					<?php foreach($pupillaryReflexs as $row){ ?>
					<div class="reflex_row" reflex="<?php echo $row->pupillaryReflexsId; ?>">
					<div class="col-md-12">
						<div class="col-md-3"><label><?php echo $row->title ?></label></div>
						<div class="form-group">
							<div class="mt-checkbox-list col-md-3" style='padding: 0px'>
								<label class="mt-checkbox">Normal, if not, Describe<input
									type="checkbox" id="reflex_<?php echo $row->pupillaryReflexsId ?>"
									value="<?php echo $row->pupillaryReflexsId ?>"
									name="reflex_<?php echo $row->pupillaryReflexsId ?>"/> <span></span>
								</label>
							</div>
						</div>
						<div class="col-md-3">
						<div class="input-icon right">
							<input name="pupillaryReflexDesc[id]" type="text"
								class="form-control rounded-form place-holder-color"
								id="reflex_description_<?php echo $row->pupillaryReflexsId ?>" placeholder="Description">
						</div>
						</div>
					</div>
					</div>
					<?php } ?>	
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
						<button class="btn btn-success pull-right btn-next">Next</button>
						<button class="btn btn-success  pull-right btn-submit" 
							style='margin-top: 20px;display:none' type="submit">Save</button>
					</div>
				</div>
				</div>
				</form>
				</div>
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