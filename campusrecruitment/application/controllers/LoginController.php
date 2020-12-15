<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Login Controller
 *
 * This Controller is used to perform the login and logout process
 * 
 * @author Ragav.
 *
 */
class LoginController extends CI_Controller {

	public $layout_view = 'layouts/default';

	/**
	 * Login Controller __construct
	 *
	 * This __construct is used to load the LoginModel
	 * 
	 * @author Ragav.
	 *
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('LoginModel');
	}

	/**
	 * This adminLogin methond is used for goto login screen
	 * @return to view screen [ admin/login ]
	 * @author Ragav.
	 *
	 */
	public function adminLogin() {
		$this->layouts->view('admin/login');
	}

	/**
	 * This CompanyLogin methond is used for goto login screen
	 * @return to view screen [ company/login ]
	 * @author Ragav.
	 *
	 */
	public function CompanyLogin() {
		$this->layouts->view('company/login');
	}

	/**
	 * This jobSeekerLogin methond is used for goto login screen
	 * @return to view screen [ jobSeeker/login ]
	 * @author Ragav.
	 *
	 */
	public function jobSeekerLogin() {
		$this->layouts->view('jobSeeker/login');
	}

	/**
	 * This loginUser methond is used to proform the login screen validation for admin,company and job seeker.
	 * check the valid user process, then set that use data into the session
	 * @return to view screen [ login ] for any error on given data or redirect to PageController
	 * @author Ragav.
	 *
	 */
	function loginUser() {
		/**
		* adminLoginRule	 --------> Admin Login Screen Validation Rule
		* 
		* jobSeekerLoginRule --------> Job Seeker Login Screen Validation Rule
		* 
		* companyLoginRule	 --------> Company Login Screen Validation Rule
		* 
		*/
		$validationRule = "jobSeekerLoginRule";
		$pagePath = "jobSeeker/login";
		if($this->input->post('flag') == 1 ) {
			$pagePath = "admin/login";
			$validationRule = "adminLoginRule";
		} elseif ($this->input->post('flag') == 2 ) {
			$pagePath = "company/login";
			$validationRule = "companyLoginRule";
		}
		if($this->form_validation->run($validationRule) == false) {
			$this->layouts->view($pagePath);	
		} else {
			$loginProcessCheck = $this->LoginModel->loginProcess();
			if($loginProcessCheck->num_rows() > 0) {
				// proper login data given by user
				$data  = $loginProcessCheck->row_array();
				$id  = $data['id'];
				$userName  = $data['userName'];
				$password = $data['password'];
				$flag = $data['flag'];
				$logindata = array(
					'id' => $id,
					'userName'  => $userName,
					'flag'     => $flag,
					'logged_in' => TRUE
				);
				$this->session->set_userdata($logindata);
				if($flag === '1') {
					// access login for admin
					redirect('PageController');
				} elseif($flag === '2') {
					// access login for company
					redirect('PageController/company');
				} else {
					// access login for student
					redirect('PageController/jobSeeker');
				}
			} else {
				// unproper login data given by user
				$flag = $this->input->post('flag');
				if($flag == 1) {
					$data['adminLoginError']=$this->lang->line("credentials_do_not_match");
				} elseif ($flag == 2 ) {
					$data['companyLoginError']=$this->lang->line("credentials_do_not_match");
				} else {
					$data['jobSeekerLoginError']=$this->lang->line("credentials_do_not_match");
				}
				$this->layouts->view($pagePath,@$data);
			}
		}
	}

	/**
	 * This logout methond is used to proform the logout process (session destroy process)
	 * then set that use data into the session
	 * @return to HomeController index method
	 * @author Ragav.
	 *
	 */
	public function logout() {
		$userData = [
			'siteLang'  => $this->session->userdata('siteLang'),
			'siteLangKey'  => $this->session->userdata('siteLangKey'),
		];
		// $this->session->sess_destroy();
		$this->session->unset_userdata('flag');
		$this->session->unset_userdata('userName');
		$this->session->unset_userdata('logged_in');
		redirect('HomeController/index');
	}
}