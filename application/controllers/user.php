<?php
/**
* Class:  User Controller  
* Author: Dinesh Rathnayake
* Date:   23/05/2021
*/
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'controllers/'.'Base.php');
class User extends Base{
	
	public function __construct() {
        parent::__construct();

    }

	public function index(){ 
		$data['title'] = 'Manage Users';   
        $data['permissions'] = Auth::get_session_permissions(); 
    	$data['body'] = $this->load->view('app/dashboard/app', $data, true);
    	/*print_r('<pre>');
    	print_r($data);
		print_r('</pre>');
		die;*/
    	$this->load->view('layouts/layout_page', $data); 
	}


	public function edit_user(){
		if (Auth::has_permission('USER_UPDATE_PERMISSION')){
			$data['title']        = 'Manage User';
			$data['permissions'] = Auth::get_session_permissions();
			$now = new DateTime();
        	$current_date = $now->format('Y-m-d');
        	$data['current_date'] = $current_date;

        	header("Cache-Control: no-cache, must-revalidate");
        	header("Pragma: no-cache"); 
        	header("Expires: 0");

        	$data['datepicker'] = false;
        	$data['datatables'] = true;
        	$data['dataexport'] = false;
        	$data['bootstrap_select'] = true;

        	$data['screen_name'] = "Manage Users";
        	$this->load->model('User_model');

        	$results = $this->User_model->loadDataForModify();

        	$data_array = array();
               foreach ($results as $row) {
                        $data_array[] = $row;
                }
			$data['list'] =  $data_array;
			$data['delete_modal'] = $this->load->view('app/temp/model_delete', $data, true);
			$data['update_sucess_modal'] = $this->load->view('app/temp/model_update_sucess', $data, true);
			$data['update_error_Modal'] = $this->load->view('app/temp/model_update_error', $data, true);
			$data['body'] = $this->load->view('core/user/manage_user', $data, true); 
			$this->load->view('layouts/layout_page', $data);

		}else{
			$this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED); 
		}

	}

	//Delete Users
	public function deleteData(){
    	$data['id'] = $_GET['id'];
		$data['delete_user'] = $_SESSION['user_name'];
        $data['delete_date'] = $this->get_current_date();
        $data['delete_time'] = $this->get_current_time();
		$this->load->model('User_model');
		$status = $this->User_model->deleteData($data);
		return $status;
    }

    //update users
    public function updateUser(){
    	if (Auth::has_permission('USER_UPDATE_PERMISSION')) {
    		$id = $_POST['userId'];
      		$data['id'] = $id;
			$data['title']        = 'Update User';  
			$data['permissions']  = Auth::get_session_permissions();

			$this->load->model('User_model');

			//Get User Roles
			$results = $this->User_model->getUserTypes();
    		$data_array = array();
               foreach ($results as $row) {
                        $data_array[] = $row;
                }
			$data['userTypes'] =  $data_array;

			//Get User Police Stations
			$results2 = $this->User_model->getPoliceStation();
    		$data_array2 = array();
               foreach ($results2 as $row) {
                        $data_array2[] = $row;
                }
			$data['policeStation'] =  $data_array2;

    		$resultsNew = $this->User_model->loadDataForUpdate($id);
    		$data['list'] =  $resultsNew;
			$data['body'] = $this->load->view('core/user/update_user', $data, true); 
			$this->load->view('layouts/layout_page', $data);
    	}else{
    		$this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED); 
    	}

    }

    //update database
    public function updateUserData(){
    	$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('fName', 'First Name', 'required');               
        $this->form_validation->set_rules('lName', 'Last Name', 'required');
        $this->form_validation->set_rules('eMail', 'E-Mail', 'required');
        $this->form_validation->set_rules('mobile', 'Phone Number', 'required');

        $eMail = trim($this->input->post('eMail'));
        $phone = trim($this->input->post('mobile'));
        $id = $this->input->post('id'); 

        if(!$this->checkEmail($eMail,$id)){
            $this->form_validation->set_rules('eMail', 'E-Mail', 'callback_email_check');
            $this->form_validation->set_message('email_check', 'E-Mail Already Exists.');
        }
        if(!$this->checkMobile($phone,$id)){
            $this->form_validation->set_rules('mobile', 'Pnone No', 'callback_mobile_check');
            $this->form_validation->set_message('mobile_check', 'Phone Number Already Exists.');
        }

        if ($this->form_validation->run() == FALSE){
                $_POST['userId'] = $this->input->post('id'); 
                $this->updateUser();
        }else{
        	        $data['id'] = $this->input->post('id');
                	$data['firstname'] = trim($this->input->post('fName'));
                    $data['lastname'] = trim($this->input->post('lName'));
                    $data['email'] = trim($this->input->post('eMail'));
                    $data['phone'] = $this->input->post('mobile');
                    $data['rollid'] = $this->input->post('userselector');
                    $data['police_station'] = $this->input->post('policeselector');

                    $this->load->model('User_model');
                    $numRows = $this->User_model->updateUser($data);

                    if($numRows > 0){
                      $this->session->set_flashdata('success', 'Complain '. SC_MSG_FOR_UPDATE);
                    }
                    else{
                         $this->session->set_flashdata('error', ER_MSG_FOR_UPDATE_DATA);
                    }

                    $this-> edit_user();
        }
    }

   //Approve Pending Users
	public function approve_user(){
		if (Auth::has_permission('USER_APPROVE_PERMISSION')) {
            $data['title']        = 'Approve User';
            $data['permissions'] = Auth::get_session_permissions();
            $now = new DateTime();
            $current_date = $now->format('Y-m-d');
            $data['current_date'] = $current_date;

            header("Cache-Control: no-cache, must-revalidate");
            header("Pragma: no-cache"); 
            header("Expires: 0");

            $data['datepicker'] = false;
            $data['datatables'] = true;
            $data['dataexport'] = false;
            $data['bootstrap_select'] = true;

            $data['screen_name'] = "Approve Users";
            $data['screen_name2'] = "Assign Users";

            $this->load->model('User_model');
            $results = $this->User_model->vieWPendingUsers();
            $data_array = array();
               foreach ($results as $row) {
                        $data_array[] = $row;
                }
            $data['list'] =  $data_array;

            $results3 = $this->User_model->viewAssignPendingUsers();
            $data_array3 = array();
               foreach ($results3 as $row) {
                        $data_array3[] = $row;
                }

             if (count($data_array3) > 0){   
                $data['list3'] =  $data_array3;
             }

            $policeList = $this->User_model->listPoliceStations();
                $data_array2 = array();
                foreach ($policeList as $row) {
                        $data_array2[] = $row;
                }
            $data['list2'] =  $data_array2;
            $data['police_modal'] = $this->load->view('app/temp/model_assign_police_user', $data, true);

            $data['confrm_modal'] = $this->load->view('app/temp/model_conf', $data, true);
            $data['reject_modal'] = $this->load->view('app/temp/model_reject_user', $data, true);
            $data['body'] = $this->load->view('core/user/view_users', $data, true); 
            $this->load->view('layouts/layout_page', $data); 

        }else{
            $this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED);   
        }
	}

    //Approve users
    public function approveData(){        
        $data['id'] = $_GET['id'];
        $data['approve_date'] = $this->get_current_date();
        $data['approve_time'] = $this->get_current_time();
        $this->load->model('User_model');
        $status = $this->User_model->approveData($data);

        //send email to the user
        try {
            $headers = "From: onlineCrime@gmail.com\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

            $email = $this->User_model->getUserMail($data['id']);

            $msg = "<h4>Dear User</h4>";
            $msg .= "</br>";
            $msg .= "<p>".USER_ACCOUNT_APPROVE."</p>";
            mail($email,MAIL_HEADER,$msg, $headers);
        }catch(Exception $e) {
            echo $e->getMessage();
        }    
        return $status;        
    }
    
    //Reject users
    public function rejectData(){
        $data['id'] = $_POST['userId'];
        $data['message'] = $_POST['message'];
        $data['reject_user'] = $_SESSION['user_name'];
        $data['reject_date'] = $this->get_current_date();
        $data['reject_time'] = $this->get_current_time();
        $this->load->model('User_model');
        $status = $this->User_model->rejectData($data);

        //send email to the user
        try {
            $headers = "From: onlineCrime@gmail.com\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

            $email = $this->User_model->getUserMail($data['id']);

            $msg = "<h4>Dear User</h4>";
            $msg .= "</br>";
            $msg .= "<p>".USER_ACCOUNT_REJECT."</p>";
            mail($email,MAIL_HEADER,$msg,$headers);

        }catch(Exception $e) {
            echo $e->getMessage();
        }

        $this->approve_user();
    }

    //Assign Police Officer and Police OIC to the police station
	public function assign_user(){
		if (Auth::has_permission('USER_APPROVE_PERMISSION')) {
            $data['title']  = 'Assign User';
            $data['permissions'] = Auth::get_session_permissions();
            $now = new DateTime();
            $current_date = $now->format('Y-m-d');
            $data['current_date'] = $current_date;

            header("Cache-Control: no-cache, must-revalidate");
            header("Pragma: no-cache"); 
            header("Expires: 0");

            $data['datepicker'] = false;
            $data['datatables'] = true;
            $data['dataexport'] = false;
            $data['bootstrap_select'] = true;

            $data['screen_name'] = "Assign User";

            $this->load->model('User_model'); 
            $results = $this->User_model->viewAssignPendingUsers();
            $data_array = array(); 
               foreach ($results as $row) {
                        $data_array[] = $row;
                }
            $data['list'] =  $data_array;

            $policeList = $this->User_model->listPoliceStations();
                $data_array2 = array();
                foreach ($policeList as $row) {
                        $data_array2[] = $row;
                }
            $data['list2'] =  $data_array2;
            $data['police_modal'] = $this->load->view('app/temp/model_assign_police_user', $data, true);
            
            $data['body'] = $this->load->view('core/user/assign_user', $data, true); 
            $this->load->view('layouts/layout_page', $data); 
        }else{
            $this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED);   
        }
	}

    //Assign complain to the police station to the user
    public function assignPolice(){
         $this->load->helper(array('form', 'url'));

         $this->load->library('form_validation');

         $this->form_validation->set_rules('policeStation', 'Police Station', 'required');
         $policeStation =  trim($this->input->post('policeStation'));
          if($policeStation == 0){
                  $this->form_validation->set_rules('policeStation', 'Police Station', 'callback_policeStation_check');
                  $this->form_validation->set_message('policeStation_check', 'Please select police station.');
           }
          if ($this->form_validation->run() == FALSE)
             {   
                
                   $this->assign_user();
             }
          else{

             $data['policeStation'] = $_POST['policeStation'];
             $data['userId'] = $_POST['userId2'];
             $data['rollId'] = $_SESSION['roll_id']; 
             $this->load->model('User_model');
             $numRows = $this->User_model->assignPolice($data);
             //send email when assign to the police station
             if ($numRows >0){
             try {
                $headers = "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

                $email = $this->User_model->getUserMail($_POST['userId2']);

                $this->load->model('Police_model');
                $policeData = $this->Police_model->loadDataForUpdate($_POST['policeStation']);


                $msg = "<h4>Dear Officer</h4>";
                $msg .= "</br>";
                $msg .= "<p>".ASSIGN_OFFICER_TO_POLICE."</p>";
                $msg .= "</br>";
                $msg .= "<table border='1' style='border-collapse:collapse'>";
                $msg .= "<tr>";
                $msg .= "<th>Name</th>";
                $msg .= "<td>".$policeData[0]->name."</td>";
                $msg .= "</tr>";
                $msg .= "<tr>";
                $msg .= "<th>Address</th>";
                $msg .= "<td>".$policeData[0]->address."</td>";
                $msg .= "</tr>";
                $msg .= "<tr>";
                $msg .= "<th>Contact Number</th>";
                $msg .= "<td>".$policeData[0]->phone."</td>";
                $msg .= "</tr>";;
                $msg .= "</table>";
                mail($email,MAIL_HEADER,$msg,$headers);

            }catch(Exception $e) {
                echo "<pre>";
                echo $e->getMessage();
                echo "</pre>";
                die;
            }
        }
             $this->approve_user();
        }
    }

    //check email address already exists
    private function checkEmail($email,$id){
        $this->load->model('User_model');
        $results = $this->User_model->checkEmailExists($email,$id);
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
    private function checkMobile($phone,$id){
        $this->load->model('User_model');
        $results = $this->User_model->checkMobileExists($phone,$id);
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