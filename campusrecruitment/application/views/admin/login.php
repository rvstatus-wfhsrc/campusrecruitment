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
            /* margin-left: 0px; is need for mobile view style at logout */
            @media (max-width: 840px) {
                #layoutSidenav #layoutSidenav_content {
                    margin-left: 0;
                }
            }
            @media (max-width: 750px) {
                .sm-w70 {
                    width: 70% !important;
                }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="card shadow-lg border-0 rounded-lg mt-4">
                        <?php if($this->session->flashdata('message')) { ?>
                            <div class="alert alert-<?php echo $this->session->flashdata('type'); ?> tac" style = "margin-bottom : 0px; padding: 0.2rem 1.25rem;">
                                <?php echo $this->session->flashdata('message'); ?>
                            </div>
                        <?php } ?>
                        <div class="card-header">
                            <h3 class="text-center font-weight-light fs20"><?php echo lang('lbl_adminLogin'); ?></h3>
                        </div>
                        <div class="card-body">
                            <?php echo form_open('LoginController/loginUser',
                                ['method' => 'POST','class' => 'form-horizontal','id' => 'loginForm','name' => 'loginForm']); ?>
                                <input type="hidden" id="baseUrl" name="baseUrl" value="<?php echo base_url(); ?>">
                                <input type="hidden" id="flag" name="flag" value="1">
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_userName', 'adminUserName', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                		<?php
                                            $fields = array(
                                        		    'id' => 'adminUserName',
            										'name' => 'adminUserName',
            										'placeholder' => 'Enter User Name',
            										'class' => 'input_box col-md-12 form-control sm-w70 w43 h-25',
                                                    'value' => set_value('adminUserName','')
            								);
    										echo form_input($fields);
                                        ?>
                                        <div class="error">
                                            <?php echo form_error('adminUserName'); ?>
                                            <?php echo @$adminLoginError; ?>
                                        </div>   
                                    </div>
                                </div>
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_password', 'adminPassword', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <?php
                                            $fields= array(
            										'type' => 'password',
            										'id' => 'adminPassword',
            										'name' => 'adminPassword',
            										'placeholder' => 'Enter Password',
            										'class' => 'input_box col-md-12 form-control sm-w70 w43 h-25',
                                                    'value' => set_value('adminPassword','')
    										);
    										echo form_input($fields);
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
                                	<div class="offset-md-4 col-md-6">
                                        <button class="btn bg-warning text-white">
                                            <i class="fa fa-btn fa-sign-in"></i><?php echo lang('lbl_login'); ?>
                                        </button>
                                        <a class="btn btn-link" href="javascript:;" onclick="getResetPasswordLink()"><?php echo lang('lbl_forgetYourPassword'); ?></a>
                                    </div>
                                </div>
                        	<?php echo form_close();?>
                        </div>
                        <div class="card-footer text-center">
                            <!-- <div class="small">
                                <a href="<?php echo site_url('AdminController/register') ?>">Need an account ? Sign up!</a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
        <script type="text/javascript">
            function getResetPasswordLink() {
                $("#flag").val($("#flag").val());
                $("#loginForm").attr("action", "getResetPasswordLink");
                $("#loginForm").submit();
            }
        </script>
    </body>
</html>