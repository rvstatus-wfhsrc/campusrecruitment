// edit button process
function fnJobEdit() {
	$('#hiddenJobId').val($('#hiddenJobId').val());
	$('#jobDetailForm').submit();
}

// back button process
function fnBackBtn() {
	$("#jobDetailForm").attr("action", "jobList");
	$('#jobDetailForm').submit();
}