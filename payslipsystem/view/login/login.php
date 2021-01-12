<!DOCTYPE html>
<html>
	<head>
		<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
		<meta content="utf-8" http-equiv="encoding">
		<title>Pay Slip | Login</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="../webroot/css/login/login.css">
	</head>
	<body class="my-login-page">
		<section class="h-100">
			<div class="container h-100">
				<div class="row justify-content-md-center h-100">
					<div class="card-wrapper">
						<div class="brand">
							<!-- <img src="img/logo.jpg" alt="logo"> -->
						</div>
						<div class="card fat">
							<div class="card-body">
								<h4 class="card-title">Login</h4>
								<form method="POST" id="loginForm" name="loginForm">
									<input type="hidden" id="screenName" name="screenName">
									<!-- username -->
									<div class="form-group">
										<label for="userName">Username</label>
										<input id="userName" type="text" class="form-control" name="userName" pattern=".{0}|.{5}" value="" required autofocus>
										<p id="userNameValidationMsg"></p>
									</div>
									<!-- password -->
									<div class="form-group">
										<label for="password">Password</label>
										<input id="password" type="password" class="form-control" name="password" pattern=".{0}|.{5}" required data-eye>
										<p id="passwordValidationMsg"></p>
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