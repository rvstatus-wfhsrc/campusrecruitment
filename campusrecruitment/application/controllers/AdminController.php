<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Controller
 *
 * This Controller are used to perform the admin profile related process
 * 
 * @author Ragav.
 *
 */

class AdminController extends CI_Controller {

	public $layout_view = 'layouts/default';
	/**
	 * Admin Controller __construct
	 *
	 * This __construct are used to load the Layouts, url, session and AdminModel
	 * 
	 * @author Ragav.
	 *
	 */
	public function __construct() {
		parent::__construct();
		$this->load->library('Layouts');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('AdminModel');
		$this->load->library('form_validation');
	}

	/**
	 * This profile methond are used to get the data form model for the specfic user (user whose login to website)
	 * @return to view screen [ profileDetail ]
	 * @author Ragav.
	 *
	 */
	public function profile() {
		$userName = $this->session->userdata('userName');
		$data['profileDetail'] = $this->AdminModel->profileDetail($userName);
		$this->layouts->view('admin/profile/profileDetail',$data);
	}


	/**
	 * This register methond are used for goto the register screen
	 * @throws any excetion are araise mention here
	 * @param any parameter pass are mention here
	 * @return to view screen [ register ]
	 * @author Ragav.
	 *
	 */
	public function register() {
		$data = array();
		$this->layouts->view('admin/register/register', $data);
	}


	/**
	 * This removeImage methond are used to remove the image for specfic user (user whose login to website)
	 * @return redirect to profile methond in Admin Controller
	 * @author Ragav.
	 *
	 */
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
		// login validation
		$this->form_validation->set_rules( 'name', $this->lang->line("lbl_name"), 'required|regex:/^[A-Za-z\s\.]+$/|max:50',
												array(
													'regex' => 'Please enter only alphabetical letter.'
												)
											);
		$this->form_validation->set_rules( 'email', $this->lang->line("lbl_email"), 'required|email|max:50|unique:users,email,'.$this->session->userdata('userName'),
												array(
													'reqiured' => $this->lang->line("reqiured"),
													'email' => $this->lang->line("email"),
													'unique' => $this->lang->line("unique")
												)
											);
		$this->form_validation->set_rules( 'gender', $this->lang->line("lbl_gender"), 'required');
		$this->form_validation->set_rules( 'address', $this->lang->line("lbl_address"), 'required');
		$this->form_validation->set_rules( 'country', $this->lang->line("lbl_country"), 'required');
		$this->form_validation->set_rules( 'state', $this->lang->line("lbl_state"), 'required');
		$this->form_validation->set_rules( 'city', $this->lang->line("lbl_city"), 'required');
		$this->form_validation->set_rules( 'pincode', $this->lang->line("lbl_pincode"), 'required');
		$this->form_validation->set_rules( 'contact', $this->lang->line("lbl_contact"), 'required');
		if($this->form_validation->run() == false) {
			$userName = $this->session->userdata('userName');
			$data['profileEdit'] = $this->AdminModel->profileEdit($userName);
			$this->layouts->view('admin/profile/profileEdit',$data);
		} else {
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
// 	public function profileUpdateValidation() {
// 		// login validation
// 		$this->form_validation->set_rules( 'name', $this->lang->line("lbl_name"), 'required|regex:/^[A-Za-z\s\.]+$/|max:50',
// 												array(
// 													'regex' => 'Please enter only alphabetical letter.'
// 												)
// 											);
// 		$this->form_validation->set_rules( 'email', $this->lang->line("lbl_email"), 'required|email|max:50|unique:users,email,'.$this->session->userdata('userName'),
// 												array(
// 													'reqiured' => $this->lang->line("reqiured"),
// 													'email' => $this->lang->line("email"),
// 													'unique' => $this->lang->line("unique")
// 												)
// 											);
// 		$this->form_validation->set_rules( 'gender', $this->lang->line("lbl_gender"), 'required',
// 												array(
// 													'reqiured' => $this->lang->line("reqiured")
// 												)
// 											);
// 		if($this->form_validation->run() == false) {
// 			return response()->json($validator->messages(), 200);exit;
//         } else {
//             $success = true;
//             echo json_encode($success);exit;
//         }
// 	}
}