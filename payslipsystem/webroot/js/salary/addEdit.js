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

function fnSalaryCancel(employeeId,employeeName,month,year) {
	var confCancelMsg = "Are You Confirm To Cancel The Salary ?";
	if(confirm(confCancelMsg)) {
		$( "#screenName" ).val('salaryEmployeeHistory');
		$( "#hiddenEmployeeId" ).val(employeeId);
		$( "#hiddenEmployeeName" ).val(employeeName);
		$( "#month" ).val(month);
		$( "#year" ).val(year);
		if ($("#screenFlag").val() == '1') {
			var formName = '#addForm';
		} else {
			var formName = '#editForm';
		}
		$( formName ).submit();
	}
}

$(document).ready(function() {
    // Total Salary process
    $("#basicSalary").on('input',function() {
    	var basicSalary = 0;
    	var insentive = 0;
    	var pf = 0;
    	var esi = 0;
    	if ($("#basicSalary").val() != '') {
	    	var basicSalary = parseInt($("#basicSalary").val());
	    }
	    if ($("#insentive").val() != '') {
	    	var insentive = parseInt($("#insentive").val());
	    }
	    if ($("#pf").val() != '') {
	    	var pf = parseInt($("#pf").val());
	    }
	    if ($("#esi").val() != '') {
	    	var esi = parseInt($("#esi").val());
	    }
        totalSalary = basicSalary + insentive + pf + esi;
        if(isNaN(totalSalary) || totalSalary == 0) {
        	$("#totalSalary").val("");
        } else {
        	$("#totalSalary").val(totalSalary);
        }
    });
    $("#insentive").on('input',function() {
    	var basicSalary = 0;
    	var insentive = 0;
    	var pf = 0;
    	var esi = 0;
    	if ($("#basicSalary").val() != '') {
	    	var basicSalary = parseInt($("#basicSalary").val());
	    }
	    if ($("#insentive").val() != '') {
	    	var insentive = parseInt($("#insentive").val());
	    }
	    if ($("#pf").val() != '') {
	    	var pf = parseInt($("#pf").val());
	    }
	    if ($("#esi").val() != '') {
	    	var esi = parseInt($("#esi").val());
	    }
        totalSalary = basicSalary + insentive + pf + esi;
        if(isNaN(totalSalary) || totalSalary == 0) {
        	$("#totalSalary").val("");
        } else {
        	$("#totalSalary").val(totalSalary);
        }
    });
    $("#pf").on('input',function() {
    	var basicSalary = 0;
    	var insentive = 0;
    	var pf = 0;
    	var esi = 0;
    	if ($("#basicSalary").val() != '') {
	    	var basicSalary = parseInt($("#basicSalary").val());
	    }
	    if ($("#insentive").val() != '') {
	    	var insentive = parseInt($("#insentive").val());
	    }
	    if ($("#pf").val() != '') {
	    	var pf = parseInt($("#pf").val());
	    }
	    if ($("#esi").val() != '') {
	    	var esi = parseInt($("#esi").val());
	    }
        totalSalary = basicSalary + insentive + pf + esi;
        if(isNaN(totalSalary) || totalSalary == 0) {
        	$("#totalSalary").val("");
        } else {
        	$("#totalSalary").val(totalSalary);
        }
    });
    $("#esi").on('input',function() {
    	var basicSalary = 0;
    	var insentive = 0;
    	var pf = 0;
    	var esi = 0;
    	if ($("#basicSalary").val() != '') {
	    	var basicSalary = parseInt($("#basicSalary").val());
	    }
	    if ($("#insentive").val() != '') {
	    	var insentive = parseInt($("#insentive").val());
	    }
	    if ($("#pf").val() != '') {
	    	var pf = parseInt($("#pf").val());
	    }
	    if ($("#esi").val() != '') {
	    	var esi = parseInt($("#esi").val());
	    }
        totalSalary = basicSalary + insentive + pf + esi;
        if(isNaN(totalSalary) || totalSalary == 0) {
        	$("#totalSalary").val("");
        } else {
        	$("#totalSalary").val(totalSalary);
        }
    });
    $('#basicSalary').on('input propertychange paste', function (e) {
        var reg = /^0+/gi;
        if (this.value.match(reg)) {
            this.value = this.value.replace(reg, '');
        }
    });
    $('#insentive').on('input propertychange paste', function (e) {
        var reg = /^0+/gi;
        if (this.value.match(reg)) {
            this.value = this.value.replace(reg, '');
        }
    });
    $('#pf').on('input propertychange paste', function (e) {
        var reg = /^0+/gi;
        if (this.value.match(reg)) {
            this.value = this.value.replace(reg, '');
        }
    });
    $('#esi').on('input propertychange paste', function (e) {
        var reg = /^0+/gi;
        if (this.value.match(reg)) {
            this.value = this.value.replace(reg, '');
        }
    });
});

//employee list process
function fnEmployeeList() {
	$("#screenName").val('employeeList');
	if ($("#screenFlag").val() == '1') {
		var formName = '#addForm';
	} else {
		var formName = '#editForm';
	}
	$(formName).attr("action", "../controller/employeeController.php?time="+dateTime);
	$(formName).submit();
}

// salary list process
function fnSalaryList() {
	$( "#screenName" ).val('salaryList');
	if ($("#screenFlag").val() == '1') {
		var formName = '#addForm';
	} else {
		var formName = '#editForm';
	}
	$(formName).submit();
}