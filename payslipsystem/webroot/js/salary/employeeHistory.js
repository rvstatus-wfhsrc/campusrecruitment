// back button process
function fnBackBtn(month,year) {
	$( "#pageno" ).val(1);
	$("#screenName").val('salaryList');
	$("#month").val(month);
	$("#year").val(year);
	$("#employeeHistoryForm").submit();
}

//employee list process
function fnEmployeeList() {
	$("#screenName").val('employeeList');
	$("#employeeHistoryForm").attr("action", "../controller/employeeController.php?time="+dateTime);
	$("#employeeHistoryForm").submit();
}

// pagination process
function fnPagination(pageno) {
	$( "#pageno" ).val(pageno);
	$( "#screenName" ).val('salaryEmployeeHistory');
	$( "#employeeHistoryForm" ).submit();
}

// logout process
function fnLogout() {
	$( "#screenName" ).val('logout');
	$("#employeeHistoryForm").attr("action", "../controller/loginController.php?time="+dateTime);
	$( "#employeeHistoryForm" ).submit();
}

// salary list process
function fnSalaryList() {
	$( "#pageno" ).val(1);
	$( "#screenName" ).val('salaryList');
	$( "#listForm" ).submit();
}