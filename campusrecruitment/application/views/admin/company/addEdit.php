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
        <div class="">
            <ol class="breadcrumb mb-2 ml-4 w95">
                <li class="breadcrumb-item"><i class="fa fa-user fa-btn mt3"></i><?php echo lang('lbl_company'); ?>
                    <?php if(isset($companyEditDetail)) { ?>
                        <span class ="dot editScrClr">&bull;</span><span class="editScrClr"><?php echo lang('lbl_edit'); ?></span>
                    <?php } else { ?>
                        <span class ="dot addScrClr">&bull;</span><span class="addScrClr"><?php echo lang('lbl_add'); ?></span>
                    <?php } ?>
                </li>
            </ol>
        </div>
        <div class="container mb-4">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="card shadow-lg border-0 rounded-lg mt-4">
                        <div class="card-header"><h3 class="text-center font-weight-light fs20"><?php if(isset($companyEditDetail)) { echo lang('lbl_companyEdit'); } else { echo lang('lbl_companyAdd'); } ?></h3></div>
                        <div class="card-body">
                            <!-- register and update company process -->
                            <?php if(isset($companyEditDetail)) { ?>
                            <!-- company edit process -->
                            <?php echo form_open('CompanyController/companyEditForm',['method' => 'POST', 'class' => 'form-horizontal','id' => 'editForm','name' => 'editForm','enctype'=>'multipart/form-data']); ?>
                            <input type="hidden" id="hiddenEmployeeId" name="hiddenEmployeeId" value= "{{ $employeeEditDetail->id }}" >
                        <?php } else { ?>
                            <!-- company add process -->
                            <?php echo form_open('CompanyController/companyAddForm',['method' => 'POST', 'class' => 'form-horizontal','id' => 'addForm','name' => 'addForm','enctype'=>'multipart/form-data']); ?>
                        <?php } ?>
                            <input type="hidden" id="base" value="<?php echo base_url(); ?>">
                                <!-- company name -->
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_companyName', 'companyName', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <?php
                                            $data= array(
                                                'id' => 'companyName',
                                                'name' => 'companyName',
                                                'placeholder' => 'Enter Company Name',
                                                'class' => 'input_box col-md-12 form-control w43 h-25'
                                            );
                                            echo form_input($data);
                                        ?>
                                        <div class="error">
                                            <?php echo form_error('companyName'); ?>
                                        </div>
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
                                                'cols' => 46
                                            );
                                            echo form_textarea($data);
                                        ?>
                                        <div class="error">
                                            <?php echo form_error('address'); ?>
                                        </div>
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
                                                'class' => 'input_box col-md-12 form-control w43 h-25'
                                            );
                                            echo form_input($data);
                                        ?>
                                        <div class="error">
                                            <?php echo form_error('incharge'); ?>
                                        </div>
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
                                                'class' => 'input_box col-md-12 form-control w30 h-25'
                                            );
                                            echo form_input($data);
                                        ?>
                                        <div class="error">
                                            <?php echo form_error('contact'); ?>
                                        </div>
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
                                                'class' => 'input_box col-md-12 form-control w43 h-25'
                                            );
                                            echo form_input($data);
                                        ?>
                                        <div class="error">
                                            <?php echo form_error('email'); ?>
                                        </div>
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
                                                'class' => 'input_box col-md-12 form-control w43 h-25'
                                            );
                                            echo form_input($data);
                                        ?>
                                        <div class="error">
                                            <?php echo form_error('website'); ?>
                                        </div>
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
                                                'onclick' => ''
                                            );
                                            echo form_input($data);
                                        ?>
                                </div>
                            </div>
                                <!-- register button -->
                                <div class="form-group">
                                    <div class="offset-md-4 col-md-6">
                                        <!-- register button -->
                                        <button class="btn btn-success registerprocess">
                                            <i class="fa fa-btn fa-plus"></i><?php echo lang('lbl_register'); ?>
                                        </button>
                                    </div>
                                </div>
                            <?php echo form_close();?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/admin/company/addEdit.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/lib/datepicker_jquery_1.9.1.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/lib/bootstrap_datepicker_1.5.0.js"></script>
    </body>
</html>