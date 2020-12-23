// edit button process
function fnJobEdit() {
	$('#hiddenJobId').val($('#hiddenJobId').val());
	$('#jobDetailForm').submit();
}

// back button process
function fnBackBtn() {
	if ($("#hiddenFlag").val() == 2) {
		$("#jobDetailForm").attr("action", "jobList");
	} else {
		$("#jobDetailForm").attr("action", "jobLists");
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