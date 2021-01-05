<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Dash Board Controller
 *
 * This Controller are used to perform the company dashboard related process
 * 
 * @author kulasekaran.
 *
 */

class DashBoardController extends CI_Controller {

  public $layout_view = 'layouts/default';
  /**
   * Dash Board Controller __construct
   *
   * This __construct are used to load the DashBoardModel
   * 
   * @author kulasekaran.
   *
   */
  public function __construct() {
    parent::__construct();
    $this->load->model('DashBoardModel');
    if ($this->session->userdata('flag') == null) {
      redirect('HomeController/index');
    }
  }

  /**
   * This companyDashBoard method are used to call the company dash board screen
   * @return to view [ company/dashBoard/index ]
   * @author kulasekaran.
   *
   */
  public function companyDashBoard() {
    $data['activeJobSeeker'] = $this->DashBoardModel->activeJobSeeker();
    $data['totalJobPosted'] = $this->DashBoardModel->totalJobPosted();
    $data['totalJobApplied'] = $this->DashBoardModel->totalJobApplied();
    $data['totalPassResult'] = $this->DashBoardModel->totalPassResult();
    $data['maxJobAppliedDate'] = $this->DashBoardModel->maxJobAppliedDate();
    $data['totalFailResult'] = $this->DashBoardModel->totalFailResult();
    $data['totalJobCancelled'] = $this->DashBoardModel->totalJobCancelled();
    $this->layouts->view('company/dashBoard/index',$data);
  }

  /**
   * This companyAreaChart method are used to get the company data and return the data for area chart
   * @return json response
   * @author kulasekaran.
   *
   */
  public function companyAreaChart() {
    $result = $this->DashBoardModel->companyAreaChart();
    echo json_encode($result);exit();
  }

  /**
   * This companyBarChart method are used to get the company data and return the data for bar chart
   * @return json response
   * @author kulasekaran.
   *
   */
  public function companyBarChart() {
    $result = $this->DashBoardModel->companyBarChart();
    echo json_encode($result);exit();
  }

  /**
   * This companyPieChart method are used to get the company data and return the data for pie chart
   * @return json response
   * @author kulasekaran.
   *
   */
  public function companyPieChart() {
    $test = array();
    $result = $this->DashBoardModel->companyPieChart();
    if(!isset($result[1])) {
      if($result[0]->resultStatus == 1) {
        $test[0] = array('count' => '0' , 'resultStatus' => "");
        $test[1] = array('count' => $result[0]->count , 'resultStatus' => 1);
        $test[2] = array('count' => '0' , 'resultStatus' => 2);
      } elseif ($result[0]->resultStatus == 2) {
        $test[0] = array('count' => '0' , 'resultStatus' => "");
        $test[1] = array('count' => '0' , 'resultStatus' => 1);
        $test[2] = array('count' => $result[0]->count , 'resultStatus' => 2);
      } else {
        $test[0] = array('count' => $result[0]->count , 'resultStatus' => "");
        $test[1] = array('count' => '0' , 'resultStatus' => 1);
        $test[2] = array('count' => '0' , 'resultStatus' => 2);
      }
      $result = json_decode(json_encode($test), FALSE);
    } else if (!isset($result[2])) {
      if($result[0]->resultStatus != 1 && $result[1]->resultStatus != 1) {
        $test[0] = array('count' => $result[0]->count , 'resultStatus' => "");
        $test[1] = array('count' => 0 , 'resultStatus' => 1);
        $test[2] = array('count' => $result[1]->count , 'resultStatus' => 2);
      } elseif ($result[0]->resultStatus != 2 && $result[1]->resultStatus != 2) {
        $test[0] = array('count' => $result[0]->count , 'resultStatus' => "");
        $test[1] = array('count' => $result[0]->count , 'resultStatus' => 1);
        $test[2] = array('count' => '0' , 'resultStatus' => 2);
      } else {
        $test[0] = array('count' => '0', 'resultStatus' => "");
        $test[1] = array('count' => $result[0]->count , 'resultStatus' => 1);
        $test[2] = array('count' => $result[0]->count , 'resultStatus' => 2);
      }
      $result = json_decode(json_encode($test), FALSE);
    }
    echo json_encode($result);exit();
  }

  /**
   * This adminDashBoard method are used to call the admin dash board screen
   * @return to view [ admin/dashBoard/index ]
   * @author kulasekaran.
   *
   */
  public function adminDashBoard() {
    $data['activeJobSeeker'] = $this->DashBoardModel->activeJobSeeker();
    $data['activeCompany'] = $this->DashBoardModel->activeCompany();
    $data['allCompanyJobPosted'] = $this->DashBoardModel->allCompanyJobPosted();
    $data['allJobPassResult'] = $this->DashBoardModel->allJobPassResult();
    $data['allJobFailResult'] = $this->DashBoardModel->allJobFailResult();
    $data['allCompanyJobCancelled'] = $this->DashBoardModel->allCompanyJobCancelled();
    $data['maxAllJobAppliedDate'] = $this->DashBoardModel->maxAllJobAppliedDate();
    $this->layouts->view('admin/dashBoard/index',$data);
  }

  /**
   * This adminAreaChart method are used to get the all companies data and return the data for area chart
   * @return json response
   * @author kulasekaran.
   *
   */
  public function adminAreaChart() {
    $result = $this->DashBoardModel->adminAreaChart();
    echo json_encode($result);exit();
  }

  /**
   * This adminBarChart method are used to get the all companies data and return the data for bar chart
   * @return json response
   * @author kulasekaran.
   *
   */
  public function adminBarChart() {
    $result = $this->DashBoardModel->adminBarChart();
    echo json_encode($result);exit();
  }

  /**
   * This adminPieChart method are used to get the all companies data and return the data for pie chart
   * @return json response
   * @author kulasekaran.
   *
   */
  public function adminPieChart() {
    $result = $this->DashBoardModel->adminPieChart();
    echo json_encode($result);exit();
  }

}