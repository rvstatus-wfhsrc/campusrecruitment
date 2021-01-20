<!doctype html>
<html lang="en">
	<head>
		<title>Pay Slip | View</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="../webroot/css/style.css">
		<link rel="stylesheet" href="../webroot/css/common.css">
		<script type="text/javascript">
			var dateTime = "<?php echo date('Ymdhis'); ?>";
		</script>
	</head>
	<body>
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
						<i class="fa fa-bars"></i>
						<span class="sr-only">Toggle Menu</span>
					</button>
				</div>
				<div class="p-4 pt-5">
					<h1>
						<!-- <a href="index.html" class="logo">Splash</a> -->
					</h1>
					<ul class="list-unstyled components mb-5">
						<li class="active">
							<a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Employee</a>
							<ul class="collapse list-unstyled" id="homeSubmenu">
								<li>
									<a class="active" href="#">List</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pay Slip</a>
							<ul class="collapse list-unstyled" id="pageSubmenu">
								<li>
									<a href="#">History</a>
								</li>
							</ul>
						</li>
					</ul>
					<div class="footer">
						<p>
							<!-- Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Pay Slip System -->
						</p>
					</div>
				</div>
			</nav>
			<!-- page content -->
			<div id="content" class="p-4 p-md-5 pt-5">
				<form action="../controller/paySlipController.php?time=<?php echo(date('YmdHis')); ?>" method="POST" id="viewForm" name="viewForm">
					<h2 class="mb-4">Pay Slip View</h2>
					<input type="hidden" id="screenName" name="screenName">
					<input type="hidden" id="hiddenSalaryId" name="hiddenSalaryId">
					<div class="mb-1">
						<a class="btn btn-info editBtn" href="javascript:;" onclick="fnBackBtn()">
							<i class="fa fa-chevron-left fa-btn"></i>Back
						</a>
						<a class="btn bg-warning text-white editBtn" href="javascript:;" onclick="fnSendMail()">
							<i class="fa fa-edit fa-btn"></i>Send Mail
						</a>
					</div>
					<div class="box">
						<div class="container">
							<!-- employee id -->
							<div>
								<div class="leftSide"> Company Name : </div>
								<div class="rightSide"><?php echo "Sathi Systems Pvt. Ltd."; ?></div>
							</div>
							<!-- name -->
							<div>
								<div class="leftSide"> Employee Name : </div>
								<div class="rightSide"><?php echo $paySlipDetail[0]['FirstName']." ".$paySlipDetail[0]['LastName']; ?></div>
							</div>
							<!-- name -->
							<div>
								<div class="leftSide"> To : </div>
								<div class="rightSide"><?php echo $paySlipDetail[0]['Emailoffice']; ?></div>
							</div>
							<!-- designation -->
							<div>
								<div class="leftSide"> CC : </div>
								<div class="rightSide"><?php echo "Nil"; ?></div>
							</div>
							<!-- gender -->
							<div>
								<div class="leftSide"> Subject : </div>
								<div class="rightSide"><?php echo "Salary Pay Slip"; ?></div>
							</div>
							<!-- date of birth -->
							<div>
								<div class="leftSide"> Content : </div>
								<div class="rightSide"><?php echo "Please find attached your Pay Slip for the previous month."; ?></div>
							</div>
							<!-- date of joining -->
							<div>
								<div class="leftSide"> Attachment : </div>
								<div class="rightSide"><a href="javascript:;" onclick="downloadPaySlip(<?php echo $paySlipDetail[0]['salaryId']; ?>)">Download Pay Slip</a></div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<script type="text/javascript" src="../webroot/js/jquery.min.js" ></script>
		<script type="text/javascript" src="../webroot/js/popper.js" ></script>
		<script type="text/javascript" src="../webroot/js/bootstrap.min.js" ></script>
		<script type="text/javascript" src="../webroot/js/main.js" ></script>
		<script type="text/javascript" src="../webroot/js/paySlip/view.js" ></script>
	</body>
</html>