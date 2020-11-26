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
		$data['profileDetail'] = $this->AdminModel->profileDetail($userName);
		$this->layouts->view('admin/profile/profileDetail',$data);
	}

	// register process
	public function register() {
		$data = array();
		$this->layouts->view('admin/register/register', $data);
	}

	// To remove the image
    public function removeImage() {
        $imageStatus = $this->AdminModel->removeImage();
        if($imageStatus == "1") { 
        	$this->session->set_flashdata(array('message' => 'Image Was Removed','type' => 'success'));
            redirect('AdminController/profile');
        } else {
        	$this->session->set_flashdata(array('message' => 'Sorry, Something Went Wrong. Please Try Again Later','type' => 'danger'));
            redirect('AdminController/profile');
        }
    }

    // To view and set the profile edit page
    public function profileEdit()
    {
        $userName = $this->session->userdata('userName');
		$data['profileEdit'] = $this->AdminModel->profileEdit($userName);
		$this->layouts->view('admin/profile/profileEdit',$data);
    }

    // To update the profile
    public function profileUpdate() {
		$userName = $this->session->userdata('userName');
		$profileUpdateData = array(
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'gender' => $this->input->post('gender'),
			'address' => $this->input->post('address'),
			'country' => $this->input->post('country'),
			'state' => $this->input->post('state'),
			'city' => $this->input->post('city'),
			'pincode' => $this->input->post('pincode'),
			'contact' => $this->input->post('contact'),
			'updated_by' => $userName
		);
		$profileUpdateStatus = $this->AdminModel->profileUpdate($userName,$profileUpdateData);
		redirect('AdminController/profile');
	}
}