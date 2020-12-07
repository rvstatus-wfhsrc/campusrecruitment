<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

	public $layout_view = 'layouts/default';

	public function __construct() {
		parent::__construct();
		$this->load->model('LoginModel');
	}

	public function index() {
		$this->layouts->view('login/login');
	}

	// login process
	function loginUser() {
		// login validation
		// $this->form_validation->set_rules( 'userName', $this->lang->line("lbl_userName"), 'required',
		// 										array(
		// 											'required' => $this->lang->line("required")
		// 										)
		// 									);
		// $this->form_validation->set_rules( 'password', $this->lang->line("lbl_password"), 'required|min_length[6]',
		// $this->form_validation->set_rules( 'password', $this->lang->line("lbl_password"), 'required',
		// 										array(
		// 											'required' => $this->lang->line("required"),
		// 											'min_length' => $this->lang->line("min_length")
		// 										)
		// 									);
		$validationRule = "jobSeekerLoginRule";
		if($this->input->post('flag') == 1 ) {
			$validationRule = "adminLoginRule";
		} elseif ($this->input->post('flag') == 2 ) {
			$validationRule = "companyLoginRule";
		}
		if($this->form_validation->run($validationRule) == false){
			$this->layouts->view('login/login');	
		} else {
			$loginProcessCheck = $this->LoginModel->loginProcess();
		    // if data matched
		    if($loginProcessCheck->num_rows() > 0) {
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
		        // access login for admin
		        if($flag === '1') {
		            redirect('PageController');
		        // access login for company
		        } elseif($flag === '2') {
		            redirect('PageController/company');
		        // access login for student
		        } else {
		            redirect('PageController/student');
		        }
		    // if data not matched
		    } else {
		    	$flag = $this->input->post('flag');
		        if($flag == 1) {
		    		$data['adminLoginError']=$this->lang->line("credentials_do_not_match");
		        } elseif ($flag == 2 ) {
		    		$data['companyLoginError']=$this->lang->line("credentials_do_not_match");
		        } else {
		    		$data['jobSeekerLoginError']=$this->lang->line("credentials_do_not_match");
		        }
		        $this->layouts->view('login/login',@$data);
    		}
		}
  	}

	// logout process
  	public function logout() {
  		$userData = [
			'siteLang'  => $this->session->userdata('siteLang'),
			'siteLangKey'  => $this->session->userdata('siteLangKey'),
		];
  		// $this->session->sess_destroy();
  		$this->session->unset_userdata('flag');
  		$this->session->unset_userdata('userName');
  		$this->session->unset_userdata('logged_in');
	    redirect('LoginController/index');
   	}
	// Allowing accesses to student only
	function siteLangUpdate() {
		$userData = [
			'siteLang'  => 'english',
			'siteLangKey'  => 1,
		];
		$siteLang = $this->input->post();
		if(isset($siteLang['siteLang']) && $siteLang['siteLang'] == 2){
			$userData = [
				'siteLang'  => 'japanese',
				'siteLangKey'  => $siteLang['siteLang'],
			];
		}
		$this->session->set_userdata($userData);
		$success = TRUE;
		echo json_encode($success);exit;
	}
}