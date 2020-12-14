var data = {};
$(document).ready(function() {
    $('.addEditProcess').on('click', function() {
        $(".addEditProcess").attr("disabled", true);
            resetErrors();
            var url = 'jobSeekerProfileFormValidation';
            var extension = $("#image").val().split('.').pop().toLowerCase();
            if(extension !== "") {
                var imgSize = $('#image')[0].files[0].size/1024/1024;
            }
            $.each($('form input, form hidden, form textarea, form date,form radio,form select'), function(i, v) {
                if (v.type !== 'submit') {
                    data[v.name] = v.value;
                }
                if (v.type == 'radio') {
                    var rdoval = $('input[name='+v.name+']:checked').val();
                    if (rdoval != undefined) {
                        data[v.name] = rdoval;
                    } else {
                        // for undefined ie uncheck radio button
                        data[v.name] = ""; 
                    }
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
                        if (extension !== "" && (jQuery.inArray(extension, ['jpg', 'jpeg', 'png']) == -1)) {
                            var msg = '<label class="error" style="color:#9C0000; font-size:13px; padding-left: 5px; display:inline-block;">Invalid Format of file. Eg png,jpg,jpeg</label>';
                            $('.formatError').addClass('inputTxtError').append(msg);
                            $(".addEditProcess").attr("disabled", false);
                        }else if(imgSize > 2) {
                            var msg = '<label class="error" style="color:#9C0000; font-size:13px; padding-left: 5px; display:inline-block;">Please select image size less than 2 MB</label>';
                            $('.formatError').addClass('inputTxtError').append(msg);
                            $(".addEditProcess").attr("disabled", false);
                        } else {
                            //screenFlag => 1 ----> register
                            if($("#screenFlag").val() == '1') {
                                var confRegMsg = "Are You Confirm To Add The Job Seeker Details ?";
                                if(confirm(confRegMsg)) {
                                    $(".addEditProcess").attr("disabled", false);
                                    $("input").removeAttr('disabled');
                                    $("select").removeAttr('disabled');
                                    $('#addForm').submit();
                                } else {
                                    $(".addEditProcess").attr("disabled", false);
                                }
                            } else {
                                var confUpdateMsg = "Are You Confirm To Update The Job Seeker Details ?";
                                if(confirm(confUpdateMsg)) {
                                    $(".addEditProcess").attr("disabled", false);
                                    $("input").removeAttr('disabled');
                                    $("select").removeAttr('disabled');
                                    $('#editForm').submit();
                                } else {
                                    $(".addEditProcess").attr("disabled", false);
                                }
                            }
                        }
                    } else {
                        $.each(resp, function(i, v) {
                            // view in console for error messages
                            var msg = '<label class="error" style="color:#9C0000; font-size:13px; padding-left: 5px; display:inline-block;" for="'+i+'">'+v+'</label>';
                            if ($('input[name="' + i + '"]').hasClass('gender')) {
                                $('input[name="' + i + '"]').addClass('inputTxtError');
                                $('.genderError').append(msg);
                            }else {
                                $('input[name="' + i + '"], select[name="' + i + '"], textarea[name="' + i + '"]').addClass('inputTxtError').after(msg);
                            }
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
});

function resetErrors() {
    $('form input, form select').removeClass('inputTxtError');
    $('label.error').remove();
}