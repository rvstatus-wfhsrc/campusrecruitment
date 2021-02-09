var data = {};
// add and edit button process
function fnSalaryAddEdit() {
	resetErrors();
	var url = 'salaryController.php';
	$.each($('form input, form hidden'), function(i, v) {
		if (v.type !== 'submit') {
			data[v.name] = v.value;
		}
	});
	$.ajax({
		dataType: 'json',
		type: 'POST',
		url: url,
		data: $('#addForm').serialize(),
		success: function(resp) {
			if (resp === true) {
				//screenFlag => 1 ----> register
                if($("#screenFlag").val() == '1') {
                    var confRegMsg = "Are You Confirm To Add The Salary ?";
                    if(confirm(confRegMsg)) {
						// $( "#screenName" ).val('sendPaySlip');
						// $( "#month" ).val(month);
						// $( "#year" ).val(year);
						$( "#addForm" ).submit();
						return false;
					}
                } else {
                    var confUpdateMsg = "Are You Confirm To Update The Salary ?";
                    if(confirm(confUpdateMsg)) {
      					// $( "#hiddenSalaryId" ).val(salaryId);
						// $( "#screenName" ).val('sendPaySlip');
						// $( "#month" ).val(month);
						// $( "#year" ).val(year);
						$( "#editForm" ).submit();
						return false;
                    }
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

//employee list process
function fnEmployeeList() {
	$("#screenName").val('employeeList');
	$("#addForm").attr("action", "../controller/employeeController.php?time="+dateTime);
	$("#addForm").submit();
}

// salary list process
function fnSalaryList() {
	$( "#pageno" ).val(1);
	$( "#screenName" ).val('salaryList');
	$( "#addForm" ).submit();
}

// logout process
function fnLogout() {
	$( "#screenName" ).val('logout');
	$("#addForm").attr("action", "../controller/loginController.php?time="+dateTime);
	$( "#addForm" ).submit();
}
