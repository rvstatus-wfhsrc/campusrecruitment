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
			// $("#page").val(1);
			$("#hiddenSearch").val($("#search").val());
			$("#historyForm").attr("action", "jobHistory");
			$("#historyForm").submit();
		}
	});
});

// company detail process
function fnJobDetail(id) {
	$("#hiddenJobId").val(id);
	$("#historyForm").attr("action", "jobDetail");
	$("#historyForm").submit();
}
// filter process
function fnJobFilter(filterValue) {
	// $("#page").val(1);
	$( "#filterVal" ).val(filterValue);
	$("#search").val($("#hiddenSearch").val());
	$("#historyForm").attr("action", "jobHistory");
	$( "#historyForm" ).submit();
}
// search process
function fnJobSearch() {
	// $("#page").val(1);
	$("#hiddenSearch").val($("#search").val());
	$("#historyForm").attr("action", "jobHistory");
	$('#historyForm').submit();
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
	$("#historyForm").attr("action", "jobHistory");
	$( "#historyForm" ).submit();
}
// job details active or deactive process
function fnJobActiveOrDeactive(id , processType) {
	if (processType == 1) {
		var confActiveDeactiveMsg = "Do You Want to change it as Active ?";
	} else {
		var confActiveDeactiveMsg = "Do You Want to change it as Deactive ?";
	}
	if (confirm(confActiveDeactiveMsg)) {
		$("#historyForm").attr("action", "companyStatus");
		$("#hiddenCompanyId").val(id);
		$("#hiddenDelFlag").val(processType);
		$("#historyForm").submit();
	}
}

// clear search process
function fnClearSearch() {
	$("#filterVal").val(1);
	$("#sortVal").val(1);
	$("#sortProcess").val(1);
	$("#sortOptn").val("DESC");
	$("#search").val("");
	$("#hiddenSearch").val("");
	$("#historyForm").attr("action", "jobHistory");
	$('#historyForm').submit();
}