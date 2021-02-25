<!DOCTYPE html>
<html>
	<head>
		<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
		<meta content="utf-8" http-equiv="encoding">
		<title>Pay Slip | Login</title>
		<link rel="stylesheet" type="text/css" href="../webroot/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../webroot/css/login/login.css">
		<link rel="stylesheet" type="text/css" href="../webroot/css/common.css">
		<script type="text/javascript">
        	var dateTime = "<?php echo date('Ymdhis'); ?>";
    </script>
    <style>
	    .container {
	    	line-height: 34px;
	    }
    </style>
	</head>
	<body class="my-login-page">
		<section class="h-100">
			<div class="container h-100">
				<div class="row justify-content-md-center h-100">
					<div class="card-wrapper">
						<div class="brand">
							<img src="../webroot/images/login.png" title="Pay Slip View">
						</div>
						<div class="card fat">
							<div class="card-body">
								<h4 class="card-title">Login</h4>
								<form method="POST" id="loginForm" name="loginForm">
									<input type="hidden" id="screenName" name="screenName">
									<!-- username -->
									<div class="form-group">
										<label for="userName" class="required">Username</label>
										<input id="userName" type="text" class="form-control" name="userName" pattern=".{0}|.{5}" value="" required autofocus>
										<p class="error" id="userNameValidationMsg"></p>
									</div>
									<!-- password -->
									<div class="form-group">
										<label for="password" class="required">Password</label>
										<input id="password" type="password" class="form-control" name="password" pattern=".{0}|.{5}" required data-eye>
										<p class="error" id="passwordValidationMsg"></p>
									</div>
									<!-- login button -->
									<div class="form-group m-0">
										<button type="button" class="btn btn-primary btn-block" id="loginbtn" name="loginbtn">
											Login
										</button>
									</div>
								</form>
							</div>
						</div>
						<div class="footer">
							Copyright &copy; Pay Slip System
						</div>
					</div>
				</div>
			</div>
		</section>
		<script type="text/javascript" src="../webroot/js/jquery.min.js" ></script>
		<script type="text/javascript" src="../webroot/js/login/login.js" ></script>
	</body>
</html>