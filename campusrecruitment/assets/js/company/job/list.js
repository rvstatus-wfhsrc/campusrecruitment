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
			// $("#page").val(1);
			$("#hiddenSearch").val($("#search").val());
			if ($("#hiddenFlag").val() == 2) {
		$("#listForm").attr("action", "jobList");
	} else {
		$("#listForm").attr("action", "jobLists");
	}
			$("#listForm").submit();
		}
	});
});

// company detail process
function fnJobDetail(id) {
	$("#hiddenJobId").val(id);
	$("#listForm").attr("action", "jobDetail");
	$("#listForm").submit();
}
// filter process
function fnJobFilter(filterValue) {
	// $("#page").val(1);
	$( "#filterVal" ).val(filterValue);
	$("#search").val($("#hiddenSearch").val());
	if ($("#hiddenFlag").val() == 2) {
		$("#listForm").attr("action", "jobList");
	} else {
		$("#listForm").attr("action", "jobLists");
	}
	$( "#listForm" ).submit();
}
// search process
function fnJobSearch() {
	// $("#page").val(1);
	$("#hiddenSearch").val($("#search").val());
	if ($("#hiddenFlag").val() == 2) {
		$("#listForm").attr("action", "jobList");
	} else {
		$("#listForm").attr("action", "jobLists");
	}
	$('#listForm').submit();
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
	if ($("#hiddenFlag").val() == 2) {
		$("#listForm").attr("action", "jobList");
	} else {
		$("#listForm").attr("action", "jobLists");
	}
	$( "#listForm" ).submit();
}
// job details active or deactive process
function fnJobActiveOrDeactive(id , processType) {
	if (processType == 1) {
		var confActiveDeactiveMsg = "Do You Want to change it as Active ?";
	} else {
		var confActiveDeactiveMsg = "Do You Want to change it as Deactive ?";
	}
	if (confirm(confActiveDeactiveMsg)) {
		$("#listForm").attr("action", "jobStatus");
		$("#hiddenJobId").val(id);
		$("#hiddenDelFlag").val(processType);
		$("#listForm").submit();
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
	if ($("#hiddenFlag").val() == 2) {
		$("#listForm").attr("action", "jobList");
	} else {
		$("#listForm").attr("action", "jobLists");
	}
	$('#listForm').submit();
}
function pagination(page) {
	$("#per_page").val(page);
	if ($("#hiddenFlag").val() == 2) {
		$("#listForm").attr("action", "jobList");
	} else {
		$("#listForm").attr("action", "jobLists");
	}
	$("#listForm").submit();
}

// for apply process
function fnJobApply(id,companyId) {
	if (confirm("Are You Want To Apply a Job ?")) {
		$("#hiddenJobId").val(id);
		$("#hiddenCompanyId").val(companyId);
		$("#listForm").attr("action", "jobApply");
		$("#listForm").submit();
	}
}