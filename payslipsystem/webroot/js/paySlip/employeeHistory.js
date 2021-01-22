// back button process
function fnBackBtn() {
	$("#screenName").val('employeeList');
	$("#employeeHistoryForm").attr("action", "../controller/employeeController.php?time="+dateTime);
	$("#employeeHistoryForm").submit();employeeHistoryForm
}

//employee list process
function fnEmployeeList() {
	$("#screenName").val('employeeList');
	$("#employeeHistoryForm").attr("action", "../controller/employeeController.php?time="+dateTime);
	$("#employeeHistoryForm").submit();
}

// pay slip open process
function fnOpenPaySlip() {
	alert("This page is in an underprocess");
}