<!doctype html>
<html lang="en">
	<head>
		<title>Pay Slip | Employee History</title>
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
							<ul class="collapse list-unstyled <?php if($mainMenu == 'paySlipEmployeeHistory') { echo('show'); } ?>" id="homeSubmenu">
								<li class="<?php if($mainMenu == 'employeeList') { echo('active'); } ?>">
									<a href="javascript:;" onclick="fnEmployeeList()">List</a>
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
			<!-- Page Content  -->
			<div id="content" class="p-4 p-md-5 pt-5">
				<form action="../controller/employeeController.php?time=<?php echo(date('YmdHis')); ?>" method="POST" id="employeeHistoryForm" name="employeeHistoryForm">
					<input type="hidden" id="screenName" name="screenName">
					<input type="hidden" id="pageno" name="pageno" value="<?php echo $pageno; ?>">
					<h2 class="mb-4">Pay Slip Employee History</h2>
					<div class="mb-1">
						<a class="btn btn-info editBtn" href="javascript:;" onclick="fnBackBtn()">
							<i class="fa fa-chevron-left fa-btn"></i>Back
						</a>
					</div>
					<div class="inb">
						<label> Employee Id :</label>
						<span class="employeeUserNameClr">
							<?php echo $detailView[0]["Emp_Id"]; ?>
						</span>
					</div>
					<div class="inb ml-5">
						<label> Employee Name :</label>
						<span class="nameClr">
							<?php echo $detailView[0]["FirstName"]." ".$detailView[0]["LastName"]; ?>
						</span>
					</div>
					<table class="table table-bordered table-position">
						<colgroup>
							<col width="1%">
							<col width="18%">
							<col width="15%">
							<col>
							<col width="13%">
							<col width="12%">
							<col width="5%">
						</colgroup>
						<thead class="thead">
							<tr>
								<th>S.No.</th>
								<th title="Personal E-Mail Address">To</th>
								<th>Subject</th>
								<th>Content</th>
								<th>Year / Month</th>
								<th title="Total Salary">Salary</th>
								<th>Attachment</th>
							</tr>
						</thead>
						<?php if ($detailView != null) { ?>
							<?php $i = 0;
							foreach ($detailView as $key => $details) { ?>
								<?php $class = $key % 2 === 0 ? 'odd' : 'even'; ?>
								<tr class="<?php echo $class; ?>">
									<td class="tac"><?php echo ($pageno - 1) * $resultsPerPage + $key + 1 ?></td>
									<td><?php echo $detailView[$i]["toMail"]; ?></td>
									<td><?php echo $detailView[$i]["subject"]; ?></td>
									<td><?php echo nl2br($detailView[$i]["content"]); ?></td>
									<td class="tac"><?php echo $detailView[$i]["year"]." / ".$detailView[$i]["month"]; ?></td>
									<td class="tac">
										<?php if(isset($detailView[$i]["totalSalary"])) {
											echo number_format($detailView[$i]["totalSalary"]); ?> &#8377;
										<?php } else {
											echo ("-");
										} ?>
									</td>
									<td class="tac">
										<a href="javascript:;" onclick="fnOpenPaySlip()">
											<img style="width: 20px;" src="../webroot/images/details.png" title="Pay Slip View">
										</a>
									</td>
								</tr>
							<?php $i++;
							}
						} else { ?>
							<tr>
								<td colspan="6" class="tac noDataFoundClr">No data found</td>
							</tr>
						<?php } ?>
					</table>
				</form>
			</div>
		</div>
		<script type="text/javascript" src="../webroot/js/jquery.min.js" ></script>
		<script type="text/javascript" src="../webroot/js/popper.js" ></script>
		<script type="text/javascript" src="../webroot/js/main.js" ></script>
		<script type="text/javascript" src="../webroot/js/paySlip/employeeHistory.js" ></script>
	</body>
</html>