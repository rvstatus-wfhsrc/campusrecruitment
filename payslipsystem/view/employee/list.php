<!doctype html>
<html lang="en">
	<head>
		<title>Pay Slip | Employee List</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="../webroot/css/style.css">
		<link rel="stylesheet" href="../webroot/css/common.css">
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
			<!-- Page Content  -->
			<form action="../controller/employeeController.php" method="POST" id="listForm" name="listForm">
				<input type="hidden" id="screenName" name="screenName">
				<input type="hidden" id="hiddenSearch" name="hiddenSearch" value="<?php echo $employeeListArray['search']?>">
				<div id="content" class="p-4 p-md-5 pt-5">
					<h2 class="mb-4">Employee List</h2>
					<!-- sorting process -->
					<div class="inb float-left">
						<select name="sortProcess" id="sortProcess" class="form-control autowidth h34 inb mr-2">
							<option value='1'>Employee Id</option>
							<option value='2'>Employee Name</option>
						</select>
						<input type="hidden" id="sortVal" name="sortVal" value="<?php echo $employeeListArray['sortVal']?>">
						<input type="hidden" id="sortOptn" name="sortOptn" value="<?php echo $sortOptn; ?>">
					</div>
					<!-- searching process -->
					<div class="input-group searchBtn">
						<input type="text" id="search" name="search" placeholder="Search Employee Name" class="input_box form-control h34" value="<?php echo $employeeListArray['search']?>">
						<div class="input-group-append">
							<a class="btn btn-secondary h34" href="javascript:;" onclick="fnSearch()">
								<i class="fa fa-search" title="Search"></i>
							</a>
						</div>
					</div>
					<table class="table table-bordered table-position">
						<colgroup>
							<col width="1%">
							<col width="12%">
							<col>
							<col width="9%">
							<col width="12%">
							<col width="9%">
							<col width="11%">
						</colgroup>
						<thead class="thead">
							<tr>
								<th>S.No.</th>
								<th>Employee Id</th>
								<th>Name</th>
								<th>Contact</th>
								<th title="Net Salary">Salary</th>
								<th title="Personal E-Mail Address">E-Mail</th>
								<th></th>
							</tr>
						</thead>
						<?php if ($employeeListArray['employeeList'] != null) { ?>
							<?php
								$i = 0; 
								for ($i = 0 ; $i < 5 ; $i++) { ?>
								<tr>
									<td><?php echo $i+1; ?></td>
									<td><?php echo $employeeListArray['employeeList'][$i]["Emp_ID"]; ?></td>
									<td><?php echo $employeeListArray['employeeList'][$i]["FirstName"]." ".$employeeListArray['employeeList'][$i]["LastName"]; ?></td>
									<td><?php echo $employeeListArray['employeeList'][$i]["Mobile"]; ?></td>
									<td><?php echo "10,000"; ?></td>
									<td><?php echo $employeeListArray['employeeList'][$i]["Emailpersonal"]; ?></td>
									<td></td>
								</tr>
							<?php } ?>
						<?php } else { ?>
							<tr>
								<td colspan="7" class="tac noDataFoundClr">No data found</td>
							</tr>
						<?php } ?>
					</table>
					<?php if (isset($employeeListArray)) { ?>
						<ul class="pagination">
							<li><a href="?$pageno = 1&screenName=employeeList">First</a></li>
							<li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
								<a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>&screenName=employeeList">Prev</a>
							</li>
							<li class="<?php if($pageno >= $totalPages){ echo 'disabled'; } ?>">
								<a href="<?php if($pageno >= $totalPages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>&screenName=employeeList">Next</a>
							</li>
							<li><a href="?pageno=<?php echo $totalPages; ?>&screenName=employeeList">Last</a></li>
						</ul>
					<?php } ?>
				</div>
		</div>
		<script type="text/javascript" src="../webroot/js/jquery.min.js" ></script>
		<script type="text/javascript" src="../webroot/js/popper.js" ></script>
		<script type="text/javascript" src="../webroot/js/bootstrap.min.js" ></script>
		<script type="text/javascript" src="../webroot/js/main.js" ></script>
		<script type="text/javascript" src="../webroot/js/employee/list.js" ></script>
	</body>
</html>