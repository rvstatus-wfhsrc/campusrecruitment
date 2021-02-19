<!doctype html>
<html lang="en">
	<head>
		<title><?php echo $lbl_paySlip; ?> | <?php echo $lbl_mailView; ?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="../webroot/css/style.css">
		<link rel="stylesheet" href="../webroot/css/common.css">
		<script type="text/javascript">
			var dateTime = "<?php echo date('Ymdhis'); ?>";
		</script>
		<script type="text/javascript" src="../webroot/common/<?php echo $languageJs; ?>" ></script>
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
							<a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><?php echo $lbl_employee; ?></a>
							<ul class="collapse list-unstyled <?php if($mainMenu == 'paySlipView') { echo('show'); } ?>" id="homeSubmenu">
								<li>
									<a class="active" href="javascript:;" onclick="fnEmployeeList()"><?php echo $lbl_list; ?></a>
								</li>
							</ul>
						</li>
						<li class="">
							<a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><?php echo $lbl_salary; ?></a>
							<ul class="collapse list-unstyled show" id="homeSubmenu">
								<li class="<?php if($mainMenu == 'salaryList') { echo('active'); } ?>">
									<a href="javascript:;" onclick="fnSalaryList()"><?php echo $lbl_list; ?></a>
								</li>
							</ul>
						</li>
						<li>
							<a href="javascript:;" onclick="fnLogout()"><?php echo $lbl_logout; ?></a>
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
					<h2><?php echo $lbl_paySlip." ".$lbl_mailView; ?></h2>
					<input type="hidden" id="screenName" name="screenName">
					<input type="hidden" id="hiddenSalaryId" name="hiddenSalaryId">
					<input type="hidden" id="hiddenFileName" name="hiddenFileName">
					<input type="hidden" id="month" name="month" value="<?php echo $paySlipDetail[0]['Month']; ?>">
					<input type="hidden" id="year" name="year" value="<?php echo $paySlipDetail[0]['Year']; ?>">
					<?php
						$months = date('m',$paySlipDetail[0]['Month']);
						$dates = date('d');
					?>
					<div class="mb-1">
						<a class="btn btn-info editBtn" href="javascript:;" onclick="fnBackBtn(<?php echo $month; ?>,<?php echo $year; ?>)">
							<i class="fa fa-chevron-left fa-btn mr-1"></i><?php echo $lbl_back; ?>
						</a>
						<?php if($paySlipDetail[0]['totalSalary'] != 0) { ?>
							<a class="btn bg-warning text-white editBtn" href="javascript:;" onclick="fnSendMail(<?php echo $paySlipDetail[0]['salaryId']; ?>,<?php echo $month; ?>,<?php echo $year; ?>,'<?php echo "pay_slip_".$paySlipDetail[0]['Emp_ID']."_".$paySlipDetail[0]['Year']."_".$months.".xls"; ?>')">
								<i class="fa fa-envelope fa-btn mr-1"></i><?php echo $lbl_sendMail; ?>
							</a>
						<?php } ?>
					</div>
					<div class="box">
						<div class="container">
							<div>
								<div class="leftSide"><?php echo $lbl_employee." ".$lbl_name; ?></div>
								<div class="rightSide nameClr"><?php echo $paySlipDetail[0]['FirstName']." ".$paySlipDetail[0]['LastName']; ?></div>
							</div>
							<div>
								<div class="leftSide required"><?php echo $lbl_to; ?></div>
								<div class="rightSide">
									<input type="text" id="toMail" name="toMail" class="w43 h34" value="<?php echo $paySlipDetail[0]['Emailpersonal']; ?>">
								</div>
							</div>
							<div>
								<div class="leftSide required"><?php echo $lbl_cc; ?></div>
								<div class="rightSide">
									<input type="text" id="cc" name="cc" class="w43 h34" value="Nil">
								</div>
							</div>
							<div>
								<div class="leftSide required"><?php echo $lbl_subject; ?></div>
								<div class="rightSide">
									<input type="text" id="subject" name="subject" class="w43 h34" value="<?php echo "Reg : Pay Slip ".$paySlipDetail[0]['Year']."/".$months."/".$dates; ?>">
								</div>
							</div>
							<div>
								<div class="leftSide required"><?php echo $lbl_content; ?></div>
								<?php $content = $paySlipDetail[0]['FirstName']." ".$paySlipDetail[0]['LastName'].",\n Please find attached salary slip of ".$paySlipDetail[0]['FirstName']." ".$paySlipDetail[0]['LastName']." for ".date('F',$month)."-".$paySlipDetail[0]['Year'].".\nIf you have any question,do not hesitate to contact us.\nRegards,\nHR Department,\nSathi Systems Pvt. Ltd." ?>
								<div class="rightSide vat">
									<textarea id="content" name="content" rows="3" cols="46" class="w43" style="min-height:0">Dear <?php echo $content ; ?></textarea>
								</div>
							</div>
							<div>
								<div class="leftSide"><?php echo $lbl_attachment; ?></div>
								<div class="rightSide">
									<a href="javascript:;" title="To Download Salary Pay Slip" onclick="downloadPaySlipOnView('<?php echo "pay_slip_".$paySlipDetail[0]['Emp_ID']."_".$paySlipDetail[0]['Year']."_".$months.".xls"; ?>')">
										<?php echo "pay_slip_".$paySlipDetail[0]['Emp_ID']."_".$paySlipDetail[0]['Year']."_".$months.".xls"; ?>
									</a>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<script type="text/javascript" src="../webroot/js/jquery.min.js" ></script>
		<script type="text/javascript" src="../webroot/js/popper.js" ></script>
		<script type="text/javascript" src="../webroot/js/main.js" ></script>
		<script type="text/javascript" src="../webroot/js/paySlip/view.js" ></script>
	</body>
</html>