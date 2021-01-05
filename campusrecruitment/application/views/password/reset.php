<!DOCTYPE html>
<html>
<head>
    <style>
        h3 {
            font-size: 20px;
            margin-bottom: 0px;
        }
        label {
            justify-content: flex-end !important;
        }
        .errorMsg {
            color:#9C0000;
            font-size:13px;;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card shadow-lg border-0 rounded-lg mt-4">
                    <div class="card-header"><h3 class="text-center font-weight-light">Reset Password</h3></div>
                    <div class="card-body">
                        <?php echo form_open('LoginController/passwordResetForm',['method' => 'POST','id' => 'passwordResetForm','name' => 'passwordResetForm']); ?>
                            <input type="hidden" id="baseUrl" name="baseUrl" value="<?php echo base_url(); ?>">
                            <?php
                                $flag = $this->input->get('flag');
                                $email = $this->input->get('email');
                                $token = $this->input->get('token');
                                if($this->input->post('flag') != ""){
                                    $flag = $this->input->post('flag');
                                    $email = $this->input->post('email');
                                    $token = $this->input->post('token');
                                }
                            ?>
                            <input type="hidden" id="flag" name="flag" value="<?php echo $flag; ?>">
                            <input type="hidden" id="token" name="token" value="<?php echo $token; ?>">
                            <div class="form-group form-inline">
                                <?php echo lang('lbl_email', 'email', array('class' => 'col-md-4 control-label required')); ?>
                                <div class="col-md-8">
                                    <?php
                                        $fileds = array(
                                            'id' => 'email',
                                            'name' => 'email',
                                            'placeholder' => 'Enter E-Mail Address',
                                            'class' => 'form-control col-md-12 form-control w43 h-25',
                                            'disabled' => 'disabled',
                                            'value' => set_value("email", $email)
                                        );
                                        echo form_input($fileds);
                                    ?>
                                <?php if (form_error('email') != null || @$credentials_do_not_match != null ) {  ?>
                                    <div class="errorMsg float-left" style="margin-bottom: 0px;">
                                        <?php echo form_error('email'); ?>
                                        <?php echo @$credentials_do_not_match; ?>
                                    </div>
                                <?php } ?>
                                </div>
                            </div>
                            <div class="form-group form-inline">
                                <?php echo lang('lbl_password', 'password', array('class' => 'col-md-4 control-label required')); ?>
                                <div class="col-md-8">
                                    <?php 
                                         $data= array(
                                            'id' => 'password',
                                            'name' => 'password',
                                            'placeholder' => 'Enter Password',
                                            'class' => 'col-md-12 form-control w43 h-25',
                                            'type' => 'password',
                                            'value' => set_value("password", set_value("password"))
                                        );
                                        echo form_input($data);
                                    ?>
                                    <div class="error">
                                        <?php echo form_error('password'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-inline">
                                <?php echo lang('lbl_conf_password', 'password_confirmation', array('class' => 'col-md-4 control-label required')); ?>
                                <div class="col-md-8">
                                    <?php 
                                        $data= array(
                                            'id' => 'password_confirmation',
                                            'name' => 'password_confirmation',
                                            'placeholder' => 'Enter Confirm Password',
                                            'class' => 'col-md-12 form-control w43 h-25',
                                            'type' => 'password',
                                            'value' => set_value("password_confirmation", set_value("password_confirmation"))
                                        );
                                        echo form_input($data);
                                    ?>
                                    <div class="error">
                                        <?php echo form_error('password_confirmation'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="offset-md-4 col-md-6">
                                    <button type="submit" class="btn bg-primary text-white resetProcess">
                                        <i class="fa fa-btn fa-refresh"></i>Reset Password
                                    </button>
                                </div>
                            </div>
                        <?php echo form_close();?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.resetProcess').on('click', function() {
                $("#email").attr("disabled", false);
                $('#passwordResetForm').submit();
            });
        });
    </script>
</html>
