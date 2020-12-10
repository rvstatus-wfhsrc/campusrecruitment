// edit button process
function fnJobEdit() {
	alert("Job Edit Screen is under process");
	// $('#hiddenJobId').val($('#hiddenJobId').val());
	// $('#jobDetailForm').submit();
}

// back button process
function fnBackBtn() {
	$("#jobDetailForm").attr("action", "jobList");
	$('#jobDetailForm').submit();
}