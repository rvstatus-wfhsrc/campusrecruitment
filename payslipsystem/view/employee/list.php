<!doctype html>
<html lang="en">
	<head>
		<title>Pay Slip | Employee List</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet"> -->	
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="../webroot/css/employee/style.css">
		<style>
			.thead {
			    text-align: center;
			    background: #7daedf;
			}
			.table-position {
			    font-family: 'Arial', sans-serif;
			    font-size: 15px;
			}
			.noDataFoundClr {
				color: red;
			}
			.tac {
				text-align: center;
			}
		</style>
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
	      	<div id="content" class="p-4 p-md-5 pt-5">
	        	<h2 class="mb-4">Employee List</h2>
	        	<table class="table table-bordered table-position">
                            <colgroup>
                                <col width="1%">
                                <col>
                                <col width="12%">
                                <col width="15%">
                                <col width="9%">
                                <col width="12%">
                                <col width="9%">
                                <col width="11%">
                            </colgroup>
                            <thead class="thead">
                                <tr>
                                    <th>S.No.</th>
                                    <th>Name</th>
                                    <th>Employee Id</th>
                                    <th>Designation</th>
                                    <th>Gender</th>
                                    <th title="Date Of Joining">DOJ</th>
                                    <th>Experience</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <?php if (isset($employeeList)) { ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="8" class="tac noDataFoundClr">No data found</td>
                                </tr>
                            <?php } ?>
                        </table>
	      	</div>
		</div>
		<script type="text/javascript" src="../webroot/js/jquery.min.js" ></script>
		<script type="text/javascript" src="../webroot/js/employee/popper.js" ></script>
		<script type="text/javascript" src="../webroot/js/employee/bootstrap.min.js" ></script>
		<script type="text/javascript" src="../webroot/js/employee/main.js" ></script>
	</body>
</html>