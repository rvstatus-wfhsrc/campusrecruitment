function fnJobSeekerEdit() {
	alert("This screen is underProcess");
	// $('#detailForm').submit();
}
function fnRemoveImage() {
	var confRemoveImgMsg = "Are You Confirm To Remove The Image ?";
    if(confirm(confRemoveImgMsg)) {
		$("#detailForm").attr("action", "removeImage");
		$('#detailForm').submit();
	}
}