// edit button process
function fnJobEdit() {
	$('#hiddenJobId').val($('#hiddenJobId').val());
	$('#jobDetailForm').submit();
}

// back button process
function fnBackBtn() {
	if ($("#hiddenFlag").val() == "") {
		$("#jobDetailForm").attr("action", "homeSearch");
	} else if ($("#hiddenFlag").val() == 2) {
		$("#jobDetailForm").attr("action", "../JobController/jobList");
	} else {
		$("#jobDetailForm").attr("action", "../JobController/jobLists");
	}
	$('#jobDetailForm').submit();
}

// for apply process
function fnJobApply(id,companyId) {
	if (confirm("Are You Want To Apply a Job ?")) {
		$("#hiddenJobId").val(id);
		$("#hiddenCompanyId").val(companyId);
		$("#jobDetailForm").attr("action", "jobApply");
		$("#jobDetailForm").submit();
	}
}