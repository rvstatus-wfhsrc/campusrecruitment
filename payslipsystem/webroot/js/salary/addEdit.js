//employee list process
function fnEmployeeList() {
	$("#screenName").val('employeeList');
	$("#addForm").attr("action", "../controller/employeeController.php?time="+dateTime);
	$("#addForm").submit();
}

// salary list process
function fnSalaryList() {
	$( "#pageno" ).val(1);
	$( "#screenName" ).val('salaryList');
	$( "#addForm" ).submit();
}

// logout process
function fnLogout() {
	$( "#screenName" ).val('logout');
	$("#addForm").attr("action", "../controller/loginController.php?time="+dateTime);
	$( "#addForm" ).submit();
}
