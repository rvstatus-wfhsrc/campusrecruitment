<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            .errorMsg {
                color:#9C0000;
                font-size:14px;
                padding: 4px 0;
            }
            .errorMsg p {
                margin-bottom: 0px;
            }
            .container-fluid {
                width:85%;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6 border">
                    <div class="panel panel-default mt-4">
                        <div class="panel-body">
                            <?php if($this->session->flashdata('message')) { ?>
                                <div class="alert alert-<?php echo $this->session->flashdata('type'); ?> tac">
                                    <?php echo $this->session->flashdata('message'); ?>
                                </div>
                            <?php } ?>
                            <div class="text-center">
                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">
                                    <?php echo form_open('LoginController/resentLinkSend',['method' => 'POST','id' => 'passwordResetForm','name' => 'passwordResetForm']); ?>
                                    <input type="hidden" id="baseUrl" name="baseUrl" value="<?php echo base_url(); ?>">
                                    <?php
                                        $flag = $this->input->get('flag');
                                        if($this->input->post('flag') != ""){
                                            $flag = $this->input->post('flag');
                                        }
                                    ?>
                                    <input type="hidden" id="flag" name="flag" value="<?php echo $flag; ?>">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="glyphicon glyphicon-envelope color-blue"></i>
                                            </span>
                                                <?php echo lang('lbl_email', 'email', array('class' => 'col-md-4 control-label required')); ?>
                                                <div class="col-md-8">
                                                    <?php
                                                        $fileds = array(
                                                            'id' => 'email',
                                                            'name' => 'email',
                                                            'placeholder' => 'Enter E-Mail Address',
                                                            'class' => 'form-control',
                                                            'value' => set_value("email", set_value("email"))
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
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-primary">
                                            <i class="fa fa-btn fa-envelope"></i> Send Password Reset Link
                                        </button>
                                    </div>
                                    <?php echo form_close();?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
