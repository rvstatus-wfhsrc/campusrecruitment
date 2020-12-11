$(document).ready(function() {
	$('#indexForm').keydown(function (e) {
		if (e.keyCode == 13) {
			$("#indexForm").attr("action", "homeSearch");
			$("#indexForm").submit();
		}
	});
	$('#jobCategory').on('change', function() {
		$("#jobKeyWords").val($("#hiddenJobKeyWords").val());
		$("#area").val($("#hiddenArea").val());
		$("#indexForm").attr("action", "homeSearch");
		$("#indexForm").submit();
	});
	$('#search').click(function() {
		$("#indexForm").attr("action", "homeSearch");
		$("#indexForm").submit();
	});
});

function pagination(page) {
	$("#jobKeyWords").val($("#hiddenJobKeyWords").val());
	$("#area").val($("#hiddenArea").val());
	$("#per_page").val(page);
	$("#indexForm").attr("action", "homeSearch");
	$("#indexForm").submit();
}