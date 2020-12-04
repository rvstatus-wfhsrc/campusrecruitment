var data = {};
$(document).ready(function() {
    $('.registerprocess').on('click', function() {
        $(".registerprocess").attr("disabled", true);
        resetErrors();
        var url = 'companyFormValidation';
        $.each($('form input, form hidden, form textarea, form date,form radio'), function(i, v) {
            if (v.type !== 'submit') {
                data[v.name] = v.value;
            }
        }); // end each
        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: url,
            data: data,
            success: function(resp) {
                // alert(JSON.stringify(resp));
                if (resp === true) {
                    var confRegMsg = "Are You Confirm To Add The Company ?";
                    if(confirm(confRegMsg)) {
                        $(".registerprocess").attr("disabled", false);
                        $("input").removeAttr('disabled');
                        $("select").removeAttr('disabled');
                        $('#addForm').submit();
                    } else {
                        $(".registerprocess").attr("disabled", false);
                    }
                } else {
                    $.each(resp, function(i, v) {
                        // view in console for error messages
                        var msg = '<label class="error" style="color:#9C0000; font-size:13px; padding-left: 5px; display:inline-block;" for="'+i+'">'+v+'</label>';
                            $('input[name="' + i + '"], select[name="' + i + '"], textarea[name="' + i + '"]').addClass('inputTxtError').after(msg);
                    }); 
                    $(".registerprocess").attr("disabled", false);
                }
                return false;
            },
            error: function(data) {
                // alert(data.status);
                alert('there was a problem checking the fields');
            }
        });
        return false;
    });
    $('.editprocess').on('click', function() {
        $(".editprocess").attr("disabled", true);
        resetErrors();
        var url = 'companyFormValidation';
        $.each($('form input, form hidden, form textarea, form date'), function(i, v) {
            if (v.type !== 'submit') {
                data[v.name] = v.value;
            }
        }); // end each
        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: url,
            data: data,
            success: function(resp) {
                // alert(JSON.stringify(resp));
                if (resp === true) {
                    var confUpdateMsg = "Are You Confirm To Update ?";
                    if(confirm(confUpdateMsg)) {
                        $(".editprocess").attr("disabled", false);
                        $("input").removeAttr('disabled');
                        $('#editForm').submit();
                    } else {
                        $(".editprocess").attr("disabled", false);
                    }
                } else {
                    $.each(resp, function(i, v) {
                        // view in console for error messages
                        var msg = '<label class="error" style="color:#9C0000; font-size:13px; padding-left: 5px; display:inline-block;" for="'+i+'">'+v+'</label>';
                                $('input[name="' + i + '"], select[name="' + i + '"], textarea[name="' + i + '"]').addClass('inputTxtError').after(msg);
                    }); 
                    $(".editprocess").attr("disabled", false);
                }
                return false;
            },
            error: function(data) {
                // alert(data.status);
                alert('there was a problem checking the fields');
            }
        });
        return false;
    });
});

// company entry date
$('#entryDate').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd',
    todayHighlight: true
});
        
function resetErrors() {
    $('form input, form select').removeClass('inputTxtError');
    $('label.error').remove();
}