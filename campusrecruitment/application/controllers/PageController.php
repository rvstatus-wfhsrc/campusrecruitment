<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Page Controller
 *
 * This Controller are used to separates the modules by methods
 * 
 * @author kulasekaran.
 *
 */

class PageController extends CI_Controller {

  public $layout_view = 'layouts/default';
  /**
   * Page Controller __construct
   *
   * This __construct are used to redirects into login screen whenever logged_in is false
   * 
   * @author kulasekaran.
   *
   */
  function __construct() {
    parent::__construct();
    $this->load->library('session');
    if($this->session->userdata('logged_in') !== TRUE){
      redirect('login');
    }
  }
 
  /**
   * This index method are used to allowing accesses to admin only
   * @return to redirects into AdminController/profile
   * @author kulasekaran.
   *
   */
  function index() {
    if($this->session->userdata('flag')==='1') {
      redirect('AdminController/profile');
    } else {
      echo "Access Denied";
    }
  }

  /**
   * This company method are used to allowing accesses to company only
   * @return to redirects into CompanyController/companyDetail
   * @author kulasekaran.
   *
   */
  function company() {
    if($this->session->userdata('flag')==='2') {
      redirect('CompanyController/companyDetail');
    } else {
      echo "Access Denied";
    }
  }
 
  /**
   * This jobSeeker method are used to allowing accesses to job seeker only
   * @return to redirects into JobSeekerController/jobSeekerDetail
   * @author kulasekaran.
   *
   */
  function jobSeeker() {
    if($this->session->userdata('flag')==='3') {
      redirect('JobSeekerController/jobSeekerDetail');
    } else {
      echo "Access Denied";
    }
  }
}