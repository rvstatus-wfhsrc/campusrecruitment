<!doctype html>
<html lang="en">
	<head>
		<title>Pay Slip | Mail View</title>
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
							<ul class="collapse list-unstyled <?php if($mainMenu == 'paySlipView') { echo('show'); } ?>" id="homeSubmenu">
								<li>
									<a class="active" href="javascript:;" onclick="fnEmployeeList()">List</a>
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
					<h2 class="mb-4">Pay Slip Mail View</h2>
					<input type="hidden" id="screenName" name="screenName">
					<input type="hidden" id="hiddenSalaryId" name="hiddenSalaryId">
					<div class="mb-1">
						<a class="btn btn-info editBtn" href="javascript:;" onclick="fnBackBtn()">
							<i class="fa fa-chevron-left fa-btn"></i>Back
						</a>
						<a class="btn bg-warning text-white editBtn" href="javascript:;" onclick="fnSendMail(<?php echo $paySlipDetail[0]['salaryId']; ?>)">
							<i class="fa fa-edit fa-btn"></i>Send Mail
						</a>
					</div>
					<?php
						$month = date('m',$paySlipDetail[0]['Month']);
						$date = date('d');
					?>
					<div class="box">
						<div class="container">
							<div>
								<div class="leftSide"> Employee Name : </div>
								<div class="rightSide nameClr"><?php echo $paySlipDetail[0]['FirstName']." ".$paySlipDetail[0]['LastName']; ?></div>
							</div>
							<div>
								<div class="leftSide"> To : </div>
								<div class="rightSide"><?php echo $paySlipDetail[0]['Emailpersonal']; ?></div>
							</div>
							<div>
								<div class="leftSide"> CC : </div>
								<div class="rightSide"><?php echo "Nil"; ?></div>
							</div>
							<div>
								<div class="leftSide"> Subject : </div>
								<div class="rightSide"><?php echo "Pay Slip_".$paySlipDetail[0]['Year']."_".$month."_".$date; ?></div>
							</div>
							<div>
								<div class="leftSide"> Content : </div>
								<div class="rightSide"><?php echo "Please find attached your Pay Slip for the previous month."; ?></div>
							</div>
							<div>
								<div class="leftSide"> Attachment : </div>
								<div class="rightSide"><a href="javascript:;" title="To Download Salary Pay Slip" onclick="downloadPaySlip(<?php echo $paySlipDetail[0]['salaryId']; ?>)"><?php echo "pay_slip_".$paySlipDetail[0]['Emp_ID']."_".$paySlipDetail[0]['Year'].$month.$date; ?></a></div>
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