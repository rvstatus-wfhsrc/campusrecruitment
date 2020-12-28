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
	$('#historyForm').keydown(function (e) {
		if (e.keyCode == 13) {
			$("#hiddenSearch").val($("#search").val());
		$("#historyForm").attr("action", "jobResultHistory");
		$("#historyForm").submit();
		}
	});
});

// job result detail process
function fnJobResultDetail(id) {
	alert("Job Result Detail Screen is an underprocess");
	// $("#hiddenApplyJobId").val(id);
	// $("#applyHistoryForm").attr("action", "jobApplyDetail");
	// $("#applyHistoryForm").submit();
}
// filter process
function fnJobFilter(filterValue) {
	$( "#filterVal" ).val(filterValue);
	$("#search").val($("#hiddenSearch").val());
	$("#historyForm").attr("action", "jobResultHistory");
	$( "#historyForm" ).submit();
}
// search process
function fnJobSearch() {
	$("#hiddenSearch").val($("#search").val());
	$("#historyForm").attr("action", "jobResultHistory");
	$('#historyForm').submit();
}
// sorting process
function fnSortProcess(){
	$("#search").val($("#hiddenSearch").val());
	var alreadySortOptn = $("#sortOptn").val();
	var sortVal = $("#sortProcess").val();
	$("#sortVal").val(sortVal);
	var alreadySortVal = $("#sortVal").val();
	if(sortVal == alreadySortVal) {
		if(alreadySortOptn == "DESC" ) {
			$("#sortOptn").val("ASC");
		} else {
			$("#sortOptn").val("DESC");
		}
	}
	$("#historyForm").attr("action", "jobResultHistory");
	$( "#historyForm" ).submit();
}

// clear search process
function fnClearSearch() {
	$("#filterVal").val(1);
	$("#sortVal").val(1);
	$("#sortProcess").val(1);
	$("#sortOptn").val("DESC");
	$("#search").val("");
	$("#hiddenSearch").val("");
	$("#historyForm").attr("action", "jobResultHistory");
	$('#historyForm').submit();
}
function pagination(page) {
	$("#per_page").val(page);
	$("#historyForm").attr("action", "jobResultHistory");
	$("#historyForm").submit();
}