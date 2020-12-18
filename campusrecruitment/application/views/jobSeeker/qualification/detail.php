<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <style>
            a:hover {
                text-decoration: none !important;
            }
            /* flash message design */
            .fmsg {
                font-size: 14px;
                margin-left: 173px;
                width: 48%;
                margin-bottom: 0px;
                padding-top: 1px;
                padding-bottom: 1px;
            }
            .row {
                margin-right: 0rem !important;
            }
            .container-fluid {
                padding-right: 8px !important;
            }
        </style>
    </head>
    <body>
        <div>
            <ol class="breadcrumb mb-1 ml-4 w96">
                <li class="breadcrumb-item">
                    <i class="fa fa-morder-board fa-btn mt3"></i>
                    <?php echo $this->lang->line("lbl_qualification"); ?>
                    <span class ="dot detailScrClr">&bull;</span>
                    <span class="detailScrClr"><?php echo $this->lang->line("lbl_detail"); ?></span>
                </li>
                <?php if($this->session->flashdata('message')) { ?>
                    <div class="alert alert-<?php echo $this->session->flashdata('type'); ?> fmsg tac">
                        <?php echo $this->session->flashdata('message'); ?>
                    </div>
                <?php } ?>
            </ol>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="container-fluid">
                    <a class="btn btn-success mb-1" href="<?php echo site_url('JobSeekerController/jobSeekerQualificationAdd') ?>">
                        <i class="fa fa-btn fa-plus"></i><?php echo lang('lbl_qualificationAdd'); ?>
                    </a>
                    <?php echo form_open('JobSeekerController/jobSeekerQualificationEdit',['method' => 'POST','id' => 'detailForm','name' => 'detailForm']); ?>
                        <input type="hidden" id="base" value="<?php echo base_url(); ?>">
                        <input type="hidden" id="hiddenJobSeekerQualificationId" name="hiddenJobSeekerQualificationId">
                        <input type="hidden" id="hiddenDelFlag" name="hiddenDelFlag">
                        <input type="hidden" id="per_page" name="per_page">
                        <input type="hidden" id="hiddenSearch" name="hiddenSearch" value="<?php echo $this->input->post('hiddenSearch'); ?>">
                        <div>
                            <div>
                                <?php echo lang("lbl_jobSeekerId").": ";?><span class='teal'><?php echo $this->session->userdata('userName'); ?></span>
                            </div>
                        </div>
                        <table class="table table-bordered table-position">
                            <colgroup>
                                <col width="1%">
                                <col>
                                <col width="15%">
                            </colgroup>
                            <thead class="thead">
                                <tr>
                                    <th><?php echo lang('lbl_serialNumber'); ?></th>
                                    <th><?php echo lang('lbl_qualificationDetails'); ?></th>
                                    <th><?php echo lang('lbl_graduationYear'); ?></th>
                                </tr>
                            </thead>
                            <?php
                                if ($qualificationDetail != null) {
                                    foreach ($qualificationDetail as $key => $detail) {
                                        $class = $key % 2 === 0 ? 'odd' : 'even'; ?>
                                        <tr class="<php <?php echo $class; ?>">
                                            <td class="tac vam"><?php echo ($key+1); ?></td>
                                            <td class="vam">
                                                <div class="float-left">
                                                    <div><span class='teal'><?php echo lang("lbl_qualification").": ";?></span><a href="javascript:;" onclick="fnQualificationEdit(<?php echo $detail->id; ?>)"><?php echo $qualificationArray[$detail->qualification]; ?></a></div>
                                                    <div><span class='teal'><?php echo lang("lbl_collegeName").": ";?></span><?php echo $detail->collegeName; ?></div>
                                                    <div><span class='teal'><?php echo lang("lbl_specification").": ";?></span><?php echo $specificationArray[$detail->specification]; ?></div>
                                                    <div><span class='teal'><?php echo lang("lbl_university").": ";?></span><?php echo $universityArray[$detail->university]; ?></div>
                                                </div>
                                                <div class="ml50">
                                                    <div><span class='teal'><?php echo lang("lbl_branch").": ";?></span><?php echo $branchArray[$detail->branch]; ?></div>
                                                    <div><span class='teal'><?php echo lang("lbl_cgpa").": ";?></span><?php echo $detail->CGPA; ?></div>
                                                    <div><span class='teal'><?php echo lang("lbl_skill").": ";?></span><?php echo $detail->skill; ?></div>
                                                    <div><span class='teal'><?php echo lang("lbl_extraSkill").": ";?></span><?php echo $detail->extraSkill; ?></div>
                                                </div>
                                            </td>
                                            <td class="tac vam"><?php echo $detail->yearOfPassing." / ".$monthOfPassingArray[$detail->monthOfPassing]; ?></td>
                                        </tr>
                                    <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="3" class="tac noDataFoundClr fs16">No data found</td>
                                </tr>
                            <?php } ?>
                        </table>
                    <?php echo form_close();?>
                </div>
            </div>
            <!-- Render pagination links -->
            <div class="pagination" style="margin: auto;">
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </div>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jobSeeker/qualification/detail.js"></script>
    </body>
</html>
