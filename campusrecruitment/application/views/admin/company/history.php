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
                <li class="breadcrumb-item"><i class="fa fa-building-o fa-btn mt3"></i>Company<span class ="dot historyScrClr">&bull;</span><span class="historyScrClr">History</span></li>
                <!-- @if(Session::has('message'))
                    <div class="alert alert-{{session('message')['type']}} fmsg tac">{{ Session::get('message')['text'] }}</div>
                @endif -->
            </ol>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="container-fluid dispNone">
                    <a class="btn btn-success mb-1 disabled" href="<?php echo site_url('CompanyController/add') ?>">
                        <i class="fa fa-btn fa-plus"></i>Add Company
                    </a>
                    <?php echo form_open('CompanyController/CompanyDetail',['method' => 'POST','id' => 'historyForm','name' => 'historyForm']); ?>
                        <input type="hidden" id="hiddenCompanyId" name="hiddenCompanyId">
                        <input type="hidden" id="hiddenDelFlag" name="hiddenDelFlag">
                        <!-- {{ Form::hidden('page', $request->page , array('id' => 'page')) }} -->
                        <input type="hidden" id="hiddenSearch" name="hiddenSearch">
                        <!-- filtering process -->
                        <div class="inb fs16 float-left w70">
                            <a href="javascript:;" onclick="fnCompanyFilter(1)" id="filterVal1" class="fs16 btn btn-link <?php echo $disableAll ?>">All</a>
                            <span> | </span>
                            <a href="javascript:;" onclick="fnCompanyFilter(<?php echo '2';?>)" id="filterVal2" class="fs16 btn btn-link <?php echo $disableActive ?>">Active</a>
                            <span> | </span>
                            <a href="javascript:;" onclick="fnCompanyFilter(3)" id="filterVal3" class="fs16 btn btn-link <?php echo $disableNonActive ?>">Deactive</a>
                        </div>
                        <input type="hidden" id="filterVal" name="filterVal">
                        <!-- clear search -->
                        <div  class="inb float-left mt-1 w3">
                          <a href="javascript:;" onclick="fnClearSearch()"><img style="width: 25px;" src="<?php echo base_url(); ?>assets/images/clearsearch.png" title="Clear Search"></a>
                        </div>
                        <!-- sorting process -->
                        <!-- <div class="inb float-left"> -->
                            <?php
                                // echo form_dropdown('sortProcess',$sortArray,set_value('sortProcess', 1, false),'class = "form-control autowidth h34 inb mr-2 CMN_sorting" id = "sortProcess" name = "sortProcess"');
                                        ?>
                            <!-- {{ Form::select('sortProcess', $sortArray,1,['class' => 'form-control h34 autowidth inb mr-2 CMN_sorting'.' ' .$request->sortStyle, 'id' => 'sortProcess']) }} -->
                            <!-- <input type="hidden" id="sortVal" name="sortVal">
                            <input type="hidden" id="sortOptn" name="sortOptn"> -->
                        <!-- </div> -->
                        <!-- searching process -->
                        <div class="input-group searchBtn">
                            <?php
                                $data= array(
                                    'id' => 'search',
                                    'name' => 'search',
                                    'placeholder' => 'Search Company Name',
                                    'class' => 'input_box form-control h34'
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
                                <col width="20%">
                                <col width="10%">
                                <col width="18%">
                                <col width="11%">
                            </colgroup>
                            <thead class="thead">
                                <tr>
                                    <th>S.No</th>
                                    <th>Company Name</th>
                                    <th>Contact Incharge</th>
                					<th title="Sub Department Starting Time">Contact</th>
                                    <th title="Sub Department Ending Time">E-Mail Address</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <?php
                                if ($companyHistory != null) {
                                    foreach ($companyHistory as $key=> $history) {
                                        $class = $key % 2 === 0 ? 'odd' : 'even'; ?>
                                        <tr class="{{ $class }}">
                                            <td class="tac vam"><?php echo ($key + 1); ?></td>
                                            <td class="vam"><?php echo $history->companyName; ?></td>
                                            <td class="vam"><?php echo $history->incharge; ?></td>
                                            <td class="tac vam"><?php echo $history->contact; ?></td>
                                            <td class="tac vam"><?php echo $history->email; ?></td>
                                            <td class="tac vam">
                                                <a href="javascript:;" onclick="fnCompanyDetail(<?php echo $history->id;?>)" class="m3">
                                                    <img style="width: 20px;"
                                                    src="<?php echo base_url(); ?>assets/images/details.png" title="details view">
                                                </a>
                                                <?php if($history->delFlag == 0) { ?>
                                                    <a href="javascript:;" onclick="fnCompanyActiveOrDeactive(<?php echo $history->id;?> , <?php echo $history->delFlag;?>)">Active</a>
                                                <?php } else { ?>
                                                    <a href="javascript:;" onclick="fnCompanyActiveOrDeactive(<?php echo $history->id;?> , <?php echo $history->delFlag;?>)" style="color:red;">Deactive</a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr><td colspan="6" class="tac noDataFoundClr" style="font-size: 16px;">No data found</td></tr>
                                <?php }
                            ?>
                        </table>
                        <!-- @if(!empty($departmentHistory->total()))
                            <span class="pull-left">{{ $departmentHistory->firstItem() }} ~ {{ $departmentHistory->lastItem() }} / {{ $departmentHistory->total() }}</span>
                            <div class="dataTables_paginate">
                                {{ $departmentHistory->links() }}
                            </div>
                        @endif -->
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/admin/company/history.js"></script>
    </body>