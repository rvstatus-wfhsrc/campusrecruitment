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
        <div>
            <ol class="breadcrumb mb-2 ml-4 w95">
                <li class="breadcrumb-item"><i class="fa fa-mortar-board fa-btn mt3"></i><?php echo lang('lbl_qualification'); ?>
                    <?php if(isset($qualificationEdit)) { ?>
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
                        <div class="card-header"><h3 class="text-center font-weight-light fs20"><?php if(isset($qualificationEdit)) { echo lang('lbl_qualificationEdit'); } else { echo lang('lbl_qualificationAdd'); } ?></h3></div>
                        <div class="card-body">
                            <!-- register and update qualification process -->
                            <?php if(isset($qualificationEdit)) { ?>
                                <!-- qualification edit process -->
                                <?php echo form_open('JobSeekerController/jobSeekerQualificationUpdate',['method' => 'POST', 'class' => 'form-horizontal','id' => 'editForm','name' => 'editForm','enctype'=>'multipart/form-data']); ?>
                                <input type="hidden" id="hiddenJobSeekerQualificationId" name="hiddenJobSeekerQualificationId" value= "<?php echo $qualificationEdit->id; ?>" >
                                <input type="hidden" id="screenFlag" name="screenFlag" value= "2" >
                            <?php } else { ?>
                                <!-- qualification add process -->
                                <?php echo form_open('JobSeekerController/jobSeekerQualificationAddForm',['method' => 'POST', 'class' => 'form-horizontal','id' => 'addForm','name' => 'addForm','enctype'=>'multipart/form-data']); ?>
                            <?php } ?>
                            <input type="hidden" id="screenFlag" name="screenFlag" value= "1" >
                                <input type="hidden" id="baseUrl" value="<?php echo base_url(); ?>">
                                <!-- tenth mark -->
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_tenthMark', 'tenthMark', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <?php
                                            $data= array(
                                                'id' => 'tenthMark',
                                                'name' => 'tenthMark',
                                                'placeholder' => 'Tenth Percentage',
                                                'class' => 'input_box col-md-12 form-control w37 h-25 tenthMark',
                                                'value' => isset($qualificationEdit) ? set_value("tenthMark", $qualificationEdit->tenthMark) : set_value("tenthMark")
                                            );
                                            echo form_input($data);
                                        ?>
                                        <span class="tenthMarkError">%</span>
                                    </div>
                                </div>
                                <!-- twelveth mark -->
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_twelvethMark', 'twelvethMark', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <?php
                                            $data= array(
                                                'id' => 'twelvethMark',
                                                'name' => 'twelvethMark',
                                                'placeholder' => 'Twelveth Percentage',
                                                'class' => 'input_box col-md-12 form-control w37 h-25 twelvethMark',
                                                'value' => isset($qualificationEdit) ? set_value("twelvethMark", $qualificationEdit->twelvethMark) : set_value("twelvethMark")
                                            );
                                            echo form_input($data);
                                        ?>
                                        <span class="twelvethMarkError">%</span>
                                    </div>
                                </div>
                                <!-- specification -->
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_specification', 'specification', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <?php
                                            $fields = array (
                                                'id' => 'specification',
                                                'name' => 'specification',
                                                'class' => 'form-control autowidth h-25'
                                            );
                                            echo form_dropdown('specification', $specificationArray,set_value('specification', isset($qualificationEdit->specification) ? $qualificationEdit->specification : false),$fields);
                                        ?>
                                        <div class="error">
                                            <?php echo form_error('specification'); ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- qualification -->
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_qualification', 'qualification', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <?php
                                            $fields = array (
                                                'id' => 'qualification',
                                                'name' => 'qualification',
                                                'class' => 'form-control autowidth h-25'
                                            );
                                            echo form_dropdown('qualification', $qualificationArray,set_value('qualification', isset($qualificationEdit->qualification) ? $qualificationEdit->qualification : false),$fields);
                                        ?>
                                        <div class="error">
                                            <?php echo form_error('qualification'); ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- year of passing -->
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_yearOfPassing', 'yearOfPassing', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <?php
                                            $fields = array (
                                                'id' => 'yearOfPassing',
                                                'name' => 'yearOfPassing',
                                                'class' => 'form-control autowidth h-25'
                                            );
                                            echo form_dropdown('yearOfPassing', $yearOfPassingArray,set_value('yearOfPassing', isset($qualificationEdit->yearOfPassing) ? $qualificationEdit->yearOfPassing : false),$fields);
                                        ?>
                                        <div class="error">
                                            <?php echo form_error('yearOfPassing'); ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- month of passing -->
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_monthOfPassing', 'monthOfPassing', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <?php
                                            $fields = array (
                                                'id' => 'monthOfPassing',
                                                'name' => 'monthOfPassing',
                                                'class' => 'form-control autowidth h-25'
                                            );
                                            echo form_dropdown('monthOfPassing', $monthOfPassingArray,set_value('monthOfPassing', isset($qualificationEdit->monthOfPassing) ? $qualificationEdit->monthOfPassing : false),$fields);
                                        ?>
                                        <div class="error">
                                            <?php echo form_error('monthOfPassing'); ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- college name -->
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_collegeName', 'collegeName', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <?php
                                            $data= array(
                                                'id' => 'collegeName',
                                                'name' => 'collegeName',
                                                'placeholder' => 'Enter College Name',
                                                'class' => 'input_box col-md-12 form-control w52 h-25',
                                                'value' => isset($qualificationEdit) ? set_value("collegeName", $qualificationEdit->collegeName) : set_value("collegeName")
                                            );
                                            echo form_input($data);
                                        ?>
                                        <div class="error">
                                            <?php echo form_error('collegeName'); ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- branch -->
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_branch', 'branch', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <?php
                                            $fields = array (
                                                'id' => 'branch',
                                                'name' => 'branch',
                                                'class' => 'form-control autowidth h-25'
                                            );
                                            echo form_dropdown('branch', $branchArray,set_value('branch', isset($qualificationEdit->branch) ? $qualificationEdit->branch : false),$fields);
                                        ?>
                                        <div class="error">
                                            <?php echo form_error('branch'); ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- university -->
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_university', 'university', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <?php
                                            $fields = array (
                                                'id' => 'university',
                                                'name' => 'university',
                                                'class' => 'form-control autowidth h-25'
                                            );
                                            echo form_dropdown('university', $universityArray,set_value('university', isset($qualificationEdit->university) ? $qualificationEdit->university : false),$fields);
                                        ?>
                                        <div class="error">
                                            <?php echo form_error('university'); ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- CGPA -->
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_cgpa', 'cgpa', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <?php
                                            $data= array(
                                                'id' => 'cgpa',
                                                'name' => 'cgpa',
                                                'placeholder' => 'Enter CGPA',
                                                'class' => 'input_box col-md-12 form-control w25 h-25',
                                                'value' => isset($qualificationEdit) ? set_value("cgpa", $qualificationEdit->CGPA) : set_value("cgpa")
                                            );
                                            echo form_input($data);
                                        ?>
                                        <div class="error">
                                            <?php echo form_error('cgpa'); ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- skill -->
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_skill', 'skill', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <?php
                                            $fields = array (
                                                'id' => 'skill',
                                                'name' => 'skill',
                                                'class' => 'form-control autowidth h-25'
                                            );
                                            echo form_dropdown('skill', $skillArray,set_value('skill', isset($qualificationEdit->skill) ? $qualificationEdit->skill : false),$fields);
                                        ?>
                                        <div class="error">
                                            <?php echo form_error('skill'); ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- extra skill -->
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_extraSkill', 'extraSkill', array('class' => 'col-md-4 control-label')); ?>
                                    <div class="col-md-8">
                                        <?php
                                            $fields = array(
                                                'id' => 'extraSkill',
                                                'name' => 'extraSkill',
                                                'placeholder' => 'Enter Extra Skill',
                                                'class' => 'input_box col-md-12 form-control w43 h-25',
                                                'value' => set_value('extraSkill',isset($qualificationEdit->extraSkill) ? $qualificationEdit->extraSkill : false)
                                            );
                                            echo form_input($fields);
                                        ?>
                                        <div class="error">
                                            <?php echo form_error('extraSkill'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="offset-md-4 col-md-6">
                                        <?php if(isset($qualificationEdit)) { ?>
                                            <!-- update button -->
                                            <button class="btn bg-warning text-white addEditProcess">
                                                <i class="fa fa-btn fa-edit"></i><?php echo lang('lbl_update'); ?>
                                            </button>
                                        <?php } else { ?>
                                            <!-- register button -->
                                            <button class="btn btn-success addEditProcess">
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
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jobSeeker/qualification/addEdit.js"></script>
    </body>
</html>