// back button process
function fnBackBtn(month,year) {
	$( "#pageno" ).val(1);
	$("#screenName").val('employeeList');
	$("#month").val(month);
	$("#year").val(year);
	$("#employeeHistoryForm").attr("action", "../controller/employeeController.php?time="+dateTime);
	$("#employeeHistoryForm").submit();
}

//employee list process
function fnEmployeeList() {
	$("#screenName").val('employeeList');
	$("#employeeHistoryForm").attr("action", "../controller/employeeController.php?time="+dateTime);
	$("#employeeHistoryForm").submit();
}

// pay slip download process
function fnDownloadPaySlip(fileName) {
	$( "#screenName" ).val('downloadPaySlipOnView');
	$( "#hiddenFileName" ).val(fileName);
	$("#employeeHistoryForm").attr("action", "../controller/paySlipController.php?time="+dateTime);
	$( "#employeeHistoryForm" ).submit();
}

// pagination process
function fnPagination(pageno) {
	$( "#pageno" ).val(pageno);
	$( "#screenName" ).val('paySlipEmployeeHistory');
	$("#employeeHistoryForm").attr("action", "../controller/paySlipController.php?time="+dateTime);
	$( "#employeeHistoryForm" ).submit();
}

// logout process
function fnLogout() {
	$( "#screenName" ).val('logout');
	$("#employeeHistoryForm").attr("action", "../controller/loginController.php?time="+dateTime);
	$( "#employeeHistoryForm" ).submit();
}