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
	$('#applyHistoryForm').keydown(function (e) {
		if (e.keyCode == 13) {
			// $("#page").val(1);
			$("#hiddenSearch").val($("#search").val());
		$("#applyHistoryForm").attr("action", "jobApplyHistory");
		$("#applyHistoryForm").submit();
		}
	});
});

// job applied detail process
function fnJobApplyDetail(id) {
	$("#hiddenApplyJobId").val(id);
	$("#applyHistoryForm").attr("action", "jobApplyDetail");
	$("#applyHistoryForm").submit();
}
// filter process
function fnJobFilter(filterValue) {
	// $("#page").val(1);
	$( "#filterVal" ).val(filterValue);
	$("#search").val($("#hiddenSearch").val());
	$("#applyHistoryForm").attr("action", "jobApplyHistory");
	$( "#applyHistoryForm" ).submit();
}
// search process
function fnJobSearch() {
	// $("#page").val(1);
	$("#hiddenSearch").val($("#search").val());
	$("#applyHistoryForm").attr("action", "jobApplyHistory");
	$('#applyHistoryForm').submit();
}
// sorting process
function fnSortProcess(){
	// $("#page").val(1);
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
	$("#applyHistoryForm").attr("action", "jobApplyHistory");
	$( "#applyHistoryForm" ).submit();
}
// job apply cancel process
function fnCancelApply(id) {
	var confCancelMsg = "Do You Want to Cancel a Job Application ?";
	if (confirm(confCancelMsg)) {
		$("#applyHistoryForm").attr("action", "jobApplyCancelStatus");
		$("#hiddenApplyJobId").val(id);
		$("#applyHistoryForm").submit();
	}
}

// clear search process
function fnClearSearch() {
	$("#filterVal").val(1);
	$("#sortVal").val(3);
	$("#sortProcess").val(3);
	$("#sortOptn").val("DESC");
	$("#search").val("");
	$("#hiddenSearch").val("");
	$("#applyHistoryForm").attr("action", "jobApplyHistory");
	$('#applyHistoryForm').submit();
}
function pagination(page) {
	$("#per_page").val(page);
	$("#applyHistoryForm").attr("action", "jobApplyHistory");
	$("#applyHistoryForm").submit();
}
