<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="Ragav">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/font-awesome.min.css" type="text/css"> 
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/themify-icons.css"> 
    <!-- main styles -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/home/main.css" type="text/css">
    <!-- responsive CSS styles -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/home/responsive.css" type="text/css">
    <style type="text/css">
      /* margin-left: 0px; is need for mobile view style at logout */
      @media (max-width: 840px) {
        #layoutSidenav #layoutSidenav_content {
          margin-left: 0;
        }
      }
      .btn {
        padding: 0.375rem 0.75rem;
      }
    </style>
  </head>
  <body>  
    <!-- header section start -->
    <div class="header" style="margin-top: -0.5rem;">    
      <!-- start intro section -->
      <section id="intro" class="section-intro">
	      <div class="search-container">
	        <div class="container">
	          <div class="row">
	            <div class="col-md-12">
	              <h1><?php echo lang('lbl_findJobIntro');?></h1><br>
                <h2>More than <strong><?php echo number_format($totalRecord); ?></strong> jobs are waiting to kick start your career!</h2>
	              <div class="content">
                  <?php echo form_open('HomeController/index',
                                  ['method' => 'POST', 'class' => 'form-horizontal','id' => 'indexForm','name' => 'indexForm']); ?>
                    <input type="hidden" id="hiddenJobKeyWords" name="hiddenJobKeyWords" value= "<?php echo $this->input->post('jobKeyWords') ?>" >
                    <input type="hidden" id="hiddenArea" name="hiddenArea" value= "<?php echo $this->input->post('area') ?>" >
                    <input type="hidden" id="per_page" name="per_page">
                    <input type="hidden" id="hiddenJobId" name="hiddenJobId">
                    <input type="hidden" id="base" value="<?php echo base_url(); ?>">
	                  <div class="row">
	                    <div class="col-md-4 col-sm-6">
	                      <div class="form-group">
                          <?php
                            $fields = array(
                              'id' => 'jobKeyWords',
                              'name' => 'jobKeyWords',
                              'placeholder' => 'job title/ keywords/ company name',
                              'class' => 'form-control',
                              'autocomplete' => 'off',
                              'value' => set_value('jobKeyWords',($this->input->post('jobKeyWords') != null) ? $this->input->post('jobKeyWords') : false)
                            );
                            echo form_input($fields);
                          ?>
	                        <i class="ti-time"></i>
	                      </div>
	                    </div>
	                    <div class="col-md-4 col-sm-6">
	                      <div class="form-group">
                          <?php
                            $fields = array(
                              'id' => 'area',
                              'name' => 'area',
                              'placeholder' => 'city/ province/ zip code',
                              'class' => 'form-control',
                              'autocomplete' => 'off',
                              'value' => set_value('area',($this->input->post('area') != null) ? $this->input->post('area') : false)
                            );
                            echo form_input($fields);
                          ?>
	                        <i class="ti-location-pin"></i>
	                      </div>
	                    </div>
	                    <div class="col-md-3 col-sm-6">
	                      <div class="search-category-container">
	                        <label class="styled-select" style="height: 54px;">
	                          <?php
                              $fields = array (
                                'id' => 'jobCategory',
                                'name' => 'jobCategory',
                                'class' => 'form-control autowidth',
                                'style' => 'height: 55px;'
                              );
                              echo form_dropdown('jobCategory', $jobCategoryArray,set_value('jobCategory', isset($jobEdit->jobCategory) ? $jobEdit->jobCategory : false),$fields);
                            ?>
	                        </label>
	                      </div>
	                    </div>
	                    <div class="col-md-1 col-sm-6">
	                      <button type="button" class="btn btn-search-icon" id="search" name="search"><i class="ti-search"></i></button>
	                    </div>
	                  </div>
                  <?php echo form_close();?>
	              </div>
	              <!-- <div class="popular-jobs">
	                <b>Popular Keywords: </b>
	                <a href="#">Web Design</a>
	                <a href="#">Manager</a>
	                <a href="#">Programming</a>
	              </div> -->
	            </div>
	          </div>
	        </div>
	      </div>
      </section>
      <!-- end intro section -->
    </div>
    
    <!-- Find Job Section Start -->
    <section class="find-job section">
      <div class="container">
        <h2 class="section-title"><?php echo lang('lbl_jobList');?></h2>
        <div class="row">
          <div class="col-md-12">
            <?php 
              if (!empty($jobList)) {
                foreach ($jobList as $key => $job) { ?>
                  <div class="job-list">
                    <!-- <div class="thumb">
                      <a href="javascript:alert('under construction for job details');"><img src="assets/img/jobs/img-1.jpg" alt=""></a>
                    </div> -->
                    <div class="job-list-content">
                      <h4>
                        <a href="javascript:alert('under construction for job details');">Need a <?php echo $job->roleName; ?></a>
                        <?php if($job->jobType == 1) { ?>
                          <span class="part-time">Part-Time</span>
                        <?php } else { ?>
                          <span class="full-time">Full-Time</span>
                        <?php } ?>
                      </h4>
                      <p>
                        <?php echo nl2br($job->jobDescription); ?>
                      </p>
                      <div class="job-tag">
                        <div class="pull-left">
                          <div class="meta-tag">
                            <span><a href="javascript:fnJobCategorySearch(<?php echo $job->jobCategory; ?>)"><i class="ti-brush"></i><?php echo $job->designationName; ?></a></span>
                            <span><i class="ti-location-pin"></i><?php echo $job->jobLocation; ?></span>
                            <span><i class="ti-time"></i><?php echo $job->workingHour; ?> Hrs / Day</span>
                          </div>
                        </div>
                        <div class="pull-right">
                          <!-- <div class="icon">
                            <i class="ti-heart"></i>
                          </div> -->
                          <a href="javascript:fnJobMoreDetail(<?php echo $job->id; ?>)" class="btn btn-common btn-rm"><?php echo lang('lbl_moreDetail');?></a>
                        </div>
                      </div>
                    </div>
                  </div>
            <?php } } else { ?>
              <img src="<?php echo base_url(); ?>assets/images/no_job_list.png" alt="">
            <?php } ?>
          </div>
          <div class="col-md-12">
            <div class="showing pull-left">
              <?php 
                  if ($totalRecord < $serialNumber+5) {
                    $lastSerialNumber = $totalRecord;
                  } else {
                    $lastSerialNumber = ($serialNumber+5);
                  }
              ?>
              <?php if($totalRecord != 0) { ?>
                <a>Showing <span><?php echo (++$serialNumber)."-".$lastSerialNumber; ?></span> Of <?php echo $totalRecord; ?> Jobs</a>
              <?php } ?>
            </div>                    
            <ul class="pull-right">
                <?php echo $this->pagination->create_links(); ?>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <!-- find job section end -->
    <!-- go to top Link -->
    <a href="#" class="back-to-top">
      <i class="ti-arrow-up"></i>
    </a>

    <div id="loading">
      <div id="loading-center">
        <div id="loading-center-absolute">
          <div class="object" id="object_one"></div>
          <div class="object" id="object_two"></div>
          <div class="object" id="object_three"></div>
          <div class="object" id="object_four"></div>
          <div class="object" id="object_five"></div>
          <div class="object" id="object_six"></div>
          <div class="object" id="object_seven"></div>
          <div class="object" id="object_eight"></div>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/home/jquery-min.js"></script>      
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/home/main.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/home/index.js"></script>
  </body>
</html>