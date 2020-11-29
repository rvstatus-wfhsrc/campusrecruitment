<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

	public $layout_view = 'layouts/default';

	public function __construct() {
		parent::__construct();
		$this->load->library('Layouts');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('LoginModel');
		$this->load->library('form_validation');
	}

	public function index() {
		$this->layouts->view('login/login');
	}

	public function login() {
		$this->layouts->view('login/login');
	}

	// login process
	function loginUser() {
		// login validation
		$this->form_validation->set_rules( 'userName', $this->lang->line("lbl_userName"), 'required',
												array(
													'required' => $this->lang->line("required")
												)
											);
		$this->form_validation->set_rules( 'password', $this->lang->line("lbl_password"), 'required|min_length[6]',
												array(
													'min_length' => $this->lang->line("min_length")
												)
											);
		if($this->form_validation->run() == false){
			$this->layouts->view('login/login');	
		} else {
			$userName    = $this->input->post('userName',TRUE);
		    $password = md5($this->input->post('password',TRUE));
		    $loginProcessCheck = $this->LoginModel->loginProcess($userName,$password);
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
		    	$data['error']=$this->lang->line("credentials_do_not_match");
		        $this->layouts->view('login/login',@$data);
    		}
		}
  	}

	// logout process
  	public function logout() {
  		$this->session->sess_destroy();
	    redirect('LoginController/login');
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