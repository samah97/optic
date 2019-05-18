

$(document).ready(function(){
	$('#fs_19').click(function(){
		$('#headaches_more').toggleClass('hidden');
	});
});


function showTypeForm(){
	var select = $('#lenseType');
	var value = select.val();
	if(value == 1){
		$('#lenseForm').show("slow");
		$('#contactLenseForm').hide("fast");
	}else if(value == 2){
		$('#lenseForm').hide("fast");
		$('#contactLenseForm').show("slow");
	}
	
}

function validateForm(){
	if(document.getElementById("fullName").value == null || document.getElementById("fullName").value == "" 
		|| document.getElementById("phone").value == null || document.getElementById("phone").value == ""
		|| document.getElementById("dob").value == null || document.getElementById("dob").value == ""
		|| document.getElementById("dateAttendance").value == null || document.getElementById("dateAttendance").value == ""
		|| document.getElementById("dateReceived").value == null || document.getElementById("dateReceived").value == ""
		|| document.getElementById("SOC").value == null || document.getElementById("SOC").value == ""
		|| document.getElementById("SOD").value == null || document.getElementById("SOD").value == "" 
		|| document.getElementById("SOS").value == null || document.getElementById("SOS").value == ""
		|| document.getElementById("COD").value == null || document.getElementById("COD").value == ""
		||document.getElementById("COS").value == null || document.getElementById("COS").value == "" 
		|| document.getElementById("AOD").value == null || document.getElementById("AOS").value == ""
	    || document.getElementById("typeId").value == null || document.getElementById("typeId").value == ""
	    || document.getElementById("brandId").value == null || document.getElementById("brandId").value == ""){
		alert("Please Fill Required Fields");
		return false;
	}
	else{
		return true;
	}
}


function filter(){
	if(document.getElementById("clientId").value == "" && document.getElementById("firstName").value == "" && !document.getElementById("lens").checked && !document.getElementById("contactLens").checked && document.getElementById("phone").value == ""){
		alert('Fill at least one Input to filter');
		return false;
	}
	else{
		return true;
	}
}

$('.filterme').keypress(function(eve) {
  if ((eve.which != 46 || $(this).val().indexOf('.') != -1) && (eve.which < 48 || eve.which > 57) || (eve.which == 46 && $(this).caret().start == 0)) {
    eve.preventDefault();
  }

  // this part is when left part of number is deleted and leaves a . in the leftmost position. For example, 33.25, then 33 is deleted
  $('.filterme').keyup(function(eve) {
    if ($(this).val().indexOf('.') == 0) {
      $(this).val($(this).val().substring(1));
    }
  });
});

//image gallery
//init the state from the input
$(".image-checkbox").each(function () {
if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
 $(this).addClass('image-checkbox-checked');
}
else {
 $(this).removeClass('image-checkbox-checked');
}
});

//sync the state to the input
$(".image-checkbox").on("click", function (e) {
$(this).toggleClass('image-checkbox-checked');
var $checkbox = $(this).find('input[type="checkbox"]');
$checkbox.prop("checked",!$checkbox.prop("checked"))

e.preventDefault();
});


function checkAffected(clickedPart,labelAffected){
	var clicked= clickedPart;
	if($('#'+clicked).prop( "checked" )){
		$('#'+clickedPart).attr('checked',false); 	
		$('#'+labelAffected).removeClass( "affectedPart" );
	}
	else{
	$('#'+clickedPart).attr('checked',true); 
	$('#'+labelAffected).addClass( "affectedPart" );
	}
}