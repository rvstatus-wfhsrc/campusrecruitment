var data = {};
// send mail button process
function fnSendMail(salaryId,month,year,fileName) {
	resetErrors();
	var url = 'paySlipController.php';
	$.each($('form input, form hidden, form textarea'), function(i, v) {
		if (v.type !== 'submit') {
			data[v.name] = v.value;
		}
		$( "#screenName" ).val('viewFormValidation');
	});
	$.ajax({
		dataType: 'json',
		type: 'POST',
		url: url,
		data: $('#viewForm').serialize(),
		success: function(resp) {
			if (resp === true) {
				var confRegMsg = mail_send_confirmation;
                if(confirm(confRegMsg)) {
					$( "#hiddenSalaryId" ).val(salaryId);
					$( "#screenName" ).val('sendPaySlip');
					$( "#month" ).val(month);
					$( "#year" ).val(year);
					$( "#hiddenFileName" ).val(fileName);
					$("#viewForm").attr("action", "../controller/paySlipController.php?time="+dateTime);
					$( "#viewForm" ).submit();
					return false;
				}
			} else {
				$.each(resp, function(i, v) {
					console.log(i + " => " + v);
					var msg = '<label class="error" style="color:#9C0000; font-size:13px; padding-left: 5px; display:inline-block;" for="'+i+'">'+v+'</label>';
					$('input[name="' + i + '"], textarea[name="' + i + '"]').addClass('inputTxtError').after(msg);
				});
			}
			return false;
		},
		error: function() {
			console.log('there was a problem checking the fields');
		}
	});
	return false;
}

function resetErrors() {
	$('form input').removeClass('inputTxtError');
	$('label.error').remove();
}

// pay slip view process
function downloadPaySlipOnView(fileName) {
	$( "#hiddenFileName" ).val(fileName);
	$( "#screenName" ).val('downloadPaySlipOnView');
	$("#viewForm").attr("action", "../controller/paySlipController.php?time="+dateTime);
	$( "#viewForm" ).submit();
}

// back button process
function fnBackBtn(month,year) {
	$( "#screenName" ).val('employeeList');
	$( "#month" ).val(month);
	$( "#year" ).val(year);
	$("#viewForm").attr("action", "../controller/employeeController.php?time="+dateTime);
	$( "#viewForm" ).submit();
}

//employee list process
function fnEmployeeList() {
	$( "#screenName" ).val('employeeList');
	$("#viewForm").attr("action", "../controller/employeeController.php?time="+dateTime);
	$( "#viewForm" ).submit();
}

// logout process
function fnLogout() {
	$( "#screenName" ).val('logout');
	$("#viewForm").attr("action", "../controller/loginController.php?time="+dateTime);
	$( "#viewForm" ).submit();
}

// salary list process
function fnSalaryList() {
	$( "#screenName" ).val('salaryList');
	$("#viewForm").attr("action", "../controller/salaryController.php?time="+dateTime);
	$( "#viewForm" ).submit();
}