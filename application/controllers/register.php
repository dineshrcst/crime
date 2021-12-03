<?php
/**
* Class:  Register Controller 
* Author: Dinesh Rathnayake
* Date:   23/05/2021
*/
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'controllers/'.'Auth.php');
class Register extends Auth {

    private $register;
    private $user;

	public function __construct() {
        parent::__construct();
        $this->load->model('Register_model');
        $this->register = new Register_model();
        $this->user = $this->load->model('User_model');
        $this->user = new User_model();
    }

 	public function index() 
    {
    	$data['title'] = 'Register User';
    	$data['userTypes']     = $this->get_User_Types();
    	$data['body'] = $this->load->view('core/register/reg', $data, true);  
    	$this->load->view('layouts/layout_page_register', $data);  									
    }

    private function get_User_Types(){
    	   $results = $this->register->getUserTypes();
           $data_array = array();
           foreach ($results as $row) {
                $data_array[] = $row;
            }
        return $data_array;
    }

    public function registerUser(){

            $this->load->helper(array('form', 'url'));

            $this->load->library('form_validation');

            $this->form_validation->set_rules('fName', 'First Name', 'required');
            $this->form_validation->set_rules('lName', 'Last Name', 'required');               
            $this->form_validation->set_rules('eMail', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('mobile', 'Phone Number', 'trim|required|min_length[10]|max_length[10]');
            $this->form_validation->set_rules('uName', 'User Name', 'required|max_length[10]');
            $this->form_validation->set_rules('pWord', 'Password', 'required');
            $this->form_validation->set_rules('cpWord', 'Password Confirmation', 'required|matches[pWord]');
            $this->form_validation->set_rules('utype', 'User Type', 'required');

            $userType =  trim($this->input->post('utype'));
            if($userType == 0){
                    $this->form_validation->set_rules('utype', 'User Type', 'callback_usertype_check');
                    $this->form_validation->set_message('usertype_check', 'Please select user type.');
            }

            $usName = trim($this->input->post('uName'));
            $eMail = trim($this->input->post('eMail'));
            $phone = trim($this->input->post('mobile')); 

            if($this->checkUserName($usName)){
               $this->form_validation->set_rules('uName', 'User Name', 'callback_uName_check');
               $this->form_validation->set_message('uName_check', 'User Name Already Exists.');
            }

            if(!$this->checkEmail($eMail)){
               $this->form_validation->set_rules('eMail', 'E-Mail', 'callback_email_check');
               $this->form_validation->set_message('email_check', 'E-Mail Already Exists.');
            }
            if(!$this->checkMobile($phone)){
               $this->form_validation->set_rules('mobile', 'Pnone No', 'callback_mobile_check');
               $this->form_validation->set_message('mobile_check', 'Phone Number Already Exists.');
            }

             // if ($this->form_validation->run() == FALSE)
             if ($this->form_validation->run() == FALSE)
            {   
                    $this->index();
            }
            else
            {
                                
                $data['firstname'] = trim($this->input->post('fName'));
                $data['lastname'] = trim($this->input->post('lName'));

                $usName = trim($this->input->post('uName'));
                $passWord = trim($this->input->post('pWord'));
                $conPassword = trim($this->input->post('cpWord'));
                $userType =  trim($this->input->post('utype'));
                $eMail = trim($this->input->post('eMail'));
                $phone = trim($this->input->post('mobile'));   
                //Get the hash of the password
                $hashed_password = password_hash($passWord, PASSWORD_DEFAULT);

                $data['password'] = $hashed_password;
                $data['username'] = $usName;
                $data['rollid'] = $userType;
                $data['police_station'] = 0;
                
                $data['status'] = 'P'; 
                $data['emailVerified'] = 'N';  

                $data['email'] = $eMail;
                $data['phone'] = $phone;
 
                
                $uid=$this->register->saverecords($data);
                if($uid > 0){
                                            
                //Mail Send  when create account
                if ($this->send_verification_email($usName)) {
                $hash = $this->encryption->encrypt($usName);
                redirect('register/email/verification?user='.$usName.'&hash='.$hash, 'refresh');
                } else {
                $this->session->set_flashdata('error', 'Verification Email Error!');
                }
                                        
                }
                else{
                $this->session->set_flashdata('error', ER_MSG_FOR_SAVE_DATA);
                }
                
                $this->index();                     

            }
        }

        public function emailVerification()
        {        
            $hash = $this->input->get('hash', TRUE);
            //$username = $this->encryption->decrypt($hash);
            $username = $this->input->get('user', TRUE);

            $data['title'] = 'Email Verification';
            $data['response_id'] = 'response_email_verification';
            $data['response_url'] = $this->config->item('base_url').'register/email/verification/resend?user='.$username.'&hash='.$hash;

            $data['body'] = $this->load->view('core/register/response', $data, true);         
            $this->load->view('layouts/layout_page_register', $data);
        }

        public function emailVerified()
        {      
            $hash = $this->input->get('hash', TRUE);
            $username = $this->encryption->decrypt($hash);


            if ($this->checkUserName($username)) {
            $data['title'] = 'Email Verified';
            $data['response_id'] = 'response_email_verified';
            $data['response_url'] = $this->config->item('base_url').'auth';

            $data['body'] = $this->load->view('core/register/response', $data, true);         
            $this->load->view('layouts/layout_page_register', $data);
            } else {
            redirect('auth','refresh');   
            }         
        }

    public function emailVerificationResend()
        {        
            $hash = $this->input->get('hash', TRUE);
            //$username = $this->encryption->decrypt($hash);
            $username = $this->input->get('user', TRUE);
                    
            if ($this->checkUserName($username)) {

            if (!$this->isUserActivated($username)) {
            if ($this->send_verification_email($username)) {
            redirect('register/email/verification?user='.$username.'&hash='.$hash,'refresh');
            } else {
            redirect('auth','refresh');     
            }
            } else {
            redirect('register/email/verified?user='.$username.'&hash='.$hash,'refresh');
            }
                
            } else {
            redirect('auth','refresh');    
            } 
        }

    public function emailVerificationAuth() 
    {   
        $hash = $this->input->get('hash', TRUE);
        //$username = $this->encryption->decrypt($hash);
        $username = $this->input->get('user', TRUE);

        if ($this->checkUserName($username)) {
            $response = $this->register->verifyEmail($username);
            if ($response) {
            redirect('register/email/verified?user='.$username.'&hash='.$hash,'refresh');
            } else {
            redirect('auth','refresh');
            }  
        } else {
            redirect('auth','refresh');
        }        
    
    }

    private function send_verification_email($username='')
    {        
        $email = $this->user->getUserMailFromUserName($username);
        
        if ($email!="") {

        $hash = $this->encryption->encrypt($username);

        try {

            $confirmation_url = $this->config->item('base_url').'register/email/verification/auth?user='.$username.'&hash='.$hash;
          
            $headers = "From: onlineCrime@gmail.com\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

            $msg = "<h1>Welcome!</h1>";
            $msg .= "</br>";
            $msg .= "<p>You have created an account with following user name.</p>";
            $msg .= "</br>";
            $msg .= "<p>User Name:".$username."</p>";
            $msg .= "</br>";
            $msg .= "<p>Please click following link to confirm your email address:</p>";
            $msg .= "</br>";
            $msg .= "<a href='".$confirmation_url."'>".$confirmation_url."</a>";

            mail($email,MAIL_HEADER,$msg,$headers);

            return true;

        }catch(Exception $e) {
            return false;
        }
        }        
    }


    public function otpVerification($data=[]) {
        $hash = $this->input->get('hash', TRUE);
        $passWord = $this->input->get('pass',TRUE);
        $username = $this->encryption->decrypt($hash);
        $userNew = $this->input->get('user',TRUE);

        $data['title'] = 'OTP Verification';
        $data['username'] = $userNew;
        $data['passWord'] = $passWord;
        $data['hash'] = $hash;
        $data['body'] = $this->load->view('core/register/confirm_otp', $data, true);         
        $this->load->view('layouts/layout_page_register', $data);
    }

    public function otpVerified()
    {      
        // $hash = $this->input->get('hash', TRUE);
        // $username = $this->encryption->decrypt($hash);


        // if ($this->checkUserName($username)) {
        // $data['title'] = 'Email Verified';
        // $data['response_id'] = 'response_email_verified';
        // $data['response_url'] = $this->config->item('base_url').'auth';

        // $data['body'] = $this->load->view('core/register/response', $data, true);         
        // $this->load->view('layouts/layout_page_register', $data);
        // } else {
        // redirect('auth','refresh');   
        // }         
    }

    public function otpVerificationResend()
    {        
        //generate random number
        $otp = rand(10000,100000);
        $hash = $this->input->get('hash', TRUE);
        $username = $this->encryption->decrypt($hash);

        $this->load->model('Auth_model');
        $results = $this->Auth_model->getPhoneNumber($username);
        $phoneNumber = '';
        foreach ($results as $row)
            {
                $phoneNumber =  $row->phone;
            }  
        $phoneNumber = '94'.$phoneNumber;

        //Save random to the user table
        $this->Auth_model->saveRandomNumber($username,$otp);                       
        $hash = $this->encryption->encrypt($username);

        $this->load->model('Otp_model');
        $OTP = new Otp_model();

        if ($OTP->send_otp($phoneNumber,$otp)) {
            $data['error_status']  = true;
            $data['error_message'] = "OTP sent to - ".$phoneNumber;            
        }else{
            $data['error_status']  = true;
            $data['error_message'] = "OTP not sent";
        }
        $this->otpVerification($data);
    }

    public function otpVerificationAuth()
    {   
        
        $otp = $this->input->post('otp');
        $username = $this->input->post('username');
        $passWord = $this->input->post('passWord');

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('otp', 'OTP', 'required');

        if ($this->form_validation->run() == FALSE)
        {   
            $this->otpVerification();
        }
        else{
            //get saved OTP from database
            $saveOTP = 0;
            $results = $this->register->getSavedOTP($username);
            foreach ($results as $row)
            {
                $saveOTP =  $row->otp;
            }

            if($saveOTP == $otp){
                //update user status
                $this->register->updateUserStatus($username);
                $_POST['username']  = $username;
                $_POST['password'] = $passWord;
                $this->login();
            }else{
                $data['error_status']  = true;
                $data['error_message'] = "Please enter correct OTP.";
                $this->otpVerification($data);
            }
        }
        
        // if ($this->checkUserName($username)) {
        //     $response = $this->register->verifyEmail($username);
        //     if ($response) {
        //     redirect('register/email/verified?hash='.$hash,'refresh');
        //     } else {
        //     redirect('auth','refresh');
        //     }  
        // } else {
        //     redirect('auth','refresh');
        // }        
    
    }

    private function send_verification_otp($username='')
    {        
        // $email = $this->user->getUserMailFromUserName($username);
        
        // if ($email!="") {

        // $hash = $this->encryption->encrypt($username);

        // try {

        //     $confirmation_url = $this->config->item('base_url').'register/email/verification/auth?hash='.$hash;
          
        //     $headers = "From: onlineCrime@gmail.com\r\n";
        //     $headers .= "MIME-Version: 1.0\r\n";
        //     $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        //     $msg = "<h1>Welcome!</h1>";
        //     $msg .= "</br>";
        //     $msg .= "<p>You have created an account with following user name.</p>";
        //     $msg .= "</br>";
        //     $msg .= "<p>User Name:".$username."</p>";
        //     $msg .= "</br>";
        //     $msg .= "<p>Please click following link to confirm your email address:</p>";
        //     $msg .= "</br>";
        //     $msg .= "<a href='".$confirmation_url."'>".$confirmation_url."</a>";

        //     mail($email,MAIL_HEADER,$msg,$headers);

        //     return true;

        // }catch(Exception $e) {
        //     return false;
        // }
        // }        
    }




    //check username already exists
    private function checkUserName($userName){
        $result = $this->register->checkUserExists($userName);
        
        if ($result->count > 0)
        { 
            return true;
        }else{
            return false;
        }
    }

     //check user already activated
    private function isUserActivated($userName){
        
        $result = $this->user->isActivated($userName);
        
        if ($result->count > 0)
        { 
            return true;
        }else{
            return false;
        }
    }

    //check email address already exists
    private function checkEmail($email){
        $results = $this->register->checkEmailExists($email);
        $counRec = 0;
        foreach ($results as $row)
        {
            $counRec =  $row->count;
        }
        if ($counRec == 0)
        { 
            return true;
        }else{
            return false;
        }

    }

    //check phone number already exists
    private function checkMobile($phone){
        $results = $this->register->checkMobileExists($phone);
        $counRec = 0;
        foreach ($results as $row)
        {
            $counRec =  $row->count;
        }
        if ($counRec == 0)
        { 
            return true;
        }else{
            return false;
        }

    }
    
}
?>