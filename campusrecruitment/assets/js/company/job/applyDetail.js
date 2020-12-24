// cancel button process
function fnCancelApply(id) {
	var confCancelMsg = "Do You Want to Cancel a Job Application ?";
	if (confirm(confCancelMsg)) {
		$('#hiddenApplyJobId').val(id);
		$('#applyDetailForm').submit();
	}
}

// back button process
function fnBackBtn() {
	$("#jobDetailForm").attr("action", "jobApplyHistory");
	$('#applyDetailForm').submit();
}

// add result button process
function fnJobResultAdd(id) {
	$('#hiddenApplyJobId').val(id);
	$("#applyDetailForm").attr("action", "getJobAppliedDetail");
	$('#applyDetailForm').submit();
}