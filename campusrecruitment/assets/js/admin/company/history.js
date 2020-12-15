$(document).ready(function() {
	var cc = 0;
	$('#sortProcess').click(function () {
			cc++;
			if (cc == 2) {
				$(this).change();
				cc = 0;
			}         
	}).change (function () {
		 fnSortProcess();
			cc = -1;
	});
	$('#historyForm').keydown(function (e) {
	    if (e.keyCode == 13) {
	    	// $("#page").val(1);
	    	$("#hiddenSearch").val($("#search").val());
	        $("#historyForm").attr("action", "companyHistory");
			$("#historyForm").submit();
	    }
	});
});

// company detail process
function fnCompanyDetail(id){
	$( "#hiddenCompanyId" ).val(id);
	$( "#historyForm" ).submit();
}
// filter process
function fnCompanyFilter(filterValue) {
	// $("#page").val(1);
	$( "#filterVal" ).val(filterValue);
	$("#search").val($("#hiddenSearch").val());
	$("#historyForm").attr("action", "companyHistory");
	$( "#historyForm" ).submit();
}
// search process
function fnCompanySearch() {
	// $("#page").val(1);
	$("#hiddenSearch").val($("#search").val());
	$("#historyForm").attr("action", "companyHistory");
	$('#historyForm').submit();
}
// sorting process
function fnSortProcess(){
	// $("#page").val(1);
	$("#search").val($("#hiddenSearch").val());
	var alreadySortOptn = $("#sortOptn").val();
	var sortVal = $("#sortProcess").val();
	$("#sortVal").val(sortVal);
	var alreadySortVal = $("#sortVal").val();
	if(sortVal == alreadySortVal) {
		if(alreadySortOptn == "ASC" ) {
			$("#sortOptn").val("DESC");
		} else {
			$("#sortOptn").val("ASC");
		}
	}
	$("#historyForm").attr("action", "companyHistory");
	$( "#historyForm" ).submit();
}
// pagination process
// function pageClick(pageval) {
//     $('#page').val(pageval);
// 	$("#historyForm").attr("action", "history?mainmenu=employeeHistory&time="+dateTime);
// 	$('#historyForm').submit();
// }
// company active or deactive process
function fnCompanyActiveOrDeactive(id , processType) {
	if (processType == 1) {
		var confActiveDeactiveMsg = "Do You Want to change it as Active ?";
	} else {
		var confActiveDeactiveMsg = "Do You Want to change it as Deactive ?";
	}
	if (confirm(confActiveDeactiveMsg)) {
		$("#historyForm").attr("action", "companyStatus");
  		$( "#hiddenCompanyId" ).val(id);
  		$( "#hiddenDelFlag" ).val(processType);
		$( "#historyForm" ).submit();
	}
}

// clear search process
function fnClearSearch() {
	// $('#page').val(1);
	$( "#filterVal" ).val(1);
	// $("#sortVal").val(1);
	// $("#sortProcess").val(1);
	// $("#sortOptn").val("DESC");
	$("#search").val("");
	$("#hiddenSearch").val("");
	$("#historyForm").attr("action", "companyHistory");
	$('#historyForm').submit();
}
function pagination(page) {
	$("#per_page").val(page);
	$("#historyForm").attr("action", "companyHistory");
	$("#historyForm").submit();
}