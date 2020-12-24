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
                <li class="breadcrumb-item">
                    <i class="fa fa-briefcase fa-btn mt3"></i>
                    <?php echo lang('lbl_job'); ?>
                    <?php if(isset($jobEdit)) { ?>
                        <span class ="dot editScrClr">&bull;</span>
                        <span class="editScrClr"><?php echo lang('lbl_resultEdit'); ?></span>
                    <?php } else { ?>
                        <span class ="dot addScrClr">&bull;</span>
                        <span class="addScrClr"><?php echo lang('lbl_resultAdd'); ?></span>
                    <?php } ?>
                </li>
            </ol>
        </div>
        <div class="container mb-4">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="card shadow-lg border-0 rounded-lg mt-4">
                        <div class="card-header">
                            <h3 class="text-center font-weight-light fs20">
                                <?php 
                                    if(isset($jobEdit)) {
                                        echo lang('lbl_resultEdit');
                                    } else {
                                        echo lang('lbl_resultAdd');
                                    }
                                ?>
                            </h3>
                        </div>
                        <div class="card-body">
                            <?php if(isset($jobEdit)) { ?>
                                <!-- job edit process form -->
                                <?php echo form_open('JobController/jobResultEditForm',
                                    ['method' => 'POST', 'class' => 'form-horizontal','id' => 'editForm','name' => 'editForm']); ?>
                                <input type="hidden" id="screenFlag" name="screenFlag" value= "2" >
                            <?php } else { ?>
                                <!-- job add process form-->
                                <?php echo form_open('JobController/jobResultAddForm',
                                    ['method' => 'POST', 'class' => 'form-horizontal','id' => 'addForm','name' => 'addForm']); ?>
                                <input type="hidden" id="hiddenJobId" name="hiddenJobId" value= "<?php echo $jobResultAdd->jobId; ?>" >
                                <input type="hidden" id="hiddenCompanyId" name="hiddenCompanyId" value= "<?php echo $jobResultAdd->companyId; ?>" >
                                <input type="hidden" id="hiddenJobSeekerId" name="hiddenJobSeekerId" value= "<?php echo $jobResultAdd->jobSeekerId; ?>" >
                                <input type="hidden" id="screenFlag" name="screenFlag" value= "1" >
                            <?php } ?>
                                <input type="hidden" id="base" value="<?php echo base_url(); ?>">
                                <!-- company name -->
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_companyName', 'companyName', array('class' => 'col-md-4 control-label')); ?>
                                    <div class="col-md-8">
                                        <?php echo $jobResultAdd->companyName; ?>
                                    </div>
                                </div>
                                <!-- job seeker name -->
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_jobSeekerName', 'jobSeekerName', array('class' => 'col-md-4 control-label')); ?>
                                    <div class="col-md-8">
                                        <?php echo $jobResultAdd->jobSeekerName; ?>
                                    </div>
                                </div>
                                <!-- gender -->
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_gender', 'gender', array('class' => 'col-md-4 control-label')); ?>
                                    <div class="col-md-8">
                                        <?php echo $jobResultAdd->gender == 1? 'Male' : 'Female'; ?>
                                    </div>
                                </div>
                                <!-- job category -->
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_jobCategory', 'jobCategory', array('class' => 'col-md-4 control-label')); ?>
                                    <div class="col-md-8">
                                        <?php echo $jobResultAdd->jobCategory; ?>
                                    </div>
                                </div>
                                <!-- contact -->
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_contact', 'contact', array('class' => 'col-md-4 control-label')); ?>
                                    <div class="col-md-8">
                                        <?php echo $jobResultAdd->contact; ?>
                                    </div>
                                </div>
                                <!-- total mark -->
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_totalMark', 'totalMark', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <?php
                                            $fields = array(
                                                'id' => 'totalMark',
                                                'name' => 'totalMark',
                                                'placeholder' => 'Enter Total Mark',
                                                'class' => 'input_box col-md-12 form-control w43 h-25',
                                                'value' => set_value('totalMark',isset($jobEdit->totalMark) ? $jobEdit->totalMark : false)
                                            );
                                            echo form_input($fields);
                                        ?>
                                        <div class="error">
                                            <?php echo form_error('totalMark'); ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- obtain mark -->
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_obtainMark', 'obtainMark', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <?php
                                            $fields = array(
                                                'id' => 'obtainMark',
                                                'name' => 'obtainMark',
                                                'placeholder' => 'Enter Obtain Mark',
                                                'class' => 'input_box col-md-12 form-control w43 h-25',
                                                'value' => set_value('obtainMark',isset($jobEdit->obtainMark) ? $jobEdit->obtainMark : false)
                                            );
                                            echo form_input($fields);
                                        ?>
                                        <div class="error">
                                            <?php echo form_error('obtainMark'); ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- result status -->
                                <div class="form-group form-inline">
                                    <?php echo lang('lbl_resultStatus', 'resultStatus', array('class' => 'col-md-4 control-label required')); ?>
                                    <div class="col-md-8">
                                        <input type="radio" name="resultStatus" class="resultStatus" value="1" <?php echo set_value('resultStatus', isset($jobEdit->resultStatus) && $jobEdit->resultStatus == 1 ? "checked" : "") ?> />
                                        <span class = "pr20">Pass</span>
                                        <input type="radio" name="resultStatus" class="resultStatus" value="2" <?php echo set_value('resultStatus', isset($jobEdit->resultStatus) && $jobEdit->resultStatus == 2 ? "checked" : "") ?> />
                                        <span class="resultStatusError">Fail</span>
                                    </div>
                                </div>
                                <!-- add or edit button -->
                                <div class="form-group">
                                    <div class="offset-md-4 col-md-6">
                                        <?php if(isset($jobEdit)) { ?>
                                            <button class="btn bg-warning text-white addEditProcess">
                                                <i class="fa fa-btn fa-edit"></i>
                                                <?php echo lang('lbl_update'); ?>
                                            </button>
                                        <?php } else { ?>
                                            <button class="btn btn-success addEditProcess">
                                                <i class="fa fa-btn fa-plus"></i>
                                                <?php echo lang('lbl_addResult'); ?>
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
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/company/job/result/addEdit.js"></script>
    </body>
</html>