<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

	public $layout_view = 'layouts/default';

	public function __construct() {
		parent::__construct();
		$this->load->library('Layouts');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('AdminModel');
	}

	// profile detail process
	public function profile() {
		$userName = $this->session->userdata('userName');
		$profileDetail = $this->AdminModel->profileDetail($userName);
		$this->layouts->view('admin/profile/profileDetail',$profileDetail);
	}

	// register process
	public function register() {
		$data = array();
		$this->layouts->view('admin/register/register', $data);
	}
}