<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <style>
            h3 {
                font-size: 20px;
                margin-bottom: 0px;
            }
            label {
                justify-content: flex-end !important;
            }
        </style>
    </head>
    <body>
        <div class="container" style="max-width: 100% !important;">
            <?php echo form_open('LoginController/index',['method' => 'POST','class' => 'form-horizontal','id' => 'loginForm','name' => 'loginForm']); ?>
                <input type="hiddden" id="base" name="base" value="<?php echo base_url(); ?>">
                <input type="hiddden" id="flag" name="flag">

                <div class="row" style="border: 1px solid black;">
                    <div class="col-sm-4">
                        <div class="card shadow-lg border-0 rounded-lg mt-4 mb-4">
                            <div class="card-header"><h3 class="text-center">Job Seeker Login</h3></div>
                            <div class="card-body" style="padding-right: 0px; padding-left: 0px;">
                                <!-- login process -->
                                <?php // echo form_open('LoginController/loginUser',['method' => 'POST','class' => 'form-horizontal','id' => 'loginForm','name' => 'loginForm']); ?>
                                    <!-- user name -->
                                    <div class="form-group form-inline">
                                        <?php echo lang('lbl_userName', 'jobSeekerUserName', array('class' => 'col-md-4 control-label required')); ?>
                                        <div class="col-md-8">
                                            <?php
                                                $data = array(
                                                        'id' => 'jobSeekerUserName',
                                                        'name' => 'jobSeekerUserName',
                                                        'placeholder' => 'Enter User Name',
                                                        'class' => 'input_box col-md-12 form-control w60 h-25',
                                                        'value' => set_value('jobSeekerUserName','')
                                                );
                                                echo form_input($data);
                                            ?>
                                            <div class="error">
                                                <?php echo form_error('jobSeekerUserName'); ?>
                                                <?php echo @$jobSeekerLoginError; ?>
                                            </div>   
                                        </div>
                                    </div>
                                    <!-- password -->
                                    <div class="form-group form-inline">
                                        <?php echo lang('lbl_password', 'jobSeekerPassword', array('class' => 'col-md-4 control-label required')); ?>
                                        <div class="col-md-8">
                                            <?php
                                                $data= array(
                                                        'type' => 'password',
                                                        'id' => 'jobSeekerPassword',
                                                        'name' => 'jobSeekerPassword',
                                                        'placeholder' => 'Enter Password',
                                                        'class' => 'input_box col-md-12 form-control w60 h-25',
                                                        'value' => set_value('jobSeekerPassword','')
                                                );
                                                echo form_input($data);
                                            ?>
                                            <div class="error">
                                                <?php echo form_error('jobSeekerPassword');?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- remember password -->
                                    <!-- <div class="form-group">
                                        <div class="offset-md-4 col-md-6">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                                <?php echo form_label('Remember password','rememberPasswordCheck',['class' => "custom-control-label",'id' => "rememberPasswordCheck",'name' => "rememberPasswordCheck"]); ?>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- login button -->
                                    <div class="form-group">
                                        <div class="offset-md-4 col-md-7">
                                            <button class="btn bg-warning text-white jobSeekerLogin">
                                                <i class="fa fa-btn fa-sign-in"></i>Login
                                            </button>
                                            <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password ?</a>
                                        </div>
                                    </div>
                                <?php // echo form_close();?>
                            </div>
                            <div class="card-footer text-center">
                                <div class="small"><a href="<?php echo site_url('JobSeekerController/jobSeekerRegister') ?>">Are you new job seeker ? Sign up!</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card shadow-lg border-0 rounded-lg mt-4 mb-4">
                            <div class="card-header"><h3 class="text-center">Company Login</h3></div>
                            <div class="card-body" style="padding-right: 0px; padding-left: 0px;">
                                <!-- login process -->
                                <?php // echo form_open('LoginController/loginUser',['method' => 'POST','class' => 'form-horizontal','id' => 'loginForm','name' => 'loginForm']); ?>
                                    <!-- user name -->
                                    <div class="form-group form-inline">
                                        <?php echo lang('lbl_userName', 'companyUserName', array('class' => 'col-md-4 control-label required')); ?>
                                        <div class="col-md-8">
                                            <?php
                                                $data = array(
                                                        'id' => 'companyUserName',
                                                        'name' => 'companyUserName',
                                                        'placeholder' => 'Enter User Name',
                                                        'class' => 'input_box col-md-12 form-control w60 h-25',
                                                        'value' => set_value('companyUserName','')
                                                );
                                                echo form_input($data);
                                            ?>
                                            <div class="error">
                                                <?php echo form_error('companyUserName'); ?>
                                                <?php echo @$companyLoginError; ?>
                                            </div>   
                                        </div>
                                    </div>
                                    <!-- password -->
                                    <div class="form-group form-inline">
                                        <?php echo lang('lbl_password', 'companyPassword', array('class' => 'col-md-4 control-label required')); ?>
                                        <div class="col-md-8">
                                            <?php
                                                $data= array(
                                                        'type' => 'password',
                                                        'id' => 'companyPassword',
                                                        'name' => 'companyPassword',
                                                        'placeholder' => 'Enter Password',
                                                        'class' => 'input_box col-md-12 form-control w60 h-25',
                                                        'value' => set_value('companyPassword','')
                                                );
                                                echo form_input($data);
                                            ?>
                                            <div class="error">
                                                <?php echo form_error('companyPassword'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- remember password -->
                                    <!-- <div class="form-group">
                                        <div class="offset-md-4 col-md-6">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                                <?php echo form_label('Remember password','rememberPasswordCheck',['class' => "custom-control-label",'id' => "rememberPasswordCheck",'name' => "rememberPasswordCheck"]); ?>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- login button -->
                                    <div class="form-group">
                                        <div class="offset-md-4 col-md-7">
                                            <button class="btn bg-warning text-white companyLogin">
                                                <i class="fa fa-btn fa-sign-in"></i>Login
                                            </button>
                                            <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password ?</a>
                                        </div>
                                    </div>
                                    <!-- <input type="hidden" id="base" name="base" value="<?php echo base_url(); ?>"> -->
                                    <!-- <input type="hidden" id="flag" name="flag" value="<?php echo $flag; ?>"> -->
                                <?php // echo form_close();?>
                            </div>
                            <div class="card-footer text-center">
                                <div class="small"><a href="<?php echo site_url('CompanyController/companyProfileAdd') ?>">Are you new Company ? Sign up!</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card shadow-lg border-0 rounded-lg mt-4 mb-4">
                            <div class="card-header"><h3 class="text-center">Admin Login</h3></div>
                            <div class="card-body" style="padding-right: 0px; padding-left: 0px;">
                                <!-- login process -->
                                <?php // echo form_open('LoginController/loginUser',['method' => 'POST','class' => 'form-horizontal','id' => 'loginForm','name' => 'loginForm']); ?>
                                    <!-- user name -->
                                    <div class="form-group form-inline">
                                        <?php echo lang('lbl_userName', 'adminUserName', array('class' => 'col-md-4 control-label required')); ?>
                                        <div class="col-md-8">
                                            <?php
                                                $data = array(
                                                        'id' => 'adminUserName',
                                                        'name' => 'adminUserName',
                                                        'placeholder' => 'Enter User Name',
                                                        'class' => 'input_box col-md-12 form-control w60 h-25',
                                                        'value' => set_value('adminUserName','')
                                                );
                                                echo form_input($data);
                                            ?>
                                            <div class="error">
                                                <?php echo form_error('adminUserName'); ?>
                                                <?php echo @$adminLoginError; ?>
                                            </div>   
                                        </div>
                                    </div>
                                    <!-- password -->
                                    <div class="form-group form-inline">
                                        <?php echo lang('lbl_password', 'adminPassword', array('class' => 'col-md-4 control-label required')); ?>
                                        <div class="col-md-8">
                                            <?php
                                                $data= array(
                                                        'type' => 'password',
                                                        'id' => 'adminPassword',
                                                        'name' => 'adminPassword',
                                                        'placeholder' => 'Enter Password',
                                                        'class' => 'input_box col-md-12 form-control w60 h-25',
                                                        'value' => set_value('adminPassword','')
                                                );
                                                echo form_input($data);
                                            ?>
                                            <div class="error">
                                                <?php echo form_error('adminPassword'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- remember password -->
                                    <!-- <div class="form-group">
                                        <div class="offset-md-4 col-md-6">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                                <?php echo form_label('Remember password','rememberPasswordCheck',['class' => "custom-control-label",'id' => "rememberPasswordCheck",'name' => "rememberPasswordCheck"]); ?>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- login button -->
                                    <div class="form-group">
                                        <div class="offset-md-4 col-md-7">
                                            <button class="btn bg-warning text-white adminLogin">
                                                <i class="fa fa-btn fa-sign-in"></i>Login
                                            </button>
                                            <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password ?</a>
                                        </div>
                                    </div>

                                    <!-- <input type="hidden" id="base" name="base" value="<?php echo base_url(); ?>"> -->
                                    <!-- <input type="hidden" id="flag" name="flag" value="<?php echo $flag; ?>"> -->
                                <?php // echo form_close();?>
                            </div>
                            <div class="card-footer text-center">
                               <!--  <div class="small">
                                    <a href="<?php echo site_url('LoginController/register') ?>">Add New Company</a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                            Here job Serach Process Perform under construction
                    </div>
                </div>
            <?php echo form_close();?>
        </div>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/login/login.js"></script>
    </body>
</html>