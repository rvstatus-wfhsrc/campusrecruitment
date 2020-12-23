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