<!doctype html>
<html lang="en">
	<head>
		<title>Pay Slip | Salary Add</title>
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
							<ul class="collapse list-unstyled show" id="homeSubmenu">
								<li class="<?php if($mainMenu == 'employeeList') { echo('active'); } ?>">
									<a href="javascript:;" onclick="fnEmployeeList()">List</a>
								</li>
							</ul>
						</li>
						<li class="">
							<a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Salary</a>
							<ul class="collapse list-unstyled <?php if($mainMenu == 'salaryList') { echo('show'); } ?>" id="homeSubmenu">
								<li class="<?php if($mainMenu == 'salaryList') { echo('active'); } ?>">
									<a href="javascript:;" onclick="fnSalaryList()">List</a>
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
			<!-- Page Content  -->
			<div id="content" class="p-4 p-md-5 pt-5">
				<h2 class="mb-4">Salary Add</h2>
				<div class="container mb-4">
					<div class="row justify-content-center">
						<div class="col-lg-9">
							<div class="card shadow-lg border-0 rounded-lg mt-4">
								<div class="card-header"><h3 class="text-center font-weight-light fs20"><?php if(isset($salaryEdit)) { echo "Salary Edit"; } else { echo "Salary Add"; } ?></h3></div>
								<div class="card-body">
									<?php if(isset($salaryEdit)) { ?>
										<form action="../controller/salaryController.php?time=<?php echo(date('YmdHis')); ?>" method="POST" id="editForm" name="editForm">
											<input type="hidden" id="screenFlag" name="screenFlag" value="2">
									<?php } else { ?>
										<form action="../controller/salaryController.php?time=<?php echo(date('YmdHis')); ?>" method="POST" id="addForm" name="addForm">
											<input type="hidden" id="screenFlag" name="screenFlag" value="1">
									<?php } ?>
										<input type="hidden" id="screenName" name="screenName" value="salaryAddEditFormValidation">
										<!-- employee Id -->
										<div class="form-group form-inline">
											<label for='employeeIdLbl' class="col-md-4 control-label required">Employee Id</label>
											<div class="col-md-4">
												<label for='employeeId' class="form-control"><?php echo $employeeId; ?></label>
											</div>
										</div>
										<!-- employee name -->
										<div class="form-group form-inline">
											<label for='employeeNameLbl' class="col-md-4 control-label required">Employee Name</label>
											<div class="col-md-4">
												<label for='employeeName' class="form-control"><?php echo $employeeName; ?></label>
											</div>
										</div>
										<!-- month -->
										<div class="form-group form-inline">
											<label for='monthLbl' class="col-md-4 control-label required">Month</label>
											<div class="col-md-4">
												<label for='month' class="form-control"><?php echo $month; ?></label>
											</div>
										</div>
										<!-- year -->
										<div class="form-group form-inline">
											<label for='yearLbl' class="col-md-4 control-label required">Year</label>
											<div class="col-md-4">
												<label for='year' class="form-control"><?php echo $year; ?></label>
											</div>
										</div>
										<!-- basic salary -->
										<div class="form-group form-inline">
											<label for='basicSalary' class="col-md-4 control-label required">Basic Salary</label>
											<div class="col-md-4">
												<input id="basicSalary" type="text" class="form-control border-revert" name="basicSalary">
											</div>
										</div>
										<!-- insentive -->
										<div class="form-group form-inline">
											<label for='insentive' class="col-md-4 control-label required">Insentive</label>
											<div class="col-md-4">
												<input id="insentive" type="text" class="form-control border-revert" name="insentive">
											</div>
										</div>
										<!-- pf -->
										<div class="form-group form-inline">
											<label for='pf' class="col-md-4 control-label required">PF</label>
											<div class="col-md-4">
												<input id="pf" type="text" class="form-control border-revert" name="pf">
											</div>
										</div>
										<!-- esi -->
										<div class="form-group form-inline">
											<label for='esi' class="col-md-4 control-label required">ESI</label>
											<div class="col-md-4">
												<input id="esi" type="text" class="form-control border-revert" name="esi">
											</div>
										</div>
										<!-- total salary -->
										<div class="form-group form-inline">
											<label for='totalSalary' class="col-md-4 control-label required">Total Salary</label>
											<div class="col-md-4">
												<input id="totalSalary" type="text" class="form-control border-revert" name="totalSalary">
											</div>
										</div>
										<div class="form-group">
											<div class="offset-md-4 col-md-6">
												<?php if(isset($salaryEdit)) { ?>
													<!-- edit button -->
													<button class="btn btn-warning text-white editBtn addEditprocess" onclick="fnSalaryAddEdit()">
														<i class="fa fa-btn fa-edit mr-1"></i>Update
													</button>
												<?php } else { ?>
													<!-- add button -->
													<button class="btn btn-success editBtn addEditprocess" onclick="fnSalaryAddEdit()">
														<i class="fa fa-btn fa-plus mr-1"></i>Add
													</button>
												<?php } ?>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="../webroot/js/jquery.min.js" ></script>
		<script type="text/javascript" src="../webroot/js/popper.js" ></script>
		<script type="text/javascript" src="../webroot/js/main.js" ></script>
		<script type="text/javascript" src="../webroot/js/salary/addEdit.js" ></script>
	</body>
</html>