<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>assets/css/lib/bootstrap-datepicker-1.5.0.css">
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
        <div>
            <?php if(isset($companyEdit)) { ?>
                <ol class="breadcrumb mb-2 ml-4 w95">
                    <li class="breadcrumb-item"><i class="fa fa-building-o fa-btn mt3"></i><?php echo lang('lbl_company'); ?>
                        <span class ="dot editScrClr">&bull;</span><span class="editScrClr"><?php echo lang('lbl_edit'); ?></span>
                    </li>
                </ol>
            <?php } ?>
        </div>
        <div class="container mb-4">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="card shadow-lg border-0 rounded-lg mt-4">
                        <div class="card-header"><h3 class="text-center font-weight-light fs20"><?php if(isset($companyEdit)) { echo lang('lbl_companyEdit'); } else { echo lang('lbl_companyAdd'); } ?></h3></div>
                        <div class="card-body">
                            <!-- register and update company process -->
                            <?php if(isset($companyEdit)) { ?>
                                <!-- company edit process -->
                                <?php echo form_open('CompanyController/companyProfileUpdate',['method' => 'POST', 'class' => 'form-horizontal','id' => 'editForm','name' => 'editForm','enctype'=>'multipart/form-data']); ?>
                                <input type="hidden" id="hiddenCompanyId" name="hiddenCompanyId" value= "<?php echo $companyEdit->id; ?>" >
                            <?php } else { ?>
                                <!-- company add process -->
                                <?php echo form_open('CompanyController/companyProfileAddForm',['method' => 'POST', 'class' => 'form-horizontal','id' => 'addForm','name' => 'addForm','enctype'=>'multipart/form-data']); ?>
                            <?php } ?>
                                <input type="hidden" id="baseUrl" value="<?php echo base_url(); ?>">
                                <!-- company name -->
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_companyName', 'companyName', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <?php
                                            $data= array(
                                                'id' => 'companyName',
                                                'name' => 'companyName',
                                                'placeholder' => 'Enter Company Name',
                                                'class' => 'input_box col-md-12 form-control w43 h-25',
                                                'value' => isset($companyEdit) ? set_value("companyName", $companyEdit->companyName) : set_value("companyName")
                                            );
                                            echo form_input($data);
                                        ?>
                                    </div>
                                </div>
                                <!-- address -->
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_address', 'address', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col">
                                        <?php 
                                            $data = array(
                                                'id' => 'address',
                                                'name' => 'address',
                                                'placeholder' => 'Enter Address',
                                                'class' => 'form-control w43',
                                                'rows' => 3,
                                                'cols' => 46,
                                                'value' => isset($companyEdit) ? set_value("address", $companyEdit->address) : set_value("address")
                                            );
                                            echo form_textarea($data);
                                        ?>
                                    </div>
                                </div>
                                <!-- incharge -->
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_incharge', 'incharge', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <?php
                                            $data= array(
                                                'id' => 'incharge',
                                                'name' => 'incharge',
                                                'placeholder' => 'Enter Incharge Name',
                                                'class' => 'input_box col-md-12 form-control w43 h-25',
                                                'value' => isset($companyEdit) ? set_value("incharge", $companyEdit->incharge) : set_value("incharge")
                                            );
                                            echo form_input($data);
                                        ?>
                                    </div>
                                </div>
                                <!-- contact -->
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_contact', 'contact', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <?php 
                                            $data= array(
                                                'id' => 'contact',
                                                'name' => 'contact',
                                                'placeholder' => 'Enter Contact',
                                                'class' => 'input_box col-md-12 form-control w28 h-25',
                                                'value' => isset($companyEdit) ? set_value("contact", $companyEdit->contact) : set_value("contact")
                                            );
                                            echo form_input($data);
                                        ?>
                                    </div>
                                </div>
                                <!-- e-mail -->
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_email', 'email', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <?php
                                            $data= array(
                                                'id' => 'email',
                                                'name' => 'email',
                                                'placeholder' => 'Enter E-Mail Address',
                                                'class' => 'input_box col-md-12 form-control w40 h-25',
                                                'value' => isset($companyEdit) ? set_value("email", $companyEdit->email) : set_value("email")
                                            );
                                            echo form_input($data);
                                        ?>
                                    </div>
                                </div>
                                <!-- website -->
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_website', 'website', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <?php
                                            $data= array(
                                                'id' => 'website',
                                                'name' => 'website',
                                                'placeholder' => 'Enter Web Site',
                                                'class' => 'input_box col-md-12 form-control w43 h-25',
                                                'value' => isset($companyEdit) ? set_value("website", $companyEdit->website) : set_value("website")
                                            );
                                            echo form_input($data);
                                        ?>
                                    </div>
                                </div>
                                <!-- entry date -->
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_entryDate', 'entryDate', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="form-group col-md-8">
                                        <?php
                                            $data= array(
                                                'id' => 'entryDate',
                                                'name' => 'entryDate',
                                                'placeholder' => 'Enter Date',
                                                'class' => 'input_box form-control w23 h-25',
                                                'autocomplete' => 'off',
                                                'onclick' => '',
                                                'value' => isset($companyEdit) ? set_value("entryDate", $companyEdit->entryDate) : set_value("entryDate")
                                            );
                                            echo form_input($data);
                                        ?>
                                    </div>
                                </div>
                                <?php if(!isset($companyEdit)) { ?>
                                    <!-- password -->
                                    <div class="form-group form-inline">
                                        <?php echo lang('lbl_password', 'password', array('class' => 'col-md-4 control-label required')); ?>
                                        <div class="col-md-8">
                                            <?php 
                                                $data= array(
                                                    'id' => 'password',
                                                    'name' => 'password',
                                                    'placeholder' => 'Enter Password',
                                                    'class' => 'col-md-12 form-control w43 h-25',
                                                    'type' => 'password'
                                                );
                                                echo form_input($data);
                                            ?>
                                        </div>
                                    </div>
                                    <!-- confirm password -->
                                    <div class="form-group form-inline">
                                        <?php echo lang('lbl_conf_password', 'password_confirmation', array('class' => 'col-md-4 control-label required')); ?>
                                        <div class="col-md-8">
                                            <?php 
                                                $data= array(
                                                    'id' => 'password_confirmation',
                                                    'name' => 'password_confirmation',
                                                    'placeholder' => 'Enter Confirm Password',
                                                    'class' => 'col-md-12 form-control w43 h-25',
                                                    'type' => 'password'
                                                );
                                                echo form_input($data);
                                            ?>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="form-group">
                                    <div class="offset-md-4 col-md-6">
                                        <?php if(isset($companyEdit)) { ?>
                                            <!-- update button -->
                                            <button class="btn bg-warning text-white editprocess">
                                                <i class="fa fa-btn fa-edit"></i><?php echo lang('lbl_update'); ?>
                                            </button>
                                        <?php } else { ?>
                                            <!-- register button -->
                                            <button class="btn btn-success registerprocess">
                                                <i class="fa fa-btn fa-plus"></i><?php echo lang('lbl_register'); ?>
                                            </button>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php echo form_close();?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/lib/datepicker_jquery_1.9.1.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/lib/bootstrap_datepicker_1.5.0.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/company/profile/addEdit.js"></script>
    </body>
</html>