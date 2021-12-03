<?php
/**
* Class:  Auth Controller 
* Author: Dinesh Rathnayake
* Date:   23/05/2021
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {


    private $message;
    private $authuser;
    private $authresponse;    
    private $reset;
    private $authModel;
    private $user_name;

	public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->authModel = new Auth_model();
        $this->reset = false;
    }
	 public function index() 
    {
        #redirect to dashbaord if already logged in
        if (Auth::auth_user()) {
             redirect($this->config->item('app_redirect_to'), 'refresh'); 
        }

        $data['title'] = 'Login';
        $data['body'] = $this->load->view('core/auth/login', $data, true);  
        $this->load->view('core/auth/layout', $data);         
    }

    public function login()
    {
        if (Auth::auth_user()) {
            redirect($this->config->item('app_redirect_to'), 'refresh'); 
        }
        
        if($this->attempt()){
            if ($this->config->item('app_reset_on_timeout')) {
                if (!$this->is_session_exist()) {
                    $this->manage_session();
                    $this->__redirect();
                }else{
                    #auto reset and relog user when session has timedout
                    $this->authModel->reset_user_logs($this->user_name);
                    $this->manage_session();
                    $this->__redirect();
                }
            }else{
                $this->manage_session();
                $this->__redirect();
            }
        }else{
            $this->failed_attempt(true);
        }
    }


    public static function auth_user() 
    {   
        if ((isset($_SESSION['logged_in']) && $_SESSION['logged_in']) ) {
        return true;
        } else {
        return false;
        }
    } 

    //check password with database
    private function attempt(){
        $userName = trim($this->input->post('username'));
        $passWord = trim($this->input->post('password'));
        $userStatus = $this->checkUserStatus($userName);
        $mailVerified = $this->checkMailVerified($userName);
        $this->user_name = $userName;

            if(empty($userName) && empty($passWord) ){
                 $this->message = ER_MSG_REQUIRED_FIELD_USERNAME_PASSWORD;
                return false;
            }
            else if(empty($userName)){
                $this->message = ER_MSG_REQUIRED_FIELD_USERNAME;
                return false;
            }elseif (empty($passWord)) {
                $this->message = ER_MSG_REQUIRED_FIELD_PASSWORD;
                return false;
            }else if(strlen($userName) > 10){
                $this->message = ER_MSG_INVALID_USERNAME;
                return false;
            }else if(!empty($userStatus) &&  $userStatus == 'P' && $mailVerified == 'Y' ){
                //send otp to verify phone number
                $results = $this->authModel->getUserPassword($userName);
                $dbPass = "";
                foreach ($results as $row)
                {
                    $dbPass =  $row->password;
                }
                if($dbPass != ""){
                  if(password_verify($passWord,$dbPass)){
                      //generate random number
                      $otp = rand(10000,100000);
                      //Save random to the user table
                      
                      $this->authModel->saveRandomNumber($userName,$otp);                       
                      $hash = $this->encryption->encrypt($userName);

                      //get user phone number
                      $results = $this->authModel->getPhoneNumber($userName);
                      $phoneNumber = '';
                      foreach ($results as $row)
                       {
                            $phoneNumber =  $row->phone;
                       }  
                       $phoneNumber = '94'.$phoneNumber;

                      $this->load->model('Otp_model');
                      $OTP = new Otp_model();
                      if ($OTP->send_otp($phoneNumber,$otp)) {
                        redirect('register/otp/verification?hash='.$hash.'&user='.$userName.'&pass='.$passWord,'refresh');                             
                      } else {
                      redirect('auth','refresh');       
                      }



                      // load page to enter otp
                    }else{
                         $this->message = ER_MSG_INVALID_PASSWORD;
                         return false;
                    }
                }else{
                    $this->message = ER_MSG_USER_NOT_EXISTS;
                    return false;
                } 
            }else if(!empty($userStatus) &&  $userStatus != 'A' ){
                $this->message = ER_MSG_ACCOUNT_NOT_ACTIVATE;
                return false;
            }
            else{
                $results = $this->authModel->getUserPassword($userName);
                $dbPass = "";
                foreach ($results as $row)
                {
                    $dbPass =  $row->password;
                }
                if($dbPass != ""){
                  if(password_verify($passWord,$dbPass)){
                    $results = $this->authModel->getUserData($userName);
                    $data_array = array();
                    foreach ($results as $row) {
                        $data_array[] = $row;
                        
                    }
                    $this->authresponse = json_encode($data_array);
                   
                    //echo '<pre>';
                    //    echo $this->authresponse;
                    //echo '</pre>';
                     return true;
                    }else{
                         $this->message = ER_MSG_INVALID_PASSWORD;
                         return false;
                    }
                }else{
                    $this->message = ER_MSG_USER_NOT_EXISTS;
                    return false;
                }  
              }
                
            
       
    }

    private function failed_attempt($failed=true, $reset=false)
    {
        if ($failed) {
        #destroy session if there is an error  
            $this->session->sess_destroy(); 
            $data['header'] = $this->config->item('app_name'); 

            $data['error_status']  = true;
            $data['error_message'] = $this->message;
           
            $data['username'] = trim($this->input->post('username'));
            $data['password'] = trim($this->input->post('password'));

            $data['title'] = 'Login';     
            $data['body'] = $this->load->view('core/auth/login', $data, true);  
            $this->load->view('core/auth/layout', $data); 
        } else {   
            redirect('auth', 'refresh');  
        }
    }

    //Get the permissions from session
    public static function get_session_permissions()
    {
        if (isset($_SESSION['permissions'])) {
            $permissionsArray = (array) $_SESSION['permissions'];
        } else {
            $permissionsArray = [];
        }

        return $permissionsArray;
    }

    //Redirect to
    private function __redirect()
    {
        #update user logs here
        $this->authModel->update_user_logs('in');
        redirect($this->config->item('app_redirect_to'), 'refresh'); 
    }

    //Set the session attributes
    private function manage_session() 
    {
        if (isset($this->authresponse)) {
            $first_name = "";
            $last_name="";
            $module;
            $roll_id;
            $roll_name;
            $permissions;
            $user_id;
            $arr = json_decode($this->authresponse,true);

            foreach($arr as $item) { 
                    $user_id = $item['user_id'];
                    $first_name = $item["firstname"]; 
                    $last_name = $item["lastname"];
                    $moduleName = trim(strtoupper($item["module_name"])); 
                    $roll_id = $item["roll_id"];
                    $roll_name = $item["roll_name"];
                    $police_station = $item["police_station"];

                    $permissions['MODULE_ID'] =  $item["module_id"]; 
                    $permissions['MODULE_NAME'] =  $moduleName;
                    $permissions[$moduleName.'_STATUS'] =  $item["status"];
                    $permissions[$moduleName.'_READ_PERMISSION'] =  $item["read_permission"];
                    $permissions[$moduleName.'_WRITE_PERMISSION'] =  $item["write_permission"];
                    $permissions[$moduleName.'_UPDATE_PERMISSION'] =  $item["update_permission"];
                    $permissions[$moduleName.'_DELETE_PERMISSION'] =  $item["delete_permission"];
                    $permissions[$moduleName.'_APPROVE_PERMISSION'] =  $item["approve_permission"];
                    $permissions[$moduleName.'_ASSIGN_PERMISSION'] =  $item["assign_permission"];
            }
            $auth['permissions'] = $permissions;
            
            if($this->user_name != ""){
                $auth['user_name']   = trim(strtoupper($this->user_name));
            }else{
                $auth['user_name'] ="";
            }

            if($first_name != ""){
                $auth['first_name']   = trim(strtoupper($first_name));
            }else{
                $auth['first_name'] ="";
            }

            if($last_name != ""){
                $auth['last_name']   = trim(strtoupper($last_name));
            }else{
                $auth['last_name'] ="";
            }
            
            $auth['roll_id']  = $roll_id;
            $auth['roll_name']  = $roll_name;
            $auth['police_station'] = $police_station;
            $auth['user_id'] = $user_id;
            
            $auth['logged_in']         = true;
            $auth['logged_in_on']      = $this->get_current_date();
            $auth['logged_in_at']      = $this->get_current_time();

            $this->session->set_userdata($auth); 

            /*print_r('<pre>');
            print_r($auth);
            print_r('</pre>');
            die; */              
        }  
    }

    protected function get_current_date() 
    {
        $now = new DateTime();
        return $now->format('Y-m-d'); 
    }

    protected function get_current_time() 
    {
        $now = new DateTime();
        return $now->format('H:i:s'); 
    }

    //logout from the application
    public function logout() 
    {
        #update user logs
        $this->authModel->update_user_logs('out');
        $this->session->sess_destroy();     
        redirect('auth', 'refresh');  
    }

    //check session exists
    private function is_session_exist()
    {
        $usersession = $this->authModel->is_session_exist($this->user_name);

        if ($usersession) {
        $this->reset   = true;
        return true;
        } else {        
        return false;
        }
    }

    //Check user has permission for specific task
    public static function has_permission($permission_key='') 
    {      
        if ($permission_key == '') {
            return false;        
        } else {

        if (isset($_SESSION['permissions'])) {
        $permissionsArray = (array) $_SESSION['permissions'];
        } else {
            return false;
        }            

        if (isset($permissionsArray) && isset($permissionsArray[$permission_key]) && $permissionsArray[$permission_key]==1) {
            return true;
        } else {
            return false;
        }
        
        } 
    }

    //check user status
    private function checkUserStatus($userName){

        $results = $this->authModel->getUserStatus($userName);
        $ststus = '';
        foreach ($results as $row)
        {
            $ststus =  $row->status;
        }
        return $ststus;
    }

    //check email verified
    private function checkMailVerified($userName){

        $results = $this->authModel->checkMailVerified($userName);
        $mailVerified = '';
        foreach ($results as $row)
        {
            $mailVerified =  $row->emailVerified;
        }
        return $mailVerified;
    }

    //redirect to page when change password link click
    public function change_password(){
        $data['title'] = 'Change Password';
        $data['body'] = $this->load->view('core/auth/change', $data, true);  
        $this->load->view('core/auth/layout', $data); 
    }

    //change password
    public function change(){
         $this->load->helper(array('form', 'url'));
         $this->load->library('form_validation');
         $this->form_validation->set_rules('username', 'User Name', 'required|max_length[10]');
         $this->form_validation->set_rules('password', 'Password', 'required');
         $this->form_validation->set_rules('newPassword', 'New Password', 'required');
         $this->form_validation->set_rules('confPassword', 'Confirm Password', 'required');
         $this->form_validation->set_rules('confPassword', 'Password Confirmation', 'required|matches[newPassword]');

         if ($this->form_validation->run() == FALSE)
          {   
                $this->change_password();
          }
          else{
            $usName = trim($this->input->post('username'));
            $passWord = trim($this->input->post('password'));
            $newPassword = trim($this->input->post('newPassword'));
            $conPassword = trim($this->input->post('confPassword'));

            $results = $this->authModel->getUserPassword($usName);
                $dbPass = "";
                foreach ($results as $row)
                {
                    $dbPass =  $row->password;
                }
                 if($dbPass != ""){
                  if(password_verify($passWord,$dbPass)){
                    
                    //Get the hash of the password
                    $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);
                    //update password
                    $results = $this->authModel->updatePassword($usName,$hashed_password);
                    if($results>0){
                        //sucessfully changed password
                        $data['error_status']  = true;
                        $data['error_message'] = 'password '.SC_MSG_FOR_UPDATE;
                        $data['title'] = 'Login';
                        $data['body'] = $this->load->view('core/auth/login', $data, true);  
                        $this->load->view('core/auth/layout', $data); 
                    }else{
                        $this->message = ER_MSG_FOR_UPDATE_DATA;
                         $this->fail_change(true);
                    }
                    }else{
                         $this->message = ER_MSG_INVALID_PASSWORD;
                         $this->fail_change(true);
                    }
                }else{
                    $this->message = ER_MSG_USER_NOT_EXISTS;
                    $this->fail_change(true);
                }
            }
    }

    //unable to change the password
    private function fail_change(){
            $data['error_status']  = true;
            $data['error_message'] = $this->message;
           
            $data['username'] = trim($this->input->post('username'));
            $data['password'] = trim($this->input->post('password'));

            $data['title'] = 'Change Password';     
            $data['body'] = $this->load->view('core/auth/change', $data, true);  
            $this->load->view('core/auth/layout', $data); 
    }

    //get the dash board counts
    public function getCounts(){
        $rollId = $_SESSION['roll_id']; 
        $user_id = $_SESSION['user_id'];
        $userName = $_SESSION['user_name'];
        $police_station = $_SESSION['police_station'];

        $results = $this->authModel->getCounts($rollId,$user_id,$userName,$police_station);

       return $results; 

    }

    
}

?>
