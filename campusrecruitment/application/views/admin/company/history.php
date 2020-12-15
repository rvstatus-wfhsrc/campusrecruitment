<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <style>
            a:hover {
                text-decoration: none !important;
            }
            /*Flash message design*/
            .fmsg{
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
        <div class="dispNone">
            <ol class="breadcrumb mb-1 ml-4 w96">
                <li class="breadcrumb-item"><i class="fa fa-building-o fa-btn mt3"></i><?php echo lang('lbl_company'); ?><span class ="dot historyScrClr">&bull;</span><span class="historyScrClr"><?php echo lang('lbl_history'); ?></span></li>
               <?php if($this->session->flashdata('message')) { ?>
                    <div class="alert alert-<?php echo $this->session->flashdata('type'); ?> fmsg tac"><?php echo $this->session->flashdata('message'); ?> </div>
                <?php } ?>
            </ol>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="container-fluid dispNone">
                    <a class="btn btn-success mb-1" href="<?php echo site_url('CompanyController/companyAdd') ?>">
                        <i class="fa fa-btn fa-plus"></i><?php echo lang('lbl_addCompany'); ?>
                    </a>
                    <?php echo form_open('CompanyController/CompanyDetail',['method' => 'POST','id' => 'historyForm','name' => 'historyForm']); ?>
                        <input type="hidden" id="base" value="<?php echo base_url(); ?>">
                        <input type="hidden" id="hiddenCompanyId" name="hiddenCompanyId">
                        <input type="hidden" id="hiddenDelFlag" name="hiddenDelFlag">
                        <input type="hidden" id="per_page" name="per_page">
                        <input type="hidden" id="hiddenSearch" name="hiddenSearch" value="<?php echo $this->input->post('hiddenSearch'); ?>">
                        <!-- filtering process -->
                        <div class="inb fs16 float-left w54">
                            <a href="javascript:;" onclick="fnCompanyFilter(1)" id="filterVal1" class="fs16 btn btn-link <?php echo $disableAll ?>"><?php echo lang('lbl_all'); ?></a>
                            <span> | </span>
                            <a href="javascript:;" onclick="fnCompanyFilter(2)" id="filterVal2" class="fs16 btn btn-link <?php echo $disableActive ?>"><?php echo lang('lbl_active'); ?></a>
                            <span> | </span>
                            <a href="javascript:;" onclick="fnCompanyFilter(3)" id="filterVal3" class="fs16 btn btn-link <?php echo $disableNonActive ?>"><?php echo lang('lbl_deactive'); ?></a>
                        </div>
                        <input type="hidden" id="filterVal" name="filterVal" value="<?php echo $this->input->post('filterVal'); ?>">
                        <!-- clear search -->
                        <div  class="inb float-left mt-1 w3">
                          <a href="javascript:;" onclick="fnClearSearch()"><img style="width: 25px;" src="<?php echo base_url(); ?>assets/images/clearsearch.png" title="Clear Search"></a>
                        </div>
                        <!-- sorting process -->
                        <div class="inb float-left">
                            <?php
                                $data= array (
                                    'id' => 'sortProcess',
                                    'name' => 'sortProcess',
                                    'class' => 'form-control autowidth h34 inb mr-2 CMN_sorting '.$sortStyle,
                                );
                                echo form_dropdown('sortProcess',$sortArray,set_value('sortProcess', 1, false),$data);
                            ?>
                            <input type="hidden" id="sortVal" name="sortVal" value="<?php echo $this->input->post('sortVal'); ?>">
                            <input type="hidden" id="sortOptn" name="sortOptn" value="<?php echo $this->input->post('sortOptn'); ?>">
                        </div>
                        <!-- searching process -->
                        <div class="input-group searchBtn">
                            <?php
                                $data= array(
                                    'id' => 'search',
                                    'name' => 'search',
                                    'placeholder' => 'Search Company Name',
                                    'class' => 'input_box form-control h34',
                                    'value' =>  $this->input->post('hiddenSearch')
                                );
                                echo form_input($data);
                            ?>
                            <div class="input-group-append">
                                <a class="btn btn-secondary h34" href="javascript:;" onclick="fnCompanySearch()">
                                    <i class="fa fa-search" title = "Search"></i>
                                </a>
                            </div>
                        </div>
                        <table class="table table-bordered table-position">
                            <colgroup>
                                <col width="1%">
                                <col>
                                <col width="12%">
                                <col width="8%">
                                <col width="15%">
                                <col width="10%">
                                <col width="20%">
                                <col width="11%">
                            </colgroup>
                            <thead class="thead">
                                <tr>
                                    <th><?php echo lang('lbl_serialNumber'); ?></th>
                                    <th><?php echo lang('lbl_companyName'); ?></th>
                                    <th><?php echo lang('lbl_incharge'); ?></th>
                					<th><?php echo lang('lbl_contact'); ?></th>
                                    <th><?php echo lang('lbl_email'); ?></th>
                                    <th><?php echo lang('lbl_entryDate'); ?></th>
                                    <th><?php echo lang('lbl_address'); ?></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <?php
                                if ($companyHistory != null) {
                                    foreach ($companyHistory as $key=> $history) {
                                        $class = $key % 2 === 0 ? 'odd' : 'even'; ?>
                                        <tr class="<?php echo $class; ?>">
                                            <td class="tac vam"><?php echo (++$serialNumber); ?></td>
                                            <td class="vam"><?php echo $history->companyName; ?></td>
                                            <td class="vam"><?php echo $history->incharge; ?></td>
                                            <td class="tac vam"><?php echo $history->contact; ?></td>
                                            <td class="vam"><?php echo $history->email; ?></td>
                                            <td class="tac vam"><?php echo ($history->entryDate != '0000-00-00') ? $history->entryDate : "Nil"; ?></td>
                                            <td class="vam"><?php echo $history->address; ?></td>
                                            <td class="tac vam">
                                                <a href="javascript:;" onclick="fnCompanyDetail(<?php echo $history->id;?>)" class="m3">
                                                    <img style="width: 20px;"
                                                    src="<?php echo base_url(); ?>assets/images/details.png" title="details view">
                                                </a>
                                                <?php if($history->delFlag == 0) { ?>
                                                    <a href="javascript:;" onclick="fnCompanyActiveOrDeactive(<?php echo $history->id;?> , <?php echo $history->delFlag;?>)"><?php echo lang('lbl_active'); ?></a>
                                                <?php } else { ?>
                                                    <a href="javascript:;" onclick="fnCompanyActiveOrDeactive(<?php echo $history->id;?> , <?php echo $history->delFlag;?>)" style="color:red;"><?php echo lang('lbl_deactive'); ?></a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr><td colspan="8" class="tac noDataFoundClr" style="font-size: 16px;">No data found</td></tr>
                                <?php }
                            ?>
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
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/admin/company/history.js"></script>
    </body>