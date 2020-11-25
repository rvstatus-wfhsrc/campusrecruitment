<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PageController extends CI_Controller {

  public $layout_view = 'layouts/default';

  function __construct() {
    parent::__construct();
    $this->load->library('session');
    if($this->session->userdata('logged_in') !== TRUE){
      redirect('login');
    }
  }
 
  // Allowing accesses to admin only
  function index() {
    if($this->session->userdata('flag')==='1') {
      redirect('AdminController/profile/profileDetail');
    } else {
      echo "Access Denied";
    }
  }

  // Allowing accesses to company only
  function company() {
    if($this->session->userdata('flag')==='2') {
      $this->load->view('company/profileDetail');
    } else {
      echo "Access Denied";
    }
  }
 
  // Allowing accesses to student only
  function student() {
    if($this->session->userdata('flag')==='3') {
      $this->load->view('student/profileDetail');
    } else {
      echo "Access Denied";
    }
  }
}