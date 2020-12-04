// company edit process
function fnCompanyEdit(id) {
	$( "#hiddenCompanyId" ).val(id);
	$( "#detailForm" ).submit();
}

function fnBackBtn() {
	$("#detailForm").attr("action", "companyHistory");
	$('#detailForm').submit();
}