var data = {};
$(document).ready(function() {
    $('.addEditProcess').on('click', function() {
        $(".addEditProcess").attr("disabled", true);
            resetErrors();
            var url = 'jobAddEditFormValidation';
            $.each($('form input, form hidden, form textarea, form date,form radio,form select'), function(i, v) {
                if (v.type !== 'submit') {
                    data[v.name] = v.value;
                }
            }); // end each
            // alert(JSON.stringify(data));
            $.ajax({
                dataType: 'json',
                type: 'POST',
                url: url,
                data: data,
                success: function(resp) {
                    // alert(JSON.stringify(resp));
                    if (resp === true) {
                        //screenFlag => 1 ----> register
                        if($("#screenFlag").val() == '1') {
                            var confRegMsg = "Are You Confirm To Add The Job Details ?";
                            if(confirm(confRegMsg)) {
                                $(".addEditProcess").attr("disabled", false);
                                $("input").removeAttr('disabled');
                                $("select").removeAttr('disabled');
                                $('#addForm').submit();
                            } else {
                                $(".addEditProcess").attr("disabled", false);
                            }
                        } else {
                            var confUpdateMsg = "Are You Confirm To Update The Job Details ?";
                            if(confirm(confUpdateMsg)) {
                                $(".addEditProcess").attr("disabled", false);
                                $("input").removeAttr('disabled');
                                $("select").removeAttr('disabled');
                                $('#editForm').submit();
                            } else {
                                $(".addEditProcess").attr("disabled", false);
                            }

                        }
                    } else {
                        $.each(resp, function(i, v) {
                            // view in console for error messages
                            var msg = '<label class="error" style="color:#9C0000; font-size:13px; padding-left: 5px; display:inline-block;" for="'+i+'">'+v+'</label>';
                                $('input[name="' + i + '"], select[name="' + i + '"], textarea[name="' + i + '"]').addClass('inputTxtError').after(msg);
                        }); 
                        $(".addEditProcess").attr("disabled", false);
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
    // $('.editprocess').on('click', function() {
    //     $(".editprocess").attr("disabled", true);
    //         resetErrors();
    //         var url = 'companyFormValidation';
    //         $.each($('form input, form select, form hidden, form textarea, form date,form radio'), function(i, v) {
    //             if (v.type !== 'submit') {
    //                 data[v.name] = v.value;
    //             }
    //         }); // end each
    //         $.ajax({
    //             dataType: 'json',
    //             type: 'POST',
    //             url: url,
    //             data: data,
    //             success: function(resp) {
    //                 // alert(JSON.stringify(resp));
    //                 if (resp === true) {
    //                     var confUpdateMsg = "Are You Confirm To Update ?";
    //                     // screenFlag => 2 ----> update
    //                     // if($("#screenFlag").val() == '2') {
    //                         if(confirm(confUpdateMsg)) {
    //                             $(".editprocess").attr("disabled", false);
    //                             $("input").removeAttr('disabled');
    //                             $("select").removeAttr('disabled');
    //                             $('#editForm').submit();
    //                         } else {
    //                             $(".editprocess").attr("disabled", false);
    //                         }
    //                     // }
    //                 } else {
    //                     $.each(resp, function(i, v) {
    //                         // view in console for error messages
    //                         var msg = '<label class="error" style="color:#9C0000; font-size:13px; padding-left: 5px; display:inline-block;" for="'+i+'">'+v+'</label>';
    //                         $('input[name="' + i + '"], select[name="' + i + '"], textarea[name="' + i + '"]').addClass('inputTxtError').after(msg);
    //                     }); 
    //                     $(".editprocess").attr("disabled", false);
    //                 }
    //                 return false;
    //             },
    //             error: function(data) {
    //                 // alert(data.status);
    //                 alert('there was a problem checking the fields');
    //             }
    //         });
    //     return false;
    // });
});

// company entry date
$('#lastApplyDate').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd',
    todayHighlight: true
});
function resetErrors() {
    $('form input, form select').removeClass('inputTxtError');
    $('label.error').remove();
}