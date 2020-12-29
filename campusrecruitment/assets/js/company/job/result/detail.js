// back button process
function fnBackBtn() {
	$("#detailForm").attr("action", "jobResultHistory");
	$('#detailForm').submit();
}

// edit result button process
function fnJobResultEdit(jobResultId,jobId,jobSeekerId) {
	$('#hiddenResultJobId').val(jobResultId);
	$('#hiddenJobId').val(jobId);
	$('#hiddenJobSeekerId').val(jobSeekerId);
	$("#detailForm").attr("action", "jobResultEdit");
	$('#detailForm').submit();
}