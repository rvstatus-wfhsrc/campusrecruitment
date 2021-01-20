// pay slip view process
function downloadPaySlip(salaryId) {
	$( "#hiddenSalaryId" ).val(salaryId);
	$( "#screenName" ).val('downloadPaySlip');
	$( "#viewForm" ).submit();
}

// back button process
function fnBackBtn() {
	$( "#screenName" ).val('employeeList');
	$("#viewForm").attr("action", "../controller/employeeController.php?time="+dateTime);
	$( "#viewForm" ).submit();
}

// send mail button process
function fnSendMail() {
	alert('This is an underprocess');
}