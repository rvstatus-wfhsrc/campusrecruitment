/******************************************
 * Login
 *
 * Bootstrap 4 Login Page
 *
 * @author          kulasekaran
 * @copyright       Copyright (c) 2018 kulasekaran
 * @license         My Login is licensed under the MIT license.
 * @github          https://github.com/kulasekaran/login
 * @version         1.2.0
 * 
 ******************************************/

'use strict';

$(function() {

	$("input[type='password'][data-eye]").each(function(i) {
		var $this = $(this),
			id = 'eye-password-' + i,
			el = $('#' + id);

		$this.wrap($("<div/>", {
			style: 'position:relative',
			id: id
		}));

		$this.css({
			paddingRight: 60
		});
		$this.after($("<div/>", {
			html: 'Show',
			class: 'btn btn-primary btn-sm',
			id: 'passeye-toggle-'+i,
		}).css({
				position: 'absolute',
				right: 10,
				top: ($this.outerHeight() / 2) - 12,
				padding: '2px 7px',
				fontSize: 12,
				cursor: 'pointer',
		}));

		$this.after($("<input/>", {
			type: 'hidden',
			id: 'passeye-' + i
		}));

		var invalid_feedback = $this.parent().parent().find('.invalid-feedback');

		if(invalid_feedback.length) {
			$this.after(invalid_feedback.clone());
		}

		$this.on("keyup paste", function() {
			$("#passeye-"+i).val($(this).val());
		});
		$("#passeye-toggle-"+i).on("click", function() {
			if($this.hasClass("show")) {
				$this.attr('type', 'password');
				$this.removeClass("show");
				$(this).removeClass("btn-outline-primary");
			}else{
				$this.attr('type', 'text');
				$this.val($("#passeye-"+i).val());
				$this.addClass("show");
				$(this).addClass("btn-outline-primary");
			}
		});
	});

	$('#loginbtn').on('click', function() {
		var userName = document.getElementById("userName");
		if (!userName.checkValidity()) {
			if (userName.validity.patternMismatch) {
				var userNameValidationMessage = "The Username field must be contains 5 characters.";
			} else {
				var userNameValidationMessage = "The Username field is required.";
			}
			document.getElementById("userNameValidationMsg").innerHTML = userNameValidationMessage;
		} else {
			document.getElementById("userNameValidationMsg").innerHTML ="";
		}
		var password = document.getElementById("password");
		if (!password.checkValidity()) {
			if (password.validity.patternMismatch) {
				var passwordValidationMessage = "The Password field must be contains 5 characters.";
			} else {
				var passwordValidationMessage = "The Password field is required.";
			}
			document.getElementById("passwordValidationMsg").innerHTML = passwordValidationMessage;
		} else {
			document.getElementById("passwordValidationMsg").innerHTML ="";
		}
		var userNameVal = document.getElementById("userName").value;
		var passwordVal = document.getElementById("password").value;
		if ((userNameVal == "admin") && (passwordVal == "admin")) {
			$( "#screenName" ).val('employeeList');
			document.getElementById("loginForm").action = "../controller/loginController.php?time="+dateTime;
			$( "#loginForm" ).submit();
		} else if((userName.checkValidity() == true) && (password.checkValidity() == true) && ((userNameVal != "admin") || (passwordVal != "admin"))) {
			var userNameValidationMessage = "These credentials do not match our records.";
			document.getElementById("userNameValidationMsg").innerHTML = userNameValidationMessage;
		}
	});
});