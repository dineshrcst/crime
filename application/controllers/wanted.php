<?php
/**
* Class:  Wanted Controller 
* Author: Dinesh Rathnayake
* Date:   20/09/2021
*/
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'controllers/'.'Base.php');
class Wanted extends Base{
	
	public function __construct() {
        parent::__construct();

    }

	public function index(){
		$data['title'] = 'Manage Wanted Persons';   
        $data['permissions'] = Auth::get_session_permissions(); 
    	$data['body'] = $this->load->view('app/dashboard/app', $data, true);
    	$this->load->view('layouts/layout_page', $data); 
	}

	public function new_person(){
		if (Auth::has_permission('MOST_WANTED_WRITE_PERMISSION')) {
			$data['title']        = 'New Person';  
			$data['permissions']  = Auth::get_session_permissions();

			$this->load->model('User_model');
    		$results = $this->User_model->listPoliceStations();
    		$data_array = array();
               foreach ($results as $row) {
                        $data_array[] = $row;
                }
			$data['police'] =  $data_array;
	
			$data['body'] = $this->load->view('core/wanted/wanted_create', $data, true);   
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
        $this->form_validation->set_rules('age', 'Age', 'trim|required|min_length[1]|max_length[2]');
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
        	$this->load->model('Wanted_model');
        	$data['name'] = trim($this->input->post('name'));
        	$data['age'] = $this->input->post('age');
            $data['sex'] = $this->input->post('sex');
            $data['aliases'] = trim($this->input->post('aliases'));
            $data['remarks'] = trim($this->input->post('remarks'));
            $data['caution'] = trim($this->input->post('caution'));
            $data['police_station'] = $this->input->post('policeselector');            
            $data['status'] = 'A';
            $data['enter_user'] = $_SESSION['user_name'];
            $data['enter_date'] = $this->get_current_date();
            $data['enter_time'] = $this->get_current_time();

            $maxId = $this->Wanted_model->getMaxId();
            $newId = $maxId +1;

            //Upload the file
            $target_dir = $this->config->item('wanted_path');
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

			    $insertId=$this->Wanted_model->saveWantedData($data);
			     if($insertId > 0){
                    	$this->session->set_flashdata('success', 'Most Wanted Person '. SC_MSG_FOR_CREATION);
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

	public function view_person(){
		if (Auth::has_permission('MOST_WANTED_READ_PERMISSION')) {
      		$data['title'] = 'View Most Wanted Persons';
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

        	$data['screen_name'] = "View Most Wanted Persons";

        	$this->load->model('Wanted_model');
    		$results = $this->Wanted_model->viewWantedPersons();
    		$data_array = array();
               foreach ($results as $row) { 
                        $data_array[] = $row;
                }
			$data['list'] =  $data_array;
      		$data['info_Modal'] = $this->load->view('app/temp/model_show_details', $data, true);
			$data['body'] = $this->load->view('core/wanted/wanted_view', $data, true); 
			$this->load->view('layouts/layout_page', $data); 

		}else{
			$this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED);   
		}
	}

	//update and delete missing persom details
	public function edit_person(){
		if (Auth::has_permission('MOST_WANTED_UPDATE_PERMISSION')){
			$data['permissions'] = Auth::get_session_permissions();
      		$data['title']        = 'Manage Most Wanted Persons';
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

        	$data['screen_name'] = "Manage Most Wanted Persons";

        	$this->load->model('Wanted_model');
        	$results = $this->Wanted_model->loadDataForModify();

        	$data_array = array();
               foreach ($results as $row) {
                        $data_array[] = $row;
                }
			$data['list'] =  $data_array;

			$data['delete_modal'] = $this->load->view('app/temp/model_delete', $data, true);
      		$data['update_sucess_modal'] = $this->load->view('app/temp/model_update_sucess', $data, true);
      		$data['update_error_Modal'] = $this->load->view('app/temp/model_update_error', $data, true);
      		$data['slider_Modal'] = $this->load->view('app/temp/model_image_slider', $data, true);
			$data['body'] = $this->load->view('core/wanted/wanted_manage', $data, true); 
			$this->load->view('layouts/layout_page', $data);
		}else{
			$this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED);   
		}
	}

	//Update missing person details
	public function updatePerson(){

    	if (Auth::has_permission('MOST_WANTED_UPDATE_PERMISSION')) {
    		$id = $_POST['comId'];
      		$data['id'] = $id;
			$data['title']        = 'Update Most Wanted Person';  
			$data['permissions']  = Auth::get_session_permissions();

    		$this->load->model('User_model');
    		$results = $this->User_model->listPoliceStations();
    		$data_array = array();
               foreach ($results as $row) {
                        $data_array[] = $row;
                }
			$data['police'] =  $data_array;


        	$this->load->model('Wanted_model');
			$resultsNew = $this->Wanted_model->loadDataForUpdate($id);

			$data['list'] =  $resultsNew;
			$data['slider_Modal'] = $this->load->view('app/temp/model_image_slider', $data, true);
			$data['body'] = $this->load->view('core/wanted/wanted_update', $data, true); 
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
        $this->form_validation->set_rules('age', 'Age', 'trim|required|min_length[1]|max_length[2]');
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
        	$this->load->model('Wanted_model');
            $data['id'] = $this->input->post('id');
            $data['name'] = trim($this->input->post('name'));
            $data['age'] = $this->input->post('age');
            $data['sex'] = $this->input->post('sex');
            $data['aliases'] = trim($this->input->post('aliases'));
            $data['remarks'] = trim($this->input->post('remarks'));
            $data['caution'] = trim($this->input->post('caution'));
            $data['police_station'] = $this->input->post('policeselector');            
            $data['status'] = 'A';
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
                $target_dir = $this->config->item('wanted_path');
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
            $numRecords=$this->Wanted_model->updateWantedData($data);
             if($numRecords > 0){
                  $this->session->set_flashdata('success', 'Most Wanted Person '. SC_MSG_FOR_UPDATE);
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
        $this->load->model('Wanted_model');
        $status = $this->Wanted_model->deleteData($data);
        return $status;
	}

} 
?>