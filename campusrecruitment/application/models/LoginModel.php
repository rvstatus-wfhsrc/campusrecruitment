<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model {
 
 	/**
   * Login Model __construct
   *
   * This __construct is used to load the database
   * 
   * @author kulasekaran.
   *
   */
  function __construct() {
    parent::__construct();
    $this->load->database();
  }

  /**
   * This loginProcess method is used to check the enter userName and password correct or not
   * @return to loginUser method in login controller 
   * @author kulasekaran.
   *
   */
  function loginProcess() {
    $flag = $this->input->post('flag');
    if($flag == 1) {
      $result = $this->db->query("SELECT userName,name,flag FROM cmt_users WHERE flag = '".$flag."' AND userName = '".$this->input->post('adminUserName')."' AND password = '".md5($this->input->post('adminPassword'))."'");
    } elseif ($flag == 2 ) {
      $result = $this->db->query("SELECT userName,companyName AS name,flag FROM cmt_company WHERE userName = '".$this->input->post('companyUserName')."' AND password = '".md5($this->input->post('companyPassword'))."'");
    } else {
	     $result = $this->db->query("SELECT userName,name,flag FROM cmt_users WHERE flag = '".$flag."' AND userName = '".$this->input->post('jobSeekerUserName')."' AND password = '".md5($this->input->post('jobSeekerPassword'))."'");
    }
	  return $result;
	}

  /**
   * This forgetEmailExistingCheckProcess method is used to check the enter userName and password correct or not
   * @return to view screen [ password/email ]
   * @author kulasekaran.
   *
   */
  function forgetEmailExistingCheckProcess() {
    $flag = $this->input->post('flag');
    if($flag == 1) {
      $result = $this->db->query("SELECT email,name FROM cmt_users WHERE flag = '".$flag."' AND email = '".$this->input->post('email')."'");
    } elseif ($flag == 2 ) {
      $result = $this->db->query("SELECT email,companyName as name FROM cmt_company WHERE email = '".$this->input->post('email')."'");
    } else {
    $result = $this->db->query("SELECT email,name FROM cmt_users WHERE flag = '".$flag."' AND email = '".$this->input->post('email')."'");
    }
    return $result;
  }
  
  /**
   * This updateToken method is used to check the enter userName and password correct or not
   * @return to view screen [ password/email ]
   * @author kulasekaran.
   *
   */
  function updateToken($email,$token) {
    $dataExistingCheck = $this->db->query("SELECT email FROM cmt_password_resets WHERE email = '".$email."'");
    if($dataExistingCheck->num_rows() > 0) {
      $this->db->where('email', $email);
      $result = $this->db->update('cmt_password_resets', array('token' => $token));
    } else {
      $tokenData = array(
        'email' => $email,
        'token' => $token
      );
      $result = $this->db->insert('cmt_password_resets', $tokenData);
    }
    return $result;
  }

  /**
   * This userVerification method is used to check the enter userName and password correct or not
   * @return to view screen [ password/email ]
   * @author kulasekaran.
   *
   */
  function userVerification() {
    $userVerificationCheck = $this->db->query("SELECT email FROM cmt_password_resets WHERE email = '".$this->input->get('email')."' AND token = '".$this->input->get('token')."'");
    if($userVerificationCheck->num_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }

  /**
   * This updatePassword method is used to update the password in cmt_users table and also update the cmt_password_resets table
   * @return to the  [ password/email ]
   * @author kulasekaran.
   *
   */
  function updatePassword() {
    $email = $this->input->post('email');
    $flag = $this->input->post('flag');
    $token = $this->input->post('token');
    $updatePasswordResults = null;
    $this->db->trans_begin();
    try {
        $table = "cmt_users";
        if($flag == 2) {
          $table = "cmt_company";
        }
        $passwordUpdateData = array(
                                'password' => md5($this->input->post('password')),
                                'updated_by' => $email
                              );
        $this->db->where('email', $email);
        $this->db->where('flag', $flag);
        $updatePasswordResults = $this->db->update($table, $passwordUpdateData);
     
     
        $this->db->where('email', $email);
        $this->db->where('token', $token);
      $updatePasswordResults = $this->db->delete('cmt_password_resets');
          
     
     
      $this->db->trans_commit();
    } catch (\Exception $e) {
      $this->db->trans_rollback();
    }
    return $updatePasswordResults;
  }
}