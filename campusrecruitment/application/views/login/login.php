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
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="card shadow-lg border-0 rounded-lg mt-4">
                        <div class="card-header"><h3 class="text-center font-weight-light fs20">Login</h3></div>
                        <div class="card-body">
      						<!-- login process -->
                            <?php echo form_open('LoginController/loginUser',['method' => 'POST','class' => 'form-horizontal','id' => 'loginForm','name' => 'loginForm']); ?>
                                <!-- user name -->
                                <div class="form-group form-inline">
                                    <?php echo form_label('User Name','userName',['class' => "col-md-4 control-label required"]); ?>
                                    <div class="col-md-8">
                                		<?php
                                            $data = array(
                                        		    'id' => 'userName',
            										'name' => 'userName',
            										'placeholder' => 'Enter User Name',
            										'class' => 'input_box col-md-12 form-control w43 h-25'
            								);
    										echo form_input($data);
                                        ?>
                                        <div class="error">
                                            <?php echo form_error('userName'); ?>
                                            <?php echo @$error; ?>
                                        </div>   
                                    </div>
                                </div>
                                <!-- password -->
                                <div class="form-group form-inline">
                                    <?php echo form_label('Password','password',['class' => "col-md-4 control-label required"]); ?>
                                    <div class="col-md-8">
                                        <?php
                                            $data= array(
            										'type' => 'password',
            										'id' => 'password',
            										'name' => 'password',
            										'placeholder' => 'Enter Password',
            										'class' => 'input_box col-md-12 form-control w43 h-25'
    										);
    										echo form_input($data);
                                        ?>
                                        <div class="error">
                                            <?php echo form_error('password'); ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- remember password -->
                                <div class="form-group">
                                    <div class="offset-md-4 col-md-6">
                                       	<div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                            <?php echo form_label('Remember password','rememberPasswordCheck',['class' => "custom-control-label",'id' => "rememberPasswordCheck",'name' => "rememberPasswordCheck"]); ?>
                                        </div>
                                    </div>
                                </div>
                            	<!-- login button -->
                                <div class="form-group">
                                	<div class="offset-md-4 col-md-6">
    									<?php
    										// $data = array(
    										// 		'type' => 'submit',
    										// 		'value'=> 'Login',
    										// 		'class'=> 'submit btn bg-warning text-white'
    										// 		);
    										// echo form_submit($data);
    									?>
                                        <button class="btn bg-warning text-white">
                                            <i class="fa fa-btn fa-sign-in"></i>Login
                                        </button>
                                        <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password ?</a>
                                    </div>
                                </div>
                        	<?php echo form_close();?>
                        </div>
                        <div class="card-footer text-center">
                            <div class="small"><a href="<?php echo site_url('AdminController/register') ?>">Need an account ? Sign up!</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="{{ URL::asset('resources/assets/js/jquery.min.js') }}"></script>
    </body>
</html>