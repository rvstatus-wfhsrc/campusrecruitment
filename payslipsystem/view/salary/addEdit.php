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
							<a href="javascript:;" onclick="fnLogout()">Logout</a>
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
				<?php if(isset($salaryEdit)) { ?>
					<form action="../controller/salaryController.php?time=<?php echo(date('YmdHis')); ?>" method="POST" id="editForm" name="editForm">
					<input type="hidden" id="screenFlag" name="screenFlag" value="2">
					<input type="hidden" id="hiddenSalaryId" name="hiddenSalaryId">
				<?php } else { ?>
					<form action="../controller/salaryController.php?time=<?php echo(date('YmdHis')); ?>" method="POST" id="addForm" name="addForm">
					<input type="hidden" id="screenFlag" name="screenFlag" value="1">
				<?php } ?>
					<h2 class="mb-4">
						<?php if(isset($salaryEdit)) {
							echo"Salary Edit";
						} else {
							echo"Salary Add";
						}?>
					</h2>
					<input type="hidden" id="screenName" name="screenName" value="salaryAddEditFormValidation">
					<input type="hidden" id="hiddenEmployeeId" name="hiddenEmployeeId">
					<input type="hidden" id="hiddenEmployeeName" name="hiddenEmployeeName">
					<input type="hidden" id="month" name="month">
					<input type="hidden" id="year" name="year">
					<div class="container mb-4">
						<div class="row justify-content-center">
							<div class="col-lg-9">
								<div class="card shadow-lg border-0 rounded-lg mt-4">
									<div class="card-header"><h3 class="text-center font-weight-light fs20"><?php echo "Salary Add"; ?></h3></div>
									<div class="card-body">
										<!-- employee Id -->
										<div class="form-group form-inline">
											<label for='employeeIdLbl' class="col-md-4 control-label">Employee Id</label>
											<div class="col-md-4">
												<label for='employeeId' class="form-control employeeUserNameClr"><?php echo $employeeId; ?></label>
											</div>
										</div>
										<!-- employee name -->
										<div class="form-group form-inline">
											<label for='employeeNameLbl' class="col-md-4 control-label">Employee Name</label>
											<div class="col-md-4">
												<label for='employeeName' class="form-control nameClr"><?php echo $employeeName; ?></label>
											</div>
										</div>
										<!-- month -->
										<div class="form-group form-inline">
											<label for='monthLbl' class="col-md-4 control-label">Month</label>
											<div class="col-md-4">
												<label for='month' class="form-control"><?php echo $getMonth[$month]; ?></label>
											</div>
										</div>
										<!-- year -->
										<div class="form-group form-inline">
											<label for='yearLbl' class="col-md-4 control-label">Year</label>
											<div class="col-md-4">
												<label for='year' class="form-control"><?php echo $year; ?></label>
											</div>
										</div>
										<!-- basic salary -->
										<div class="form-group form-inline">
											<label for='basicSalary' class="col-md-4 control-label required">Basic Salary</label>
											<div class="col-md-8">
												<input id="basicSalary" name="basicSalary" type="text" class="form-control border-revert w33" placeholder="Enter Basic Salary" value="<?php if(isset($salaryEdit[0]['BasicSalary'])) { echo $salaryEdit[0]['BasicSalary']; }?>">
											</div>
										</div>
										<!-- insentive -->
										<div class="form-group form-inline">
											<label for='insentive' class="col-md-4 control-label required">Insentive</label>
											<div class="col-md-8">
												<input id="insentive" name="insentive" type="text" class="form-control border-revert w33" placeholder="Enter Insentive" value="<?php if(isset($salaryEdit[0]['Insentive'])) { echo $salaryEdit[0]['Insentive']; }?>">
											</div>
										</div>
										<!-- pf -->
										<div class="form-group form-inline">
											<label for='pf' class="col-md-4 control-label required">PF</label>
											<div class="col-md-8">
												<input id="pf" name="pf" type="text" class="form-control border-revert w33" placeholder="Enter PF" value="<?php if(isset($salaryEdit[0]['pf'])) { echo $salaryEdit[0]['pf']; }?>">
											</div>
										</div>
										<!-- esi -->
										<div class="form-group form-inline">
											<label for='esi' class="col-md-4 control-label required">ESI</label>
											<div class="col-md-8">
												<input id="esi" name="esi" type="text" class="form-control border-revert w33" placeholder="Enter ESI" value="<?php if(isset($salaryEdit[0]['esi'])) { echo $salaryEdit[0]['esi']; }?>">
											</div>
										</div>
										<!-- total salary -->
										<div class="form-group form-inline">
											<label for='totalSalary' class="col-md-4 control-label required">Total Salary</label>
											<div class="col-md-8">
												<input id="totalSalary" name="totalSalary" type="text" class="form-control border-revert w33" placeholder="Total Salary" value="<?php if(isset($salaryEdit[0]['totalSalary'])) { echo $salaryEdit[0]['totalSalary']; }?>">
											</div>
										</div>
										<div class="form-group">
											<div class="offset-md-4 col-md-6">
												<?php if(isset($salaryEdit)) { ?>
													<a class="btn btn-warning editBtn" href="javascript:;" onclick="fnSalaryAddEdit('<?php echo $employeeId; ?>','<?php echo $employeeName; ?>',<?php echo $month; ?>,<?php echo $year; ?>)">
														<i class="fa fa-edit fa-btn mr-1"></i>Update
													</a>
												<?php } else { ?>
													<a class="btn btn-success editBtn" href="javascript:;" onclick="fnSalaryAddEdit('<?php echo $employeeId; ?>','<?php echo $employeeName; ?>',<?php echo $month; ?>,<?php echo $year; ?>)">
														<i class="fa fa-plus fa-btn mr-1"></i>Add
													</a>
												<?php } ?>
											</div>
										</div>
									</div>
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
		<script type="text/javascript" src="../webroot/js/salary/addEdit.js" ></script>
	</body>
</html>