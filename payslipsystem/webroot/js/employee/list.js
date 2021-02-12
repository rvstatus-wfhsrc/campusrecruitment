$(document).ready(function() {
	var cc = 0;
	$('#sortProcess').click(function () {
			cc++;
			if (cc == 2) {
				$(this).change();
				cc = 0;
			}
	}).change (function () {
		 fnSortProcess();
			cc = -1;
	});
	$('#listForm').keydown(function (e) {
	    if (e.keyCode == 13) {
	    	$( "#screenName" ).val('employeeList');
			$("#hiddenSearch").val($("#search").val());
			$( "#listForm" ).submit();
	    }
	});
	$('#month').change(function () {
		$( "#screenName" ).val('employeeList');
		$( "#listForm" ).submit();
	});
	$('#year').change(function () {
		$( "#screenName" ).val('employeeList');
		$( "#listForm" ).submit();
	});
});

function fnSearch() {
	$( "#screenName" ).val('employeeList');
	$("#hiddenSearch").val($("#search").val());
	$( "#listForm" ).submit();
}

// sorting process
function fnSortProcess() {
	$( "#screenName" ).val('employeeList');
	$("#search").val($("#hiddenSearch").val());
	var alreadySortOptn = $("#sortOptn").val();
	var sortVal = $("#sortProcess").val();
	$("#sortVal").val(sortVal);
	var alreadySortVal = $("#sortVal").val();
	if(sortVal == alreadySortVal) {
		if(alreadySortOptn == "ASC" ) {
			$("#sortOptn").val("DESC");
		} else {
			$("#sortOptn").val("ASC");
		}
	}
	$( "#listForm" ).submit();
}

// clear search process
function fnClearSearch() {
	$( "#pageno" ).val(1);
	$("#search").val("");
	$("#hiddenSearch").val("");
	$("#sortVal").val("");
	$("#sortOptn").val("");
	$( "#screenName" ).val('employeeList');
	$('#listForm').submit();
}

// pagination process
function fnPagination(pageno) {
	$( "#pageno" ).val(pageno);
	$( "#screenName" ).val('employeeList');
	$( "#listForm" ).submit();
}

// pay slip view process
function fnPaySlipView(salaryId,month,year) {
	$( "#hiddenSalaryId" ).val(salaryId);
	$( "#screenName" ).val('paySlipView');
	$( "#hiddenMonth" ).val(month);
	$( "#hiddenYear" ).val(year);
	$("#listForm").attr("action", "../controller/paySlipController.php?time="+dateTime);
	$( "#listForm" ).submit();
}

// employee list process
function fnEmployeeList() {
	$( "#pageno" ).val(1);
	$("#search").val("");
	$("#hiddenSearch").val("");
	$( "#screenName" ).val('employeeList');
	$( "#listForm" ).submit();
}

// pay slip employee history process
function fnPaySlipEmployeeHistory(employeeId,employeeName,month,year) {
	$( "#pageno" ).val(1);
	$( "#screenName" ).val('paySlipEmployeeHistory');
	$( "#hiddenEmployeeId" ).val(employeeId);
	$( "#hiddenEmployeeName" ).val(employeeName);
	$( "#hiddenMonth" ).val(month);
	$( "#hiddenYear" ).val(year);
	$("#listForm").attr("action", "../controller/paySlipController.php?time="+dateTime);
	$( "#listForm" ).submit();
}

// logout process
function fnLogout() {
	$( "#screenName" ).val('logout');
	$("#listForm").attr("action", "../controller/loginController.php?time="+dateTime);
	$( "#listForm" ).submit();
}

// salary list process
function fnSalaryList() {
	$( "#pageno" ).val(1);
	$("#search").val("");
	$("#hiddenSearch").val("");
	$( "#screenName" ).val('salaryList');
	$("#listForm").attr("action", "../controller/salaryController.php?time="+dateTime);
	$( "#listForm" ).submit();
}