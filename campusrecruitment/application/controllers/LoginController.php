<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Login Controller
 *
 * This Controller is used to perform the login and logout process
 * 
 * @author kulasekaran.
 *
 */
class LoginController extends CI_Controller {

	public $layout_view = 'layouts/default';

	/**
	 * Login Controller __construct
	 *
	 * This __construct is used to load the LoginModel
	 * 
	 * @author kulasekaran.
	 *
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('LoginModel');
	}

	/**
	 * This adminLogin method is used for goto login screen
	 * @return to view screen [ admin/login ]
	 * @author kulasekaran.
	 *
	 */
	public function adminLogin() {
		$this->layouts->view('admin/login');
	}

	/**
	 * This CompanyLogin method is used for goto login screen
	 * @return to view screen [ company/login ]
	 * @author kulasekaran.
	 *
	 */
	public function CompanyLogin() {
		$this->layouts->view('company/login');
	}

	/**
	 * This jobSeekerLogin method is used for goto login screen
	 * @return to view screen [ jobSeeker/login ]
	 * @author kulasekaran.
	 *
	 */
	public function jobSeekerLogin() {
		$this->layouts->view('jobSeeker/login');
	}

	/**
	 * This loginUser method is used to proform the login screen validation for admin,company and job seeker.
	 * check the valid user process, then set that use data into the session
	 * @return to view screen [ login ] for any error on given data or redirect to PageController
	 * @author kulasekaran.
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
				$userName  = $data['userName'];
				$name = $data['name'];
				$flag = $data['flag'];
				$logindata = array(
					'userName'  => $userName,
					'name' => $name,
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
	 * This getResetPasswordLink method is used for goto reset password link send screen
	 * @return to view screen [ password/email ]
	 * @author kulasekaran.
	 *
	 */
	public function getResetPasswordLink() {
		$this->layouts->view('password/email');
	}

	/**
	 * This resentLinkSend method is used for send a reset link to the curresponding user mail
	 * @return to view screen [ password/email ]
	 * @author kulasekaran.
	 *
	 */
	public function resentLinkSend() {
		if($this->form_validation->run('getResetPasswordLink') == false) {
			$this->layouts->view('password/email');
		} else {
			$forgetEmailExistingCheck = $this->LoginModel->forgetEmailExistingCheckProcess();
			if($forgetEmailExistingCheck->num_rows() > 0) {
				$forgetEmailExistingCheckArray  = $forgetEmailExistingCheck->row_array();
				$data['name'] = $forgetEmailExistingCheckArray['name'];
				$data['email'] = $forgetEmailExistingCheckArray['email'];
				$data['flag'] = $this->input->post('flag');
				$data['token'] = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 50);
				$updateToken = $this->LoginModel->updateToken($data['email'],$data['token']);
				if($updateToken) {
					$message = $this->load->view('emails/password',$data,true);
					$this->email->set_newline("\r\n");
					$this->load->config('email');
					$from = $this->config->item('smtp_user');
					$to = $forgetEmailExistingCheckArray['email'];
					$subject = "Forget Password";
					$this->email->from($from);
					$this->email->to($to);
					$this->email->subject($subject);
					$this->email->message($message);

					if ($this->email->send()) {
						$this->session->set_flashdata(
							array(
								'message' => 'Email has successfully been sent.',
								'type' => 'success'
							)
						);
					} else {
						$this->session->set_flashdata(
							array(
								'message' => 'Email has not successfully been sent. try again later.',
								'type' => 'danger'
							)
						);
					}
				} else {
					$this->session->set_flashdata(
						array(
							'message'  => 'Sorry, Something Went Wrong. Please Try Again Later',
							'type' => 'danger'
						)
					);
				}
				/**
				* adminLoginRule	 --------> Admin Login Screen Validation Rule
				* 
				* jobSeekerLoginRule --------> Job Seeker Login Screen Validation Rule
				* 
				* companyLoginRule	 --------> Company Login Screen Validation Rule
				* 
				*/
				$redirectPath = "jobSeekerLogin";
				if($this->input->post('flag') == 1 ) {
					$redirectPath = "adminLogin";
				} elseif ($this->input->post('flag') == 2 ) {
					$redirectPath = "CompanyLogin";
				}
				redirect('LoginController/'.$redirectPath);
			} else {
				$data['credentials_do_not_match']=$this->lang->line("credentials_do_not_match");
				$this->layouts->view('password/email',@$data);
			}
		}
	}

	public function userVerification() {
		$userVerificationCheck = $this->LoginModel->userVerification();
		$flag = $this->input->get('flag');
		if($userVerificationCheck) {
			$this->layouts->view('password/reset');
		} else {
			$this->session->set_flashdata(
				array(
					'message'  => 'Sorry, Token Has Expired. Please Try Again Later',
					'type' => 'danger'
				)
			);
			/**
			* adminLoginRule	 --------> Admin Login Screen Validation Rule
			* 
			* jobSeekerLoginRule --------> Job Seeker Login Screen Validation Rule
			* 
			* companyLoginRule	 --------> Company Login Screen Validation Rule
			* 
			*/
			$redirectPath = "jobSeekerLogin";
			if($flag == 1 ) {
				$redirectPath = "adminLogin";
			} elseif ($flag == 2 ) {
				$redirectPath = "CompanyLogin";
			}
			redirect('LoginController/'.$redirectPath);
		}
	}

	public function passwordResetForm()
	{

		if($this->input->post('email') == null) {
			// while enter press on url this redirect is useful
			redirect('LoginController/userVerification?email='.urlencode($this->session->flashdata('email')).'&token='.$this->session->flashdata('token').'&flag='.$this->session->flashdata('flag'));
		} else {
			$this->session->set_flashdata(
				array(
					'email' => $this->input->post('email'),
					'token' => $this->input->post('token'),
					'flag' => $this->input->post('flag')
				)
			);
		}
		if($this->form_validation->run('resetPassword') == false) {
			$this->layouts->view('password/reset');
		} else {
			$updatePasswordResult = $this->LoginModel->updatePassword();
			if($updatePasswordResult) {
				$this->session->set_flashdata(
					array(
						'message' => 'Password updated Successfully',
						'type' => 'success'
					)
				);
			} else {
				$this->session->set_flashdata(
					array(
						'message'  => 'Sorry, Something Went Wrong. Please Try Again Later',
						'type' => 'danger'
					)
				);
			}
			/**
			* adminLoginRule	 --------> Admin Login Screen Validation Rule
			* 
			* jobSeekerLoginRule --------> Job Seeker Login Screen Validation Rule
			* 
			* companyLoginRule	 --------> Company Login Screen Validation Rule
			* 
			*/
			$redirectPath = "jobSeekerLogin";
			if($this->input->post('flag') == 1 ) {
				$redirectPath = "adminLogin";
			} elseif ($this->input->post('flag') == 2 ) {
				$redirectPath = "CompanyLogin";
			}
			redirect('LoginController/'.$redirectPath);
		}
	}

	/**
	 * This logout method is used to proform the logout process (session destroy process)
	 * then set that use data into the session
	 * @return to HomeController index method
	 * @author kulasekaran.
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