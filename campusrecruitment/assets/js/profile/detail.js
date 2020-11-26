function fnProfileEdit() {
	$('#profileDetailForm').submit();
}
function fnRemoveImage() {
	var confRemoveImgMsg = "Are You Confirm To Remove The Image ?";
    if(confirm(confRemoveImgMsg)) {
		$("#profileDetailForm").attr("action", "../removeImage");
		$('#profileDetailForm').submit();
	}
}