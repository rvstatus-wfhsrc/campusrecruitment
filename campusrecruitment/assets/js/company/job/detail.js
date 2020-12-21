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

// apply button process
function fnJobApply() {
	alert('Apply is an underprocess');
}