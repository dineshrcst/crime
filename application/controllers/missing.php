<?php
/**
* Class:  Missing Controller 
* Author: Dinesh Rathnayake
* Date:   07/06/2021
*/
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'controllers/'.'Base.php');
class Missing extends Base{
	
	public function __construct() {
        parent::__construct();

    }

	public function index(){
		$data['title'] = 'Manage Missing Persons';   
        $data['permissions'] = Auth::get_session_permissions(); 
    	$data['body'] = $this->load->view('app/dashboard/app', $data, true);
    	/*print_r('<pre>');
    	print_r($data);
		print_r('</pre>');
		die;*/
    	$this->load->view('layouts/layout_page', $data); 
	}

	public function new_person(){
		if (Auth::has_permission('MISSING_PERSON_WRITE_PERMISSION')) {
			$data['title']        = 'New Person';  
			$data['permissions']  = Auth::get_session_permissions();

			$this->load->model('User_model');
    		$results = $this->User_model->listPoliceStations();
    		$data_array = array();
               foreach ($results as $row) {
                        $data_array[] = $row;
                }
			$data['police'] =  $data_array;
	
			$data['body'] = $this->load->view('core/missing/missing_create', $data, true);   
			$this->load->view('layouts/layout_page', $data);  
		}else{
			 $this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED); 
		}

	}

	//Save missing Person details to the database
	public function savePerson(){
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('cdate', 'Missing From', 'required');
        $this->form_validation->set_rules('phone', 'Phone Number', 'trim|required|min_length[10]|max_length[10]');
        $this->form_validation->set_rules('policeselector', 'Nearest Police Station', 'required');
        
          $policeStation =  trim($this->input->post('policeselector'));
          if($policeStation == 0){
                $this->form_validation->set_rules('policeselector', 'Police Station', 'callback_police_check');
                $this->form_validation->set_message('police_check', 'Please select Nearest Police Station.');
        	}

       // $this->form_validation->set_rules('fileToUpload', 'Image', 'required');
        
        
        if ($this->form_validation->run() == FALSE){

            $this->new_person();
        }else{
        	$this->load->model('Missing_model');
        	$data['name'] = trim($this->input->post('name'));
        	$data['address'] = trim($this->input->post('address'));
            $data['description'] = trim($this->input->post('description'));
            $data['missing_from'] = $this->input->post('cdate');
            $data['contact'] = $this->input->post('phone');
            $data['police_station'] = $this->input->post('policeselector');

            $roll_id =  $_SESSION['roll_id'];
            if($roll_id == 1 OR $roll_id == 2){
                $data['status'] = 'A';
            } else{
                $data['status'] = 'P';
            }
            $data['enter_user'] = $_SESSION['user_name'];
            $data['enter_date'] = $this->get_current_date();
            $data['enter_time'] = $this->get_current_time();

            $maxId = $this->Missing_model->getMaxId();
            $newId = $maxId +1;

            //Upload the file
            $target_dir = $this->config->item('missing_path');
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

			$name2 = $newId.'.'.$imageFileType;

			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
			  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			  if($check != false) {
			    $uploadOk = 1;
			  } else {
			    $this->session->set_flashdata('error', "File is not an image.");
			    $uploadOk = 0;
			  }
			}

			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			   && $imageFileType != "gif" ) {
  				$this->session->set_flashdata('error',"Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
 				$uploadOk = 0;
			}

			$newName = $target_dir.$newId.'.'.$imageFileType;

			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			  $this->session->set_flashdata('error', 'Error in upload File');
			} else {
			  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $newName)) {
			    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
			    $data['image_name'] = $name2;
			    $data['image_type'] = $imageFileType;

			    $insertId=$this->Missing_model->saveMissingData($data);
			     if($insertId > 0){
                    	$this->session->set_flashdata('success', 'Missing Person '. SC_MSG_FOR_CREATION);
                }else{
                        $this->session->set_flashdata('error', ER_MSG_FOR_SAVE_DATA);
                } 
			  } else {
			    	    $this->session->set_flashdata('error', ER_MSG_FOR_SAVE_DATA);
			  }
			}
			$this->new_person();
        }
	}


	//Approve Missing Person requests
	public function approve_person(){
		if (Auth::has_permission('MISSING_PERSON_APPROVE_PERMISSION')) {
      		$data['title'] = 'Approve Missing Persons';
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

        	$data['screen_name'] = "Approve Missing Persons";

        	$this->load->model('Missing_model');
    		$results = $this->Missing_model->vieWPendingPersons();
    		$data_array = array();
               foreach ($results as $row) {
                        $data_array[] = $row;
                }
			$data['list'] =  $data_array;

			$data['confrm_modal'] = $this->load->view('app/temp/model_conf', $data, true);
			$data['reject_modal'] = $this->load->view('app/temp/model_reject_person', $data, true);
      		$data['slider_Modal'] = $this->load->view('app/temp/model_image_slider', $data, true);
			$data['body'] = $this->load->view('core/missing/missing_approve', $data, true); 
			$this->load->view('layouts/layout_page', $data); 

		}else{
			$this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED);   
		}
	}

	//Reject Person with reason
	public function rejectData(){
		$data['id'] = $_POST['comId'];
		$data['message'] = $_POST['message'];
        $data['reject_date'] = $this->get_current_date();
        $data['reject_time'] = $this->get_current_time();
		$this->load->model('Missing_model');
		$status = $this->Missing_model->rejectData($data);
		$this->approve_person();
	}

	//Approve Missing Persons
	public function approveData(){
		$data['id'] = $_GET['id'];
        $data['approve_date'] = $this->get_current_date();
        $data['approve_time'] = $this->get_current_time();
		$this->load->model('Missing_model');
		$status = $this->Missing_model->approveData($data);
		return $status;
	}

	public function view_person(){
		if (Auth::has_permission('MISSING_PERSON_READ_PERMISSION')) {
      		$data['title'] = 'View Missing Persons';
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

        	$data['screen_name'] = "View Missing Persons";

        	$this->load->model('Missing_model');
    		$results = $this->Missing_model->viewMissingPersons();
    		$data_array = array();
               foreach ($results as $row) { 
                        $data_array[] = $row;
                }
			$data['list'] =  $data_array;
      		$data['info_Modal'] = $this->load->view('app/temp/model_show_details', $data, true);
			$data['body'] = $this->load->view('core/missing/missing_view', $data, true); 
			$this->load->view('layouts/layout_page', $data); 

		}else{
			$this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED);   
		}
	}

	//update and delete missing persom details
	public function edit_person(){
		if (Auth::has_permission('MISSING_PERSON_UPDATE_PERMISSION')){
			$data['permissions'] = Auth::get_session_permissions();
      		$data['title']        = 'Manage Missing Persons';
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

        	$data['screen_name'] = "Manage Missing Persons";

        	$this->load->model('Missing_model');
        	$results = $this->Missing_model->loadDataForModify();

        	$data_array = array();
               foreach ($results as $row) {
                        $data_array[] = $row;
                }
			$data['list'] =  $data_array;

			$data['delete_modal'] = $this->load->view('app/temp/model_delete', $data, true);
      		$data['update_sucess_modal'] = $this->load->view('app/temp/model_update_sucess', $data, true);
      		$data['update_error_Modal'] = $this->load->view('app/temp/model_update_error', $data, true);
      		$data['slider_Modal'] = $this->load->view('app/temp/model_image_slider', $data, true);
			$data['body'] = $this->load->view('core/missing/missing_manage', $data, true); 
			$this->load->view('layouts/layout_page', $data);
		}else{
			$this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED);   
		}
	}

	//Update missing person details
	public function updatePerson(){

    	if (Auth::has_permission('MISSING_PERSON_UPDATE_PERMISSION')) {
    		$id = $_POST['comId'];
      		$data['id'] = $id;
			$data['title']        = 'Update Missing Person';  
			$data['permissions']  = Auth::get_session_permissions();

    		$this->load->model('User_model');
    		$results = $this->User_model->listPoliceStations();
    		$data_array = array();
               foreach ($results as $row) {
                        $data_array[] = $row;
                }
			$data['police'] =  $data_array;


        	$this->load->model('Missing_model');
			$resultsNew = $this->Missing_model->loadDataForUpdate($id);

			$data['list'] =  $resultsNew;
			$data['slider_Modal'] = $this->load->view('app/temp/model_image_slider', $data, true);
			$data['body'] = $this->load->view('core/missing/missing_update', $data, true); 
			$this->load->view('layouts/layout_page', $data);

    	}else{
			$this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED);  		
    	}
	}

	//update record to the database
	public function update(){
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('cdate', 'Missing From', 'required');
        $this->form_validation->set_rules('phone', 'Phone Number', 'trim|required|min_length[9]|max_length[10]');
        $this->form_validation->set_rules('policeselector', 'Nearest Police Station', 'required');
        
          $policeStation =  trim($this->input->post('policeselector'));
          if($policeStation == 0){
                $this->form_validation->set_rules('policeselector', 'Police Station', 'callback_police_check');
                $this->form_validation->set_message('police_check', 'Please select Nearest Police Station.');
        	}

       // $this->form_validation->set_rules('fileToUpload', 'Image', 'required');       
        if ($this->form_validation->run() == FALSE){
        	$_POST['comId']  = $this->input->post('id');
            $this->updatePerson();
        }else{
        	$this->load->model('Missing_model');
            $data['id'] = $this->input->post('id');
        	$data['name'] = trim($this->input->post('name'));
        	$data['address'] = trim($this->input->post('address'));
            $data['description'] = trim($this->input->post('description'));
            $data['missing_from'] = $this->input->post('cdate');
            $data['contact'] = $this->input->post('phone');
            $data['police_station'] = $this->input->post('policeselector');
            $data['status'] = 'M';
            $data['modify_user'] = $_SESSION['user_name'];
            $data['modify_date'] = $this->get_current_date();
            $data['modify_time'] = $this->get_current_time();

            //check image is modofied
            $imageName = basename($_FILES["fileToUpload"]["name"]);
            if($imageName == ''){
            	$data['image_name'] = "";
                $data['image_type'] = "";
            }else{
                $newId = $this->input->post('id');
            	 //Upload the file
                $target_dir = $this->config->item('missing_path');
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                 $name2 = $newId.'.'.$imageFileType;

                // Check if image file is a actual image or fake image
                if(isset($_POST["submit"])) {
                  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                  if($check !== false) {
                    $uploadOk = 1;
                  } else {
                    $this->session->set_flashdata('error', "File is not an image.");
                    $uploadOk = 0;
                  }
                }

                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                   && $imageFileType != "gif" ) {
                    $this->session->set_flashdata('error',"Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
                    $uploadOk = 0;
                }

                $newName = $target_dir.$newId.'.'.$imageFileType;

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                  $this->session->set_flashdata('error', 'Error in upload File');
                } else {
                  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $newName)) {
                    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                    $data['image_name'] = $name2;
                    $data['image_type'] = $imageFileType;
                   }else{
                    $data['image_name'] = "";
                    $data['image_type'] = "";
                   }
                }
            }
            //update record to the database
            $numRecords=$this->Missing_model->updateMissingData($data);
             if($numRecords > 0){
                  $this->session->set_flashdata('success', 'Missing Person '. SC_MSG_FOR_UPDATE);
              }else{
                  $this->session->set_flashdata('error', ER_MSG_FOR_UPDATE_DATA);
              }
              $this->edit_person(); 
        }
	}
	//delete missing persons
	public function deleteData(){
		$data['id'] = $_GET['id'];
        $data['delete_user'] = $_SESSION['user_name'];
        $data['delete_date'] = $this->get_current_date();
        $data['delete_time'] = $this->get_current_time();
        $this->load->model('Missing_model');
        $status = $this->Missing_model->deleteData($data);
        return $status;
	}

} 
?>