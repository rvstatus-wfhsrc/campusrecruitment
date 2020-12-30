<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Campus Recruitment System</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700"> -->
    <!-- Styles -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"> -->
    <!-- <link href="css/styles.css" rel="stylesheet" /> -->
    <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>assets/css/styles.css">
    <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>assets/css/lib/bootstrap-datepicker-1.5.0.css">
    <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>assets/css/common.css">
    <style>
        body {
            font-family: 'Lato';
        }
        .fa-btn {
            margin-right: 6px;
        }
        /* hide the link that should open and close the navbar on small screens */
        .navbar .topnavToggleIcon {
          display: none;
        }
        /* when the screen is less than 600 pixels wide, hide all links, except for the first one ("Home"). Show the link that contains should open and close the navbar (.icon) */
        @media screen and (max-width: 640px) {
          .navbar .responsiveUl {display: none;}
          .navbar .topnavToggleIcon {
            /*float: right;*/
            display: block;
          }
        }
        /* the "responsive" class is added to the navbar with JavaScript when the user clicks on the icon. This class makes the navbar look good on small screens (display the links vertically instead of horizontally) */
        @media screen and (max-width: 640px) {
            .navbar.responsive {
                position: relative;
                height: auto;
            }
            .navbar.responsive .topnavToggleIcon {
                position: absolute;
                right: 58px;
                top: 10px;
            }
            .navbar.responsive ul:last-child {
                position: absolute;
                right: 16px;
                top: 8px;
            }
            .navbar.responsive .responsiveUl {
                float: none;
                display: block;
                text-align: left;
                margin-left: 8px !important;
                margin-top: 25px;
            }
        }
        @media screen and (max-width: 767px) {
            .navbar-brand {
                position: absolute;
                top: 0;
            }
        }
    </style>
