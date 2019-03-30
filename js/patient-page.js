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