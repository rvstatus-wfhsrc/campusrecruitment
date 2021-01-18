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
	$("#sortVal").val(1);
	$("#sortProcess").val(1);
	$("#sortOptn").val("DESC");
	$("#search").val("");
	$("#hiddenSearch").val("");
	$( "#screenName" ).val('employeeList');
	$('#listForm').submit();
}

// pagination process
function fnPagination(pageno) {
	$( "#pageno" ).val(pageno);
	$( "#screenName" ).val('employeeList');
	$( "#listForm" ).submit();
}