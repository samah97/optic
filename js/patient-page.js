var currentData;
var patientForm = $('#newClient');

function initDefaults() {
	currentData = $('textarea#currentData').val();
	$('textarea#currentData').remove();
}

function initEventsHandlers() {
	$('#newClient').submit(function(e) {
		e.preventDefault();
		submitForm($(this));
	});
}

// --------------------FOR REQUESTS-------------------------------------//
function getInputValue(formId, element) {
	if (element.is('input')) {
		if (element.is(':radio')) {
			var name = element.attr('name');
			var value = $('#' + formId + ' input[name="' + name + '"]:checked')
					.val();
			return value;
		}
	}

	return element.val();
}

function getPersonalInfoData() {
	var currentData = new Object();
	var tabId = 'tab_1_1';

	$('#' + tabId + ' *').filter(':input').each(function() {
		var inputId = $(this).attr('name');
		currentData[inputId] = getInputValue(tabId, $(this));
	});
	return currentData;
}

function getConsultationData() {
	var currentData = new Object();
	var tabId = 'tab_1_2';

	$('#' + tabId + ' div#section_3_2 *').filter(':input').each(function() {
		var inputId = $(this).attr('name');
		currentData[inputId] = getInputValue(tabId, $(this));
	});

	var visualProblems = [];
	$('#' + tabId + ' div#section_vp input:checked').each(function() {
		visualProblems.push($(this).val());
	});
	currentData["visualProblems"] = visualProblems;
	
	var functionalSigns = [];
	$('#' + tabId + ' div#section_fs input:checked').each(function() {
		functionalSigns.push($(this).val());
	});
	currentData["functionalSigns"] = functionalSigns;
	
	var control = [];
	$('#' + tabId + ' div#section_control input:checked').each(function() {
		control.push($(this).val());
	});
	currentData["functionalSigns"] = functionalSigns;
	
	
	
	return currentData;
}

function getRefractionHistoryData() {
	var refractionHistoryData = new Object();
	var tabId = 'tab_1_3';

	$('#' + tabId + ' .section_3_main *').filter(':input').each(function() {
		var inputId = $(this).attr('name');
		refractionHistoryData[inputId] = getInputValue(tabId, $(this));
	});
	
	if($('#tc_1').is(':checked')){
		var eyeglassObj = new Object();
		$('#' + tabId + ' table#refEyeglasses *').filter(':input').each(function() {
			var inputId = $(this).attr('name');
			inputId.replace('eye','');
			eyeglassObj[inputId] = getInputValue(tabId, $(this));
		});
		refractionHistoryData["refEyeglasses"] = eyeglassObj;
	}
	
	if($('#tc_2').is(':checked')){
		var contactObj = new Object();
		$('#' + tabId + ' table#refContact *').filter(':input').each(function() {
			var inputId = $(this).attr('name');
			contactObj[inputId] = getInputValue(tabId, $(this));
		});
		refractionHistoryData["refContact"] = contactObj;
	}
	return refractionHistoryData;
}

function getVisualNeedsData() {
	var visualNeedsData = new Object();
	var tabId = 'tab_1_4';

	$('#' + tabId + ' *').filter(':input').each(function() {
		var inputId = $(this).attr('name');
		visualNeedsData[inputId] = getInputValue(tabId, $(this));
	});
	
	return visualNeedsData;
}

function getVisualAntecedentsData() {
	var visualAntecedentsData = new Object();
	var tabId = 'tab_1_5';

	$('#' + tabId + ' *').filter(':input').each(function() {
		var inputId = $(this).attr('name');
		visualAntecedentsData[inputId] = getInputValue(tabId, $(this));
	});

	
	return visualAntecedentsData;
}

function getPreliminaryExamintaionData() {
	var preliminaryExamintaionData = new Object();
	var tabId = 'tab_1_6';

	$('#' + tabId + ' .section_6 *').filter(':input').each(function() {
		var inputId = $(this).attr('name');
		preliminaryExamintaionData[inputId] = getInputValue(tabId, $(this));
	});
	
	var keratomeryObj = new Object();
	$('#' + tabId + ' #keratometry_table *').filter(':input').each(function() {
		var inputId = $(this).attr('name');
		inputId =  inputId.replace("keratometry_","");
		keratomeryObj[inputId] = getInputValue(tabId, $(this));
	});
	
	var pupillaryReflexArr = [] 
	$('#' + tabId + ' .reflex_row').each(function() {
		var reflex = $(this).attr('reflex');
		var reflexObj = new Object();	
		reflexObj.pupillaryReflexId = $(this).find('reflex_'+reflex).val();	
		reflexObj.text = $(this).find('reflex_description_'+reflex).val();	
		pupillaryReflexArr.push(reflexObj)
	});
	
	preliminaryExamintaionData.keratomeryData = keratomeryObj;
	preliminaryExamintaionData.pupillaryReflexsData =pupillaryReflexArr; 
	
	return preliminaryExamintaionData;
}


function getAllRequest() {

	var formDataObj = new Object();

	formDataObj.personalInfoData = getPersonalInfoData();
	formDataObj.consultationData = getConsultationData();
	
	return formDataObj;
}

// --------------------END FOR REQUESTS-------------------------------------//
// --------------------EVENTS FUNCTIONS-------------------------------------//

// --------------------END EVENTS FUNCTIONS---------------------------------//
// -------------------------OTHER
// FUNCTIONS-------------------------------------------//

// -------------------------END OTHER
// FUNCTIONS---------------------------------------//

$(document).ready(function(e) {
	initEventsHandlers();

	if (isEdit) {
		fillData(patientForm.attr('id'), currentData);
	}

});

function fillData(form, data) {
	var data = jQuery.parseJSON(data);

	$.each(data, function(index, element) {

		var input = $('#' + form + ' #' + index);
		if (input.is('select')) {
			input.val(element);
		} else {
			input.val(element);
		}
	});
}

function submitForm(form) {

	getAllRequest();

}