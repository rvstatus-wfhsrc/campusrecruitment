var data = {};
$(document).ready(function() {
    // edit process
    $('.editprocess').on('click', function() {
        $(".editprocess").attr("disabled", true);
            resetErrors();
            var url = 'profileUpdateValidation';
            var extension = $("#image").val().split('.').pop().toLowerCase();
            if(extension !== "") {
                var imgSize = $('#image')[0].files[0].size/1024/1024;
            }
            $.each($('form input, form select, form hidden, form textarea, form date,form radio'), function(i, v) {
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
            $.ajax({
                dataType: 'json',
                type: 'POST',
                url: url,
                data: data,
                success: function(resp) {
                    // alert(JSON.stringify(resp));
                    if (resp == true) {
                        var confRegMsg = "Are You Confirm To Update ?";
                        if (extension !== "" && (jQuery.inArray(extension, ['jpg', 'jpeg', 'png']) == -1)) {
                            var msg = '<label class="error" style="color:#9C0000; font-size:13px; padding-left: 5px; display:inline-block;">Invalid Format of file. Eg png,jpg,jpeg</label>';
                            $('.formatError').addClass('inputTxtError').append(msg);
                            $(".editprocess").attr("disabled", false);
                        }else if(imgSize > 2) {
                            var msg = '<label class="error" style="color:#9C0000; font-size:13px; padding-left: 5px; display:inline-block;">Please select image size less than 2 MB</label>';
                            $('.formatError').addClass('inputTxtError').append(msg);
                            $(".editprocess").attr("disabled", false);
                        } else {
                            if(confirm(confRegMsg)) {
                                $(".editprocess").attr("disabled", false);
                                $("input").removeAttr('disabled');
                                $("select").removeAttr('disabled');
                                $('#editForm').submit();
                            } else {
                                $(".editprocess").attr("disabled", false);
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

function resetErrors() {
    $('form input').removeClass('inputTxtError');
    $('label.error').remove();
}