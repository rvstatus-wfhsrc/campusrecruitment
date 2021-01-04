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
    $result = $this->DashBoardModel->companyPieChart();
    echo json_encode($result);exit();
  }
}