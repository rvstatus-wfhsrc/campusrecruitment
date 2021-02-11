var data = {};
// salary and edit button process
function fnSalaryAddEdit(employeeId,employeeName,month,year) {
	resetErrors();
	var url = 'salaryController.php';
	if ($("#screenFlag").val() == '1') {
		var formName = '#addForm';
	} else {
		var formName = '#editForm';
	}
	$.each($('form input, form hidden, form textarea'), function(i, v) {
		if (v.type !== 'submit') {
			data[v.name] = v.value;
		}
	});
	$.ajax({
		dataType: 'json',
		type: 'POST',
		url: url,
		data: $(formName).serialize(),
		success: function(resp) {
			if (resp === true) {
				//screenFlag => 1 ----> register
				if($("#screenFlag").val() == '1') {
					var confRegMsg = "Are You Confirm To Add The Salary ?";
	                if(confirm(confRegMsg)) {
						$( "#screenName" ).val('salaryAddForm');
						$( "#hiddenEmployeeId" ).val(employeeId);
						$( "#hiddenEmployeeName" ).val(employeeName);
						$( "#month" ).val(month);
						$( "#year" ).val(year);
						$( "#addForm" ).submit();
						return false;
					}
				} else {
					var confUpdateMsg = "Are You Confirm To Update The Salary ?";
                    if(confirm(confUpdateMsg)) {
                    	$( "#screenName" ).val('salaryEditForm');
						$( "#hiddenEmployeeId" ).val(employeeId);
						$( "#hiddenEmployeeName" ).val(employeeName);
						$( "#month" ).val(month);
						$( "#year" ).val(year);
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

$(document).ready(function() {
    // Total Salary process
    $("#esi").on('input',function() {
    	var basicSalary = parseInt($("#basicSalary").val());
	    var insentive = parseInt($("#insentive").val());
	    var pf = parseInt($("#pf").val());
	    var esi = parseInt($("#esi").val());
	    var totalSalary = 0;
        if (/^\d+$/.test($("#esi").val())) {
            totalSalary = basicSalary + insentive + pf + esi;
        }
        $("#totalSalary").val(totalSalary);
    });
});