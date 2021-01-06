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
	 * This __construct are used to load the CommonModel and AdminModel
	 * 
	 * @author Kulasekaran.
	 *
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('AdminModel');
		$this->load->model('CommonModel');
		if ($this->session->userdata('flag') == null) {
			redirect('HomeController/index');
		}
	}

	/**
	 * This profile method are used to get the data from model for the specfic user (user whose login to website)
	 * @return to view screen [ admin/profile/profileDetail ]
	 * @author kulasekaran.
	 *
	 */
	public function profile() {
		$userName = $this->session->userdata('userName');
		$data['profileDetail'] = $this->AdminModel->profileDetail($userName);
		$data['countryArray'] = $this->CommonModel->country();
		$data['stateArray'] = $this->CommonModel->state();
		$data['cityArray'] = $this->CommonModel->city();
		$this->layouts->view('admin/profile/profileDetail',$data);
	}


	/**
	 * This register method are used for goto the register screen
	 * @throws any excetion are araise mention here
	 * @param any parameter pass are mention here
	 * @return to view screen [ register ]
	 * @author Kulasekaran.
	 *
	 */
	public function register() {
		$data = array();
		$this->layouts->view('admin/register/register', $data);
	}


	/**
	 * This removeImage method are used to remove the image for specfic user (user whose login to website)
	 * @return redirect to profile method in Admin Controller
	 * @author Kulasekaran.
	 *
	 */
	public function removeImage() {
		$imageStatus = $this->AdminModel->removeImage();
		if($imageStatus == "1") { 
			$this->session->set_flashdata(
				array(
					'message' => 'Image Was Removed',
					'type' => 'success'
				)
			);
		} else {
			$this->session->set_flashdata(
				array(
					'message' => 'Sorry, Something Went Wrong. Please Try Again Later',
					'type' => 'danger'
				)
			);
		}
		redirect('AdminController/profile');
	}

	// To view and set the profile edit page
	public function profileEdit()
	{
		$userName = $this->session->userdata('userName');
		$data['profileEdit'] = $this->AdminModel->profileEdit($userName);
		$data['countryArray'] = $this->CommonModel->country();
		$data['stateArray'] = $this->CommonModel->state();
		$data['cityArray'] = $this->CommonModel->city();
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
			if($profileUpdateStatus == "1") {
				$this->session->set_flashdata(
					array(
						'message' => 'Profile Details Updated Successfully',
						'type' => 'success'
					)
				);
			} else {
				$this->session->set_flashdata(
					array(
						'message' => 'Profile Details Update Failed',
						'type' => 'danger'
					)
				);
			}
			redirect('AdminController/profile');
	}
	public function profileUpdateValidation() {
		// login validation
		$id = $this->session->userdata('id');
		$this->form_validation->set_rules( 'name', $this->lang->line("lbl_name"), 'required|regex_match[/^[A-Za-z\s\.]+$/]|max_length[50]',
												array(
													'required' => $this->lang->line("required"),
													'regex_match' => $this->lang->line("alphabetic"),
													'max_length' => $this->lang->line("max_length")
												)
											);
		$this->form_validation->set_rules( 'email', $this->lang->line("lbl_email"), 'required|valid_email|max_length[50]|callback_email_exist_check[cmt_users.email.'.$this->session->userdata('userName').']',
												array(
													'required' => $this->lang->line("required"),
													'valid_email' => $this->lang->line("valid_email"),
													'max_length' => $this->lang->line("max_length")
												)
											);
		$this->form_validation->set_rules( 'gender', $this->lang->line("lbl_gender"), 'required',
												array(
													'required' => $this->lang->line("required")
												)
											);
		$this->form_validation->set_rules( 'address', $this->lang->line("lbl_address"), 'required',
												array(
													'required' => $this->lang->line("required")
												)
											);
		$this->form_validation->set_rules( 'country', $this->lang->line("lbl_country"), 'required',
												array(
													'required' => $this->lang->line("required")
												)
											);
		$this->form_validation->set_rules( 'state', $this->lang->line("lbl_state"), 'required',
												array(
													'required' => $this->lang->line("required")
												)
											);
		$this->form_validation->set_rules( 'city', $this->lang->line("lbl_city"), 'required',
												array(
													'required' => $this->lang->line("required")
												)
											);
		$this->form_validation->set_rules( 'pincode', $this->lang->line("lbl_pincode"), 'required|regex_match[/\b\d{6}\b/]',
												array(
													'required' => $this->lang->line("required"),
													'regex_match' => $this->lang->line("pincode_digit")
												)
											);
		$this->form_validation->set_rules( 'contact', $this->lang->line("lbl_contact"), 'required|regex_match[/\b\d{10}\b/]',
												array(
													'required' => $this->lang->line("required"),
													'regex_match' => $this->lang->line("contact_digit")
												)
											);
		if ($this->form_validation->run() == FALSE){
            $json_response = $this->form_validation->error_array();
            echo json_encode($json_response); exit();

        }else{
           echo json_encode(true); exit();

        }
	}
	function email_exist_check($str, $fields)
	{
		list($table, $columnOne, $strTwo) = explode('.', $fields, 3); 
		$query = $this->db->query("SELECT COUNT(id) AS count FROM $table WHERE ".$columnOne." = '".$str."' AND userName != '".$strTwo."'");
		$row = $query->row();
		$this->form_validation->set_message('email_exist_check', $this->lang->line("exist_email"));
		return ($row->count > 0) ? FALSE : TRUE;
	}

	function getState() {
		$countryId = $this->input->get('countryId');
        $stateArray = $this->CommonModel->state($countryId);
        echo json_encode($stateArray);exit;
    }

    function getCity() {
    	$stateId = $this->input->get('stateId');
        $cityArray = $this->CommonModel->city($stateId);
        echo json_encode($cityArray);exit;
    }
}