</head>
<body id="app-layout">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark" id="topnav">
        <?php if($this->session->userdata('logged_in') == true && $this->session->userdata('flag') == 1) { ?>
            <a class="navbar-brand" href="<?php echo site_url('AdminController/profile') ?>"><?php echo lang('lbl_admin'); ?></a>
        <?php } elseif ($this->session->userdata('logged_in') == true && $this->session->userdata('flag') == 2) { ?>
            <a class="navbar-brand" href="<?php echo site_url('CompanyController/companyDetail') ?>"><?php echo lang('lbl_company'); ?></a>
        <?php } elseif ($this->session->userdata('logged_in') == true && $this->session->userdata('flag') == 3) { ?>
            <a class="navbar-brand" href="<?php echo site_url('JobSeekerController/jobSeekerDetail') ?>"><?php echo lang('lbl_jobSeeker'); ?></a>
        <?php } else { ?>
            <a class="navbar-brand" style="width: auto;" href="<?php echo site_url('HomeController/index')?>"><?php echo lang('lbl_home'); ?></a>
            <?php } ?>
        <!-- Navbar-->
        <?php if($this->session->userdata('logged_in') == false) { ?>
            <ul class="navbar-nav ml-auto my-md-0 responsiveUl">
                <li class="nav-item <?php echo ($this->uri->segment(2)=='companyProfileAdd')?'active':''; ?>"><a class="nav-link" href="<?php echo site_url('CompanyController/companyProfileAdd')?>"><?php echo lang('lbl_newCompany'); ?></a></li>
                <li class="nav-item <?php echo (($this->uri->segment(2)=='CompanyLogin') || ($this->input->post('flag') == 2))?'active':''; ?>"><a class="nav-link" href="<?php echo site_url('LoginController/CompanyLogin') ?>"><?php echo lang('lbl_companyLogin'); ?></a></li>
                <li class="nav-item <?php echo ($this->uri->segment(2)=='jobSeekerProfileAdd')?'active':''; ?>"><a class="nav-link" href="<?php echo site_url('JobSeekerController/jobSeekerProfileAdd') ?>"><?php echo lang('lbl_newjobSeeker'); ?></a></li>
                <li class="nav-item <?php echo (($this->uri->segment(2)=='jobSeekerLogin') || ($this->input->post('flag') == 3))?'active':''; ?>"><a class="nav-link" href="<?php echo site_url('LoginController/jobSeekerLogin') ?>"><?php echo lang('lbl_jobSeekerLogin'); ?></a></li>
                <li class="nav-item <?php echo (($this->uri->segment(2)=='adminLogin') || ($this->input->post('flag') == 1))?'active':''; ?>"><a class="nav-link" href="<?php echo site_url('LoginController/adminLogin') ?>"><?php echo lang('lbl_adminLogin'); ?></a></li>
            </ul>
            <button class="btn btn-link order-1 order-lg-0 ml-auto topnavToggleIcon" id="topnavToggle"><i class="fa fa-bars"></i></button>
        <?php } else { ?>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fa fa-bars"></i></button>
            <ul class="navbar-nav ml-auto my-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?php echo site_url('LoginController/logout')?>">Logout</a>
                    </div>
                </li>
            </ul>
        <?php } ?>
        <!-- <div class="inb float-left ml-1">
            <?php echo form_dropdown('siteLang', $siteLang, '', 'class="form-control inb mr-2"');?>
        </div> -->
        <ul class="navbar-nav my-md-0 order-2 order-lg-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="langDropDown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-language" aria-hidden="true"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="langDropDown">
                    <?php foreach ($siteLangArry as $key => $siteLang) { ?>
                        <a class="dropdown-item siteLang <?php if($key == $this->session->userdata('siteLangKey')){ echo 'active'; } ?>" data-key="<?php echo $key; ?>" href=""><?php echo $siteLang; ?></a>
                    <?php } ?>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <?php if($this->session->userdata('logged_in') == true) { ?>
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <?php if($this->session->userdata('flag') == 1) { ?>
                                <div class="sb-sidenav-menu-heading">Home</div>
                                <a class="nav-link <?php echo ($this->uri->segment(1)=='HomeController')?'active':''; ?>" href="<?php echo site_url('HomeController/index') ?>">
                                    <div class="sb-nav-link-icon"><i class="fa fa-search" aria-hidden="true"></i></div>
                                    <?php echo lang('lbl_jobSearch'); ?>
                                </a>
                                <a class="nav-link <?php echo ($this->uri->segment(3)=='dashboard')?'active':''; ?>" href="<?php echo site_url('DashboardController/dashboard/dashboard') ?>">
                                    <div class="sb-nav-link-icon"><i class="fa fa-tachometer"></i></div>
                                    Dashboard
                                </a>
                                <a class="nav-link <?php echo ($this->uri->segment(1)=='AdminController')?'active':''; ?>" href="<?php echo site_url('AdminController/profile') ?>">
                                    <div class="sb-nav-link-icon"><i class="fa fa-user"></i></div>
                                    <?php echo lang('lbl_profile'); ?>
                                </a>
                                <div class="sb-sidenav-menu-heading">Settings</div>
                                <a class="nav-link <?php echo ($this->uri->segment(1)=='CompanyController')?'active':'collapsed'; ?>" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon"><i class="fa fa-building"></i></div>
                                    <?php echo lang('lbl_company'); ?>
                                    <div class="sb-sidenav-collapse-arrow"><i class="fa fa-angle-down"></i></div>
                                </a>
                                <div class="collapse <?php echo ($this->uri->segment(1)!=null && $this->uri->segment(1)=='CompanyController')?'show':''; ?>" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link <?php echo ($this->uri->segment(2)=='companyHistory')?'active':''; ?>" href="<?php echo site_url('CompanyController/companyHistory') ?>"><?php echo lang('lbl_history'); ?></a>
                                    </nav>
                                </div>
                            <?php } elseif ($this->session->userdata('flag') == 2) { ?>
                                <div class="sb-sidenav-menu-heading">Home</div>
                                <a class="nav-link <?php echo ($this->uri->segment(3)=='dashboard')?'active':''; ?>" href="<?php echo site_url('DashboardController/dashboard/dashboard') ?>">
                                    <div class="sb-nav-link-icon"><i class="fa fa-tachometer"></i></div>
                                    Dashboard
                                </a>
                                <a class="nav-link <?php echo ($this->uri->segment(2)=='companyDetail')?'active':''; ?>" href="<?php echo site_url('CompanyController/companyDetail') ?>">
                                    <div class="sb-nav-link-icon"><i class="fa fa-user"></i></div>
                                    <?php echo lang('lbl_profile'); ?>
                                </a>
                                <div class="sb-sidenav-menu-heading">Interface</div>
                                <a class="nav-link <?php echo ($this->uri->segment(1)=='JobController')?'active':'collapsed'; ?>" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon">
                                        <i class="fa fa-briefcase"></i>
                                    </div>
                                    <?php echo lang('lbl_job'); ?>
                                    <div class="sb-sidenav-collapse-arrow">
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                </a>
                                <div class="collapse <?php echo ($this->uri->segment(1)!=null && $this->uri->segment(1)=='JobController')?'show':''; ?>" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link <?php echo ($this->uri->segment(2)=='jobList')?'active':''; ?>" href="<?php echo site_url('JobController/jobList') ?>">
                                            <?php echo lang('lbl_list'); ?>
                                        </a>
                                        <a class="nav-link <?php echo ($this->uri->segment(2)=='jobApplyHistory')?'active':''; ?>" href="<?php echo site_url('JobController/jobApplyHistory') ?>">
                                            <?php echo lang('lbl_applyHistory'); ?>
                                        </a>
                                        <a class="nav-link <?php echo ($this->uri->segment(2)=='jobResultHistory')?'active':''; ?>" href="<?php echo site_url('JobController/jobResultHistory') ?>">
                                            <?php echo lang('lbl_resultHistory'); ?>
                                        </a>
                                    </nav>
                                </div>
                            <?php } else { ?>
                                <div class="sb-sidenav-menu-heading">Home</div>
                                <a class="nav-link <?php echo ($this->uri->segment(2)=='jobSeekerDetail')?'active':''; ?>" href="<?php echo site_url('JobSeekerController/jobSeekerDetail') ?>">
                                    <div class="sb-nav-link-icon"><i class="fa fa-user"></i></div>
                                    <?php echo lang('lbl_profile'); ?>
                                </a>
                                <div class="sb-sidenav-menu-heading">Education</div>
                                <a class="nav-link <?php echo ($this->uri->segment(2)=='jobSeekerQualificationDetail' || $this->uri->segment(2)=='jobSeekerQualificationAdd' || $this->uri->segment(2)=='jobSeekerQualificationEdit')?'active':'collapsed'; ?>" data-toggle="collapse" data-target="#collapseQualification" aria-expanded="false" aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon"><i class="fa fa-mortar-board"></i></div>
                                    <?php echo lang('lbl_qualification'); ?>
                                    <div class="sb-sidenav-collapse-arrow"><i class="fa fa-angle-down"></i></div>
                                </a>
                                <div class="collapse <?php echo ($this->uri->segment(2)=='jobSeekerQualificationDetail' || $this->uri->segment(2)=='jobSeekerQualificationAdd' || $this->uri->segment(2)=='jobSeekerQualificationEdit')?'show':''; ?>" id="collapseQualification" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link <?php echo ($this->uri->segment(2)=='jobSeekerQualificationDetail')?'active':''; ?>" href="<?php echo site_url('jobSeekerController/jobSeekerQualificationDetail') ?>"><?php echo lang('lbl_detail'); ?></a>
                                    </nav>
                                </div>
                                <div class="sb-sidenav-menu-heading">Interface</div>
                                <a class="nav-link <?php echo ($this->uri->segment(1)=='JobController')?'active':'collapsed'; ?>" data-toggle="collapse" data-target="#collapseJob" aria-expanded="false" aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon"><i class="fa fa-briefcase"></i></div>
                                    <?php echo lang('lbl_job'); ?>
                                    <div class="sb-sidenav-collapse-arrow"><i class="fa fa-angle-down"></i></div>
                                </a>
                                <div class="collapse <?php echo ($this->uri->segment(1)=='JobController')?'show':''; ?>" id="collapseJob" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link <?php echo ($this->uri->segment(2)=='jobLists')?'active':''; ?>" href="<?php echo site_url('JobController/jobLists') ?>"><?php echo lang('lbl_list'); ?></a>
                                        <a class="nav-link <?php echo ($this->uri->segment(2)=='jobApplyHistory')?'active':''; ?>" href="<?php echo site_url('JobController/jobApplyHistory') ?>"><?php echo lang('lbl_applyHistory'); ?></a>
                                        <a class="nav-link <?php echo ($this->uri->segment(2)=='jobResultHistory')?'active':''; ?>" href="<?php echo site_url('JobController/jobResultHistory') ?>"><?php echo lang('lbl_resultHistory'); ?></a>
                                    </nav>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as :</div>
                        <?php
                            if($this->session->userdata('flag') == 1 || $this->session->userdata('flag') == 3) {
                                echo $this->session->userdata('name').' ( '.$this->session->userdata('userName').' ) ';
                            } else if($this->session->userdata('flag') == 2) {
                                echo $this->session->userdata('name');
                            }
                        ?>
                    </div>
                </nav>
            </div>
       <?php } ?>
        <div id="layoutSidenav_content">
            <main class="mt-2">
            </main>
            <?=$content_for_layout?>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-center small">
                        <div class="text-muted">Copyright &copy; Campus Recruitment System 2020</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script> -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> -->
    <script type="text/javascript" src = "<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script type="text/javascript" src = "<?php echo base_url(); ?>assets/js/scripts.js"></script>
    <script type="text/javascript" src = "<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <!-- JavaScripts -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script> -->
</body>
</html>
