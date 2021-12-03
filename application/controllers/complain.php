<?php
/**
* Class:  Complain Controller 
* Author: Dinesh Rathnayake 
* Date:   23/05/2021
*/ 

defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'controllers/'.'Base.php');
class Complain extends Base{
	
	public function __construct() {
        parent::__construct();

    }

	public function index(){
		$data['title'] = 'Manage Complain';   
        $data['permissions'] = Auth::get_session_permissions(); 
    	$data['body'] = $this->load->view('app/dashboard/app', $data, true);
    	$this->load->view('layouts/layout_page', $data); 
	}

	public function new_complain(){
		if (Auth::has_permission('COMPLAIN_WRITE_PERMISSION')) {
			$data['title']        = 'New Complain';  
			$data['permissions']  = Auth::get_session_permissions();

			$this->load->model('Complain_model');
    		$results = $this->Complain_model->getCrimes();
    		$data_array = array();
               foreach ($results as $row) {
                        $data_array[] = $row;
                }
			$data['crimes'] =  $data_array;
				/*print_r('<pre>');
	    		print_r($data);
				print_r('</pre>');
				die;*/

       $this->load->model('User_model');
        $results = $this->User_model->listPoliceStations();
        $data_array = array();
               foreach ($results as $row) {
                        $data_array[] = $row;
                }
      $data['police'] =  $data_array;

			$data['body'] = $this->load->view('core/complain/complain_create', $data, true);   
			$this->load->view('layouts/layout_page', $data);  
		}else{
			 $this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED); 
		}
	}

 //Create Complain without login
  public function new_Guest_Complain(){
    $data['title']        = 'New Complain';  
      $data['permissions']  = Auth::get_session_permissions();

      $this->load->model('Complain_model');
        $results = $this->Complain_model->getCrimes();
        $data_array = array();
               foreach ($results as $row) {
                        $data_array[] = $row;
                }
      $data['crimes'] =  $data_array;
        /*print_r('<pre>');
          print_r($data);
        print_r('</pre>');
        die;*/

       $this->load->model('User_model');
        $results = $this->User_model->listPoliceStations();
        $data_array = array();
               foreach ($results as $row) {
                        $data_array[] = $row;
                }
      $data['police'] =  $data_array;

      $data['body'] = $this->load->view('core/complain/complain_create', $data, true);   
      $this->load->view('layouts/layout_page_register', $data);
  }

	/*Update and Delete Complains*/
	public function edit_complain(){
		if (Auth::has_permission('COMPLAIN_UPDATE_PERMISSION')){
			$data['permissions'] = Auth::get_session_permissions();
      $data['title']        = 'Manage Complain';
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

        	$data['screen_name'] = "Manage Complains";

        	$this->load->model('Complain_model');
        	$results = $this->Complain_model->loadDataForModify();

        	$data_array = array();
               foreach ($results as $row) {
                        $data_array[] = $row;
                }
			$data['list'] =  $data_array;

			$data['delete_modal'] = $this->load->view('app/temp/model_delete', $data, true);
      $data['update_sucess_modal'] = $this->load->view('app/temp/model_update_sucess', $data, true);
      $data['update_error_Modal'] = $this->load->view('app/temp/model_update_error', $data, true);
      $data['slider_Modal'] = $this->load->view('app/temp/model_image_slider', $data, true);
			$data['body'] = $this->load->view('core/complain/manage_complain', $data, true); 
			$this->load->view('layouts/layout_page', $data);
		}else{
			$this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED);   
		}
	}

	/*Approve Complains*/
	public function approve_complain(){

		if (Auth::has_permission('COMPLAIN_APPROVE_PERMISSION')) {
      $data['title']        = 'Approve Complain';
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

        	$data['screen_name'] = "Approve Complains";
          $data['screen_name2'] = "Assign Complains";

        	$this->load->model('Complain_model');
    		  $results = $this->Complain_model->vieWPendingComplains();
    		  $data_array = array();
               foreach ($results as $row) {
                        $data_array[] = $row;
                }
			    $data['list'] =  $data_array;

          $roll_id =  $_SESSION['roll_id']; 
          $police_station = $_SESSION['police_station'];
           if ($roll_id == 1 OR $roll_id == 2){
              //Approve and assign done at once for administrator and OIC
              $results = $this->Complain_model->viewAssignPendingComplains($roll_id,$police_station);
              $data_array = array();
                   foreach ($results as $row) {
                            $data_array[] = $row;
                    }
               
      
              if (count($data_array) > 0){   
                $data['list3'] =  $data_array;
             }
           }

           if ($roll_id == 1){
              //Load Police Stations for administrator
              $policeList = $this->Complain_model->listPoliceStations();
              $data_array2 = array();
                foreach ($policeList as $row) {
                        $data_array2[] = $row;
                }
              $data['list2'] =  $data_array2;
              $data['police_modal'] = $this->load->view('app/temp/model_assign_police', $data, true);
           }

           if ($roll_id == 2){
            //Load list of police officers for police OIC
            $officerList = $this->Complain_model->listPoliceOfficers($police_station);
            $data_array2 = array();
                    foreach ($officerList as $row) {
                            $data_array2[] = $row;
                    }
            $data['list2'] =  $data_array2;
            $data['officer_modal'] = $this->load->view('app/temp/model_assign_officer', $data, true);
           }

			$data['confrm_modal'] = $this->load->view('app/temp/model_conf', $data, true);
			$data['reject_modal'] = $this->load->view('app/temp/model_reject', $data, true);
      $data['slider_Modal'] = $this->load->view('app/temp/model_image_slider', $data, true);
      $data['map_Modal'] = $this->load->view('app/temp/model_map', $data, true);
			$data['body'] = $this->load->view('core/complain/view_complain', $data, true); 
			$this->load->view('layouts/layout_page', $data); 

		}else{
			$this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED);   
		}
	}

	/*//Assign complains to police station or police officer
	public function assign_complain(){
		if (Auth::has_permission('COMPLAIN_ASSIGN_PERMISSION')) {
      $data['title']        = 'Assign Complain';
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

        	$data['screen_name'] = "Assign Complains";

        	$this->load->model('Complain_model');
        	$roll_id =  $_SESSION['roll_id']; 
        	$police_station = $_SESSION['police_station'];
        	$results = $this->Complain_model->viewAssignPendingComplains($roll_id,$police_station);
    		  $data_array = array();
               foreach ($results as $row) {
                        $data_array[] = $row;
                }
			    $data['list'] =  $data_array;

			if ($roll_id == 1){
				//Load Police Stations for administrator
				$policeList = $this->Complain_model->listPoliceStations();
				$data_array2 = array();
                foreach ($policeList as $row) {
                        $data_array2[] = $row;
                }
				$data['list2'] =  $data_array2;
				$data['police_modal'] = $this->load->view('app/temp/model_assign_police', $data, true);
 
			}else if($roll_id == 2){
				//Load list of police officers for police OIC
				$officerList = $this->Complain_model->listPoliceOfficers($police_station);
				$data_array2 = array();
                foreach ($officerList as $row) {
                        $data_array2[] = $row;
                }
				$data['list2'] =  $data_array2;
				$data['officer_modal'] = $this->load->view('app/temp/model_assign_officer', $data, true);
			}

      $data['slider_Modal'] = $this->load->view('app/temp/model_image_slider', $data, true);
			$data['body'] = $this->load->view('core/complain/assign_complain', $data, true); 
			$this->load->view('layouts/layout_page', $data); 
		}else{
			$this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED);   
		}
	}*/

  //Assign complains to police station or police officer
  public function assign_complain(){
    if (Auth::has_permission('COMPLAIN_APPROVE_PERMISSION')) {
      $data['title']        = 'Assign Complain';
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

          $data['screen_name'] = "Assign Complains";

          $this->load->model('Complain_model');
          $roll_id =  $_SESSION['roll_id']; 
          $police_station = $_SESSION['police_station'];
          $results = $this->Complain_model->viewAssignPendingComplains($roll_id,$police_station);
          $data_array = array();
               foreach ($results as $row) {
                        $data_array[] = $row;
                }
          $data['list'] =  $data_array;

      if ($roll_id == 1){
        //Load Police Stations for administrator
        $policeList = $this->Complain_model->listPoliceStations();
        $data_array2 = array();
                foreach ($policeList as $row) {
                        $data_array2[] = $row;
                }
        $data['list2'] =  $data_array2;
        $data['police_modal'] = $this->load->view('app/temp/model_assign_police', $data, true);
 
      }else if($roll_id == 2){
        //Load list of police officers for police OIC
        $officerList = $this->Complain_model->listPoliceOfficers($police_station);
        $data_array2 = array();
                foreach ($officerList as $row) {
                        $data_array2[] = $row;
                }
        $data['list2'] =  $data_array2;
        $data['officer_modal'] = $this->load->view('app/temp/model_assign_officer', $data, true);
      }

      $data['slider_Modal'] = $this->load->view('app/temp/model_image_slider', $data, true);
      $data['body'] = $this->load->view('core/complain/assign_complain', $data, true); 
      $this->load->view('layouts/layout_page', $data); 
    }else{
      $this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED);   
    }
  }
	/*Save Complain Data*/
	public function saveComplainData(){

               
		            $this->load->helper(array('form', 'url'));

                $this->load->library('form_validation');

                $this->form_validation->set_rules('ctime', 'Criminal Time', 'required');               
                $this->form_validation->set_rules('address', 'Address', 'required');
                $this->form_validation->set_rules('description', 'Description', 'required');
                $this->form_validation->set_rules('latitude', 'Location', 'required');

                $crimeType =  trim($this->input->post('crimeselector'));
                if($crimeType == 0){
                        $this->form_validation->set_rules('crimeselector', 'Criminal Type', 'callback_crimetype_check');
                        $this->form_validation->set_message('crimetype_check', 'Please select criminal type.');
                }
        
                $policeStation =  trim($this->input->post('policeselector'));
                if($policeStation == 0){
                      $this->form_validation->set_rules('policeselector', 'Police Station', 'callback_police_check');
                      $this->form_validation->set_message('police_check', 'Please select Nearest Police Station.');
                }
                 
                 if ($this->form_validation->run() == FALSE){        
                 if(isset($_SESSION['user_name'])){    
                      $this->new_complain();
                    }else{
                      $this->new_Guest_Complain();
                    }
                        
                }else{                        
                    $data['type'] = $this->input->post('crimeselector');
                    $data['date'] = $this->input->post('cdate');
                    $data['time'] = $this->input->post('ctime');
                    $data['address'] = trim($this->input->post('address'));
                    $data['description'] = trim($this->input->post('description'));
                    $data['withness_name_1'] = trim($this->input->post('wname1'));
                    $data['withness_phone_1'] = $this->input->post('wphone1');
                    $data['withness_name_2'] = trim($this->input->post('wname2'));
                    $data['withness_phone_2'] = $this->input->post('wphone2');
                    $data['withness_phone_2'] = $this->input->post('wphone2');
                    $data['near_police'] = $this->input->post('policeselector');
                    $data['latitude'] = $this->input->post('latitude');
                    $data['longitude'] = $this->input->post('longitude');

                     
                    if(isset($_SESSION['user_name'])){   
                      $data['enter_user'] = $_SESSION['user_name'];
                      $roll_id =  $_SESSION['roll_id'];
                      if($roll_id == 1 OR $roll_id == 2){
                         $data['status'] = 'A';
                      } else{
                         $data['status'] = 'P';
                      }
                    }else{
                      $data['enter_user'] = 'guest';
                      $data['status'] = 'P';
                    }
                    
                    $data['enter_date'] = $this->get_current_date();
            		    $data['enter_time'] = $this->get_current_time();
            		    
                    $data['action'] = 'P';

                    //Save Criminal Person details here///////////////////////////////////////
                    $data['crime_person'] = $this->input->post('knowCrime');
                    $data['crime_person_name'] = $this->input->post('cName');
                    $data['crime_person_address'] = $this->input->post('caddress');
                    //$data['crime_person_image'] = trim($this->input->post('cfile'));

                    $target_dir = $this->config->item('crime_path');


                    //upload File
                    //Upload the file
                    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                    $name2 = '15.'.$imageFileType;



                    // Allow certain file formats
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                       && $imageFileType != "gif" ) {
                        $this->session->set_flashdata('error',"Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
                      $uploadOk = 0;
                    }

                    $newName = $target_dir.'15'.'.'.$imageFileType;

                  // Check if $uploadOk is set to 0 by an error
                  if ($uploadOk == 0) {
                    $this->session->set_flashdata('error', 'Error in upload File');
                  } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $newName)) {
                      echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                      $data['crime_person_image'] = $name2;

                    } else {
                            $this->session->set_flashdata('error', ER_MSG_FOR_SAVE_DATA);
                    }
                  }

                    //end upload
                    //End seve criminal person details here////////////////////////////////////

                    
                    $this->load->model('Complain_model');
                    $insert_Id = $this->Complain_model->saveComplain($data);

                    //send SMS to OIC regarding criminal case
                    $this->SendSMS($data);

                    $count = 0;
                    //File upload
                    if($insert_Id > 0){
                    try {
                      $maxsize = 5242880; // 5MB
                      $response2 = '';
                      $fileType = '';
                      $name2='';

                       // Count total files
 					 $countfiles = count($_FILES['file']['name']);

 					   // Looping all files 					 
 					for($i=0;$i<$countfiles;$i++){

   					  if(isset($_FILES['file']['name'][$i]) && $_FILES['file']['name'][$i] != ''){
   					  		  $name = $_FILES['file']['name'][$i];

   					  		  $target_file = $_FILES["file"]["name"][$i];

   					  		  // Select file type
       						   $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
       						   $name2 = $insert_Id.'_'.$i.'.'.$extension;

       						   // Valid file extensions
       						   $extensions_arr2 = array("mp4","avi","3gp","mov","mpeg"); 
       						   $extensions_arr = array("jpg","png","jpeg","gif"); 
                     $extensions_arr3 = array("mp3","ogg"); 
       						   $validFile = false;

       						   // Check extension 
                               if(in_array($extension,$extensions_arr) ){
                               		$validFile = true;
                               		$target_dir = $this->config->item('image_path');
                               		$fileType = 'I';
                               }else if(in_array($extension,$extensions_arr2) ){
                               		$validFile = true;
                               		$target_dir = $this->config->item('video_path');
                               		$fileType = 'V';
                               }else if(in_array($extension,$extensions_arr3) ){
                                  $validFile = true;
                                  $target_dir = $this->config->item('audio_path');
                                  $fileType = 'A';
                               }else{
                               		$validFile = false;
                               }
       				           
                               if($validFile){
                               	//upload imags
 								// Check file size
						          if(($_FILES['file']['size'][$i] >= $maxsize) || ($_FILES["file"]["size"][$i] == 0)){
						          	echo $_FILES['file']['size'][$i] ;
						            echo "File too large. File must be less than 5MB.";
						             die;
						          }else{
                               		try{

                               			if ($_FILES["file"]["error"][$i] > 0)
									    {
									    echo "Return Code: " . $_FILES["file"]["error"][$i] . "<br />";
									    die;
									    }else{

						          	$newName = $target_dir.$insert_Id.'_'.$i.'.'.$extension;
						          	echo $newName;
						          	if(move_uploaded_file($_FILES['file']['tmp_name'][$i],$newName)){
						               // Insert record
                           $count = $count +1;
						               $data2['criminal_id'] = $insert_Id;
						               $data2['file_name'] =  $name2;
						               $data2['file_type'] = $extension;
						               $data2['upload_date'] = $this->get_current_date();
						               $data2['upload_time'] = $this->get_current_time();
						               $data2['category'] = $fileType;

						               $response2=$this->Complain_model->saveFile($data2);

             						}else{
             							echo "Error in upload file : ";
             							die;             						
             						}
             					}
             					}catch(Exception $e1){
             						echo $e1;
             					}
						       }

                               }else{
                               	echo "invalid file type";
                               	die;
                               }
                       } 

                     }//End loop 
					}catch(Exception $e){
						echo $e;
						die;
					}
        } 
                       
                     if($insert_Id != 0){
                        if($count > 0){
                          if( $response2 != ''){
                              $this->session->set_flashdata('success', 'Complain '. SC_MSG_FOR_CREATION);
                          }else{
                                $this->session->set_flashdata('error', ER_MSG_FOR_SAVE_DATA);      
                          }
                        }else{
                          $this->session->set_flashdata('success', 'Complain '. SC_MSG_FOR_CREATION);
                        }
                     }else{
                        $this->session->set_flashdata('error', ER_MSG_FOR_SAVE_DATA);
                     }          
                    if(isset($_SESSION['user_name'])){   
                      $this->new_complain();
                    }else{
                      $this->new_Guest_Complain();
                    }               

                }
	}

	//Approve complains
	public function approveData(){
		$data['id'] = $_GET['id'];
    $data['near_police'] = $_GET['nearPolice'];
		$data['approve_user'] = $_SESSION['user_name'];
    $data['approve_date'] = $this->get_current_date();
    $data['approve_time'] = $this->get_current_time();
		$this->load->model('Complain_model');
		$numRows = $this->Complain_model->approveData($data);

    //Email Send
    if ($numRows > 0){
         try {
                $headers = "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

                $complainData = $this->Complain_model->loadDataForUpdate($data['id']);
                $enterUser = $complainData[0]->enter_user;

                $this->load->model('User_model');
                $email = $this->User_model->getUserMailFromUserName($enterUser);

                $msg = "<h4>Dear ".$enterUser."</h4>";
                $msg .= "</br>";
                $msg .= "<p>".COMPLAIN_APPROVE."</p>";
                $msg .= "</br>";
                $msg .= "<table border='1' style='border-collapse:collapse'>";
                $msg .= "<tr>";
                $msg .= "<th>Date</th>";
                $msg .= "<td>".$complainData[0]->date."</td>";
                $msg .= "</tr>";
                $msg .= "<tr>";
                $msg .= "<th>Time</th>";
                $msg .= "<td>".$complainData[0]->time."</td>";
                $msg .= "</tr>";
                $msg .= "<tr>";
                $msg .= "<th>Address</th>";
                $msg .= "<td>".$complainData[0]->address."</td>";
                $msg .= "</tr>";
                $msg .= "<tr>";
                $msg .= "<th>Description</th>";
                $msg .= "<td>".$complainData[0]->description."</td>";
                $msg .= "</tr>";
                $msg .= "</table>";
                mail($email,MAIL_HEADER,$msg,$headers);

            }catch(Exception $e) {
                echo "<pre>";
                echo $e->getMessage();
                echo "</pre>";
                die;
            }
    }
		return $numRows;
	}

	//Reject complains
	public function rejectData(){
		$data['id'] = $_POST['comId'];
		$data['message'] = $_POST['message'];
		$data['reject_user'] = $_SESSION['user_name'];
    $data['reject_date'] = $this->get_current_date();
    $data['reject_time'] = $this->get_current_time();
		$this->load->model('Complain_model');
		$numRows = $this->Complain_model->rejectData($data);

    //Email Send
    if ($numRows > 0){
         try {
                $headers = "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

                $complainData = $this->Complain_model->loadDataForUpdate($data['id']);
                $enterUser = $complainData[0]->enter_user;

                $this->load->model('User_model');
                $email = $this->User_model->getUserMailFromUserName($enterUser);

                $msg = "<h4>Dear ".$enterUser."</h4>";
                $msg .= "</br>";
                $msg .= "<p>".COMPLAIN_REJECT."</p>";
                $msg .= "</br>";
                $msg .= "<table border='1' style='border-collapse:collapse'>";
                $msg .= "<tr>";
                $msg .= "<th>Date</th>";
                $msg .= "<td>".$complainData[0]->date."</td>";
                $msg .= "</tr>";
                $msg .= "<tr>";
                $msg .= "<th>Time</th>";
                $msg .= "<td>".$complainData[0]->time."</td>";
                $msg .= "</tr>";
                $msg .= "<tr>";
                $msg .= "<th>Address</th>";
                $msg .= "<td>".$complainData[0]->address."</td>";
                $msg .= "</tr>";
                $msg .= "<tr>";
                $msg .= "<th>Description</th>";
                $msg .= "<td>".$complainData[0]->description."</td>";
                $msg .= "</tr>";
                $msg .= "</table>";
                mail($email,MAIL_HEADER,$msg,$headers);

            }catch(Exception $e) {
                echo "<pre>";
                echo $e->getMessage();
                echo "</pre>";
                die;
            }
    }
		$this->approve_complain();
	}
    
    //Delete complains
    public function deleteData(){
    $data['id'] = $_GET['id'];
		$data['delete_user'] = $_SESSION['user_name'];
        $data['delete_date'] = $this->get_current_date();
        $data['delete_time'] = $this->get_current_time();
		$this->load->model('Complain_model');
		$status = $this->Complain_model->deleteData($data);
		return $status;
    }

    //Assign complain to the police station by administrator
    public function assignPolice(){

    	 $this->load->helper(array('form', 'url'));

         $this->load->library('form_validation');

 		 $this->form_validation->set_rules('policeStation', 'Police Station', 'required');
         $policeStation =  trim($this->input->post('policeStation'));
          if($policeStation == 0){
                  $this->form_validation->set_rules('policeStation', 'Police Station', 'callback_policeStation_check');
                  $this->form_validation->set_message('policeStation_check', 'Please select police station.');
           }
          $roll_id =  $_SESSION['roll_id'];
          if ($this->form_validation->run() == FALSE)
             {   
             	
                  if($roll_id == 1){
                    $this->approve_complain();
                  } else{ 
                   $this->assign_complain();
                 }
             }
          else{
	    	 $data['policeStation'] = $_POST['policeStation'];
			 $data['complainId'] = $_POST['comId'];
	    	 $this->load->model('Complain_model');
			 $status = $this->Complain_model->assignPolice($data);
			 if($roll_id == 1){
                    $this->approve_complain();
                  } else{ 
                   $this->assign_complain();
                 }
		}
    }

    //Assign complain to the police officer by administrator
    public function assignOfficer(){

    	 $this->load->helper(array('form', 'url'));

         $this->load->library('form_validation');

 		 $this->form_validation->set_rules('policeOfficer', 'Police Officer', 'required');
         $policeOfficer =  trim($this->input->post('policeOfficer'));
          if($policeOfficer == 0){
                  $this->form_validation->set_rules('policeOfficer', 'Police Officer', 'callback_policeOfficer_check');
                  $this->form_validation->set_message('policeOfficer_check', 'Please select police officer.');
           }
          if ($this->form_validation->run() == FALSE)
             {   
             	
                   $this->approve_complain();
             }
          else{
	    	 $data['policeOfficer'] = $_POST['policeOfficer'];
         $data['assignDate'] = $this->get_current_date();
			 $data['complainId'] = $_POST['comId'];
	    	 $this->load->model('Complain_model');
			 $status = $this->Complain_model->assignOfficer($data);
			 $this->approve_complain();
		}
    }

    public function updateComplain(){
    	if (Auth::has_permission('COMPLAIN_UPDATE_PERMISSION')) {
    	$id = $_POST['comId'];
      $data['id'] = $id;
			$data['title']        = 'Update Complain';  
			$data['permissions']  = Auth::get_session_permissions();

			$this->load->model('Complain_model');
    		$results = $this->Complain_model->getCrimes();

    		$data_array = array();
               foreach ($results as $row) {
                        $data_array[] = $row;
                }
			$data['crimes'] =  $data_array;
			$resultsNew = $this->Complain_model->loadDataForUpdate($id);
				/*print_r('<pre>');
	    		print_r($resultsNew);
				print_r('</pre>');
				die;*/

      $this->load->model('User_model');
      $results = $this->User_model->listPoliceStations();
      $data_array = array();
               foreach ($results as $row) {
                        $data_array[] = $row;
                }
      $data['police'] =  $data_array;

			$data['list'] =  $resultsNew;
			$data['body'] = $this->load->view('core/complain/complain_update', $data, true); 
			$this->load->view('layouts/layout_page', $data);

    	}else{
			$this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED);  		
    	}
    }

    public function updateComplainData(){
  				 $this->load->helper(array('form', 'url'));

                $this->load->library('form_validation');

                $this->form_validation->set_rules('ctime', 'Criminal Time', 'required');               
                $this->form_validation->set_rules('address', 'Address', 'required');
                $this->form_validation->set_rules('description', 'Description', 'required');
                $this->form_validation->set_rules('latitude', 'Location', 'required');

                $crimeType =  trim($this->input->post('crimeselector'));
                if($crimeType == 0){
                        $this->form_validation->set_rules('crimeselector', 'Criminal Type', 'callback_crimetype_check');
                        $this->form_validation->set_message('crimetype_check', 'Please select criminal type.');
                }
                 
                 if ($this->form_validation->run() == FALSE){
                   
                        $_POST['comId']  = $this->input->post('id');
                        $this->updateComplain();
                }else{
                    $data['id'] = $this->input->post('id');
                	  $data['type'] = $this->input->post('crimeselector');
                    $data['date'] = $this->input->post('cdate');
                    $data['time'] = $this->input->post('ctime');
                    $data['address'] = trim($this->input->post('address'));
                    $data['description'] = trim($this->input->post('description'));
                    $data['withness_name_1'] = trim($this->input->post('wname1'));
                    $data['withness_phone_1'] = $this->input->post('wphone1');
                    $data['withness_name_2'] = trim($this->input->post('wname2'));
                    $data['withness_phone_2'] = $this->input->post('wphone2');
                    $data['near_police'] = $this->input->post('policeselector');
                    $data['latitude'] = $this->input->post('latitude');
                    $data['longitude'] = $this->input->post('longitude');
                    $data['modify_user'] = $_SESSION['user_name'];
                    $data['modify_date'] = $this->get_current_date();
            		    $data['modify_time'] = $this->get_current_time();     
 
                     if("ADMIN" == $_SESSION['user_name']){
                         $data['status'] = 'A';
                      } else{
                         $data['status'] = 'M';
                      }
                    
                    $this->load->model('Complain_model');
                    $numRows = $this->Complain_model->updateComplain($data);

                    $count = 0;
                    //File upload
                    if($numRows > 0){
                      try {
                      $maxsize = 5242880; // 5MB
                      $response2 = '';
                      $fileType = '';
                      $name2='';

                       // Count total files
           $countfiles = count($_FILES['file']['name']);

           //Get already Saved images

           $saveCount = $this->Complain_model->getSaveImageCount($data['id']);


           $tot = $saveCount+$countfiles;

           /*echo "<pre>";
           echo $saveCount." - ";
           echo $tot;
           echo "</pre>";
           die;*/
             // Looping all files            
          for($i=$saveCount;$i<$tot;$i++){
              $imgCount = 0;
              if(isset($_FILES['file']['name'][$imgCount]) && $_FILES['file']['name'][$imgCount] != ''){
                    $name = $_FILES['file']['name'][$imgCount];

                    $target_file = $_FILES["file"]["name"][$imgCount];

                    // Select file type
                     $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                     $name2 = $data['id'] .'_'.$i.'.'.$extension;

                     // Valid file extensions
                     $extensions_arr2 = array("mp4","avi","3gp","mov","mpeg"); 
                     $extensions_arr = array("jpg","png","jpeg","gif"); 
                     $extensions_arr3 = array("mp3","ogg"); 
                     $validFile = false;

                     // Check extension 
                               if(in_array($extension,$extensions_arr) ){
                                  $validFile = true;
                                  $target_dir = $this->config->item('image_path');
                                  $fileType = 'I';
                               }else if(in_array($extension,$extensions_arr2) ){
                                  $validFile = true;
                                  $target_dir = $this->config->item('video_path');
                                  $fileType = 'V';
                               }else if(in_array($extension,$extensions_arr3) ){
                                  $validFile = true;
                                  $target_dir = $this->config->item('audio_path');
                                  $fileType = 'A';
                               }else{
                                  $validFile = false;
                               }
                         
                               if($validFile){
                                //upload imags
                // Check file size
                      if(($_FILES['file']['size'][$imgCount] >= $maxsize) || ($_FILES["file"]["size"][$imgCount] == 0)){
                        echo $_FILES['file']['size'][$imgCount] ;
                        echo "File too large. File must be less than 5MB.";
                         die;
                      }else{
                                  try{

                                    if ($_FILES["file"]["error"][$imgCount] > 0)
                      {
                      echo "Return Code: " . $_FILES["file"]["error"][$imgCount] . "<br />";
                      die;
                      }else{

                        $newName = $target_dir.$data['id'].'_'.$i.'.'.$extension;
                        echo $newName;
                        if(move_uploaded_file($_FILES['file']['tmp_name'][$imgCount],$newName)){
                           // Insert record
                           $count = $count +1;
                           $data2['criminal_id'] = $data['id'];
                           $data2['file_name'] =  $name2;
                           $data2['file_type'] = $extension;
                           $data2['upload_date'] = $this->get_current_date();
                           $data2['upload_time'] = $this->get_current_time();
                           $data2['category'] = $fileType;

                           $response2=$this->Complain_model->saveFile($data2);

                        }else{
                          echo "Error in upload file : ";
                          die;                        
                        }
                      }
                      }catch(Exception $e1){
                        echo $e1;
                      }
                   }

                               }else{
                                echo "invalid file type";
                                die;
                               }
                       } 
                       $imgCount = $imgCount + 1;
                     }//End loop 
          }catch(Exception $e){
            echo $e;
            die;
          }
                    }

                    /*if($numRows > 0){
                      $this->session->set_flashdata('success', 'Complain '. SC_MSG_FOR_UPDATE);
                    }
                    else{
                         $this->session->set_flashdata('error', ER_MSG_FOR_UPDATE_DATA);
                    }  */  

                    if($numRows != 0){
                        if($count > 0){
                          if( $response2 != ''){
                              $this->session->set_flashdata('success', 'Complain '. SC_MSG_FOR_CREATION);
                          }else{
                                $this->session->set_flashdata('error', ER_MSG_FOR_SAVE_DATA);      
                          }
                        }else{
                          $this->session->set_flashdata('success', 'Complain '. SC_MSG_FOR_CREATION);
                        }
                     }else{
                        $this->session->set_flashdata('error', ER_MSG_FOR_SAVE_DATA);
                     }                     
                    $this->edit_complain(); 
                }

	}

  //function to show images on the model
  public function showImages(){
      $id = $_GET['id'];
      $this->load->model('Complain_model');
      $results = $this->Complain_model->loadImages($id);
        $data_array = array();
               foreach ($results as $row) {
                        $data_array[] = $row;
                }          
          echo json_encode($data_array);  
          return json_encode($data_array);

  }

  //function for read complains
  public function read_complain(){
    if (Auth::has_permission('COMPLAIN_READ_PERMISSION')) {
      $data['title']        = 'View Complain';
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

          $data['screen_name'] = "View Complains";

          $this->load->model('Complain_model');
          $roll_id =  $_SESSION['roll_id']; 
          $police_station = $_SESSION['police_station'];
          $user = $_SESSION['user_name'];
          $user_id = $_SESSION['user_id'];
          $results = $this->Complain_model->viewComplains($roll_id,$police_station,$user,$user_id);
          $data_array = array();
               foreach ($results as $row) {
                        $data_array[] = $row;
                }
          $data['list'] =  $data_array;

      $data['slider_Modal'] = $this->load->view('app/temp/model_image_slider', $data, true);
      $data['map_Modal'] = $this->load->view('app/temp/model_map', $data, true);
      $data['logs_Modal'] = $this->load->view('app/temp/model_logs', $data, true);
      $data['rej_Modal'] = $this->load->view('app/temp/model_rejAction', $data, true);
      $data['history_Modal'] = $this->load->view('app/temp/model_history', $data, true);
      $data['body'] = $this->load->view('core/complain/read_complain', $data, true); 
      $this->load->view('layouts/layout_page', $data); 
    }else{
      $this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED);   
    }
  }

  //update complain status
  public function updateStatus(){
     $id = $_POST['id'];
     $this->load->helper(array('form', 'url'));
     $this->load->library('form_validation');
     $this->form_validation->set_rules("status_".$id."", 'Status', 'required'); 
     $status =  trim($this->input->post("status_".$id.""));
     print_r($status);
     if($status == ""){
          $this->form_validation->set_rules("status_".$id."", 'Action', 'callback_action_check');
          $this->form_validation->set_message('action_check', 'Select Action.');
     }
                 
    if ($this->form_validation->run() == FALSE){
              $this->read_complain();
    }else{
      $data['id'] = $id;
      $data['action'] = $_POST["status_".$id.""];
      $data['action_user'] = $_SESSION['user_name'];
      $data['action_date'] = $this->get_current_date();
      $data['action_time'] = $this->get_current_time();
      $this->load->model('Complain_model');
      $status = $this->Complain_model->updateStatus($data);
      $this->read_complain();
  }

}

//Display Google Map
public function showLocation(){
      $id = $_GET['id'];
      $this->load->model('Complain_model');
      $results = $this->Complain_model->getGeoLocation($id);
      $data_array = array();
               foreach ($results as $row) {
                        $data_array[] = $row;
      }
      echo json_encode($data_array);
      return json_encode($data_array);
    }

   //Save Complain note
    public function updateAction(){

      $data['complain_id'] = $_POST['comId2'];
      $data['action'] = $_POST['action'];
      $data['note'] = $_POST['note'];
      $data['log_user'] = $_SESSION['user_name'];
      $data['log_date'] = $this->get_current_date();
      $data['log_time'] = $this->get_current_time();

      $message =$_POST['note'];

      $this->load->model('Complain_model');
      $numRows = $this->Complain_model->updateAction($data);

      //upload documents
      
      $fileName = $_FILES["fileToUpload"]["name"];

      if("" != $fileName){
        $target_dir = $this->config->item('docs_path');
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;

        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $newID = $data['complain_id'];
        $name2 = $newID.'.'.$imageFileType;

        // Allow certain file formats
        if($imageFileType != "pdf") {
            $this->session->set_flashdata('error',"Sorry, only pdf and docx files are allowed.");
          $uploadOk = 0;
        }
        $newName = $target_dir.$newID.'.'.$imageFileType;

        // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
        $this->session->set_flashdata('error', 'Error in upload File');
      } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $newName)) {
          echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
          $data2['criminal_id'] = $data['complain_id'];
          $data2['file_name'] = $name2;
          $data2['file_type'] = $imageFileType;
          $data2['upload_date'] = $this->get_current_date();
          $data2['upload_time'] = $this->get_current_time();

          $insertId=$this->Complain_model->saveComplainDocs($data2);
           if($insertId > 0){
                      $this->session->set_flashdata('success', 'Missing Person '. SC_MSG_FOR_CREATION);
                }else{
                        $this->session->set_flashdata('error', ER_MSG_FOR_SAVE_DATA);
                } 
        } else {
                $this->session->set_flashdata('error', ER_MSG_FOR_SAVE_DATA);
        }

      }
      }

      

       //Email Send
      if ($numRows > 0){
         try {
                $title = "";
                if ($_POST['action'] == 'I'){
                    $title = COMPLAIN_START_INVESTIGATE;
                } else if($_POST['action'] == 'R'){
                    $title = COMPLAIN_RESOLVE;
                } else if($_POST['action'] == 'C'){
                    $title = COMPLAIN_SUBMIT_COURT;
                }

                $headers = "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

                $complainData = $this->Complain_model->loadDataForUpdate($data['complain_id']);
                $enterUser = $complainData[0]->enter_user;

                $this->load->model('User_model');
                $email = $this->User_model->getUserMailFromUserName($enterUser);

                $msg = "<h4>Dear ".$enterUser."</h4>";
                $msg .= "</br>";
                $msg .= "<p>".$title."</p>";
                $msg .= "</br>";
                $msg .= "<table border='1' style='border-collapse:collapse'>";
                $msg .= "<tr>";
                $msg .= "<th>Date</th>";
                $msg .= "<td>".$complainData[0]->date."</td>";
                $msg .= "</tr>";
                $msg .= "<tr>";
                $msg .= "<th>Time</th>";
                $msg .= "<td>".$complainData[0]->time."</td>";
                $msg .= "</tr>";
                $msg .= "<tr>";
                $msg .= "<th>Address</th>";
                $msg .= "<td>".$complainData[0]->address."</td>";
                $msg .= "</tr>";
                $msg .= "<tr>";
                $msg .= "<th>Description</th>";
                $msg .= "<td>".$complainData[0]->description."</td>";
                $msg .= "</tr>";              
                $msg .= "<tr>";
                $msg .= "<th>Action Taken</th>";
                $msg .= "<td>".$message."</td>";
                $msg .= "</tr>";
                $msg .= "</table>";
                mail($email,MAIL_HEADER,$msg,$headers);

            }catch(Exception $e) {
                echo "<pre>";
                echo $e->getMessage();
                echo "</pre>";
                die;
            }
    }

      $this->read_complain();

    }

    //load history of the crime
     public function showHistory(){
      $id = $_GET['id'];
      $this->load->model('Complain_model');
      $results = $this->Complain_model->loadHistory($id);
        $data_array = array();
               foreach ($results as $row) {
                        $data_array[] = $row;
                }          
          echo json_encode($data_array);  
          return json_encode($data_array);

  }

  //Update action for police officer
  public function updateOfficerAction(){
      $data['complain_id'] = $_POST['complainId'];
      $data['action'] = 'I';
      $data['note'] = 'Complain Accepted by Officer';
      $data['log_user'] = $_SESSION['user_name'];
      $data['log_date'] = $this->get_current_date();
      $data['log_time'] = $this->get_current_time();
      $message = $data['note'];
      
      $this->load->model('Complain_model');
      $numRows = $this->Complain_model->updateAction($data);

      //Email Send
      if ($numRows > 0){
         try {
                $headers = "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

                $complainData = $this->Complain_model->loadDataForUpdate($data['complain_id']);
                $enterUser = $complainData[0]->enter_user;

                $this->load->model('User_model');
                $email = $this->User_model->getUserMailFromUserName($enterUser);

                $msg = "<h4>Dear ".$enterUser."</h4>";
                $msg .= "</br>";
                $msg .= "<p>".COMPLAIN_START_INVESTIGATE."</p>";
                $msg .= "</br>";
                $msg .= "<table border='1' style='border-collapse:collapse'>";
                $msg .= "<tr>";
                $msg .= "<th>Date</th>";
                $msg .= "<td>".$complainData[0]->date."</td>";
                $msg .= "</tr>";
                $msg .= "<tr>";
                $msg .= "<th>Time</th>";
                $msg .= "<td>".$complainData[0]->time."</td>";
                $msg .= "</tr>";
                $msg .= "<tr>";
                $msg .= "<th>Address</th>";
                $msg .= "<td>".$complainData[0]->address."</td>";
                $msg .= "</tr>";
                $msg .= "<tr>";
                $msg .= "<th>Description</th>";
                $msg .= "<td>".$complainData[0]->description."</td>";
                $msg .= "</tr>";                              
                $msg .= "<tr>";
                $msg .= "<th>Action Taken</th>";
                $msg .= "<td>".$message."</td>";
                $msg .= "</tr>";
                $msg .= "</table>";
                mail($email,MAIL_HEADER,$msg,$headers);

            }catch(Exception $e) {
                echo "<pre>";
                echo $e->getMessage();
                echo "</pre>";
                die;
            }
    }

      $this->read_complain();
  }

  //Assign complains to admin
  public function assignAdmin(){
    $data['id'] = $_GET['id'];
    $data['assign_user'] = $_SESSION['user_name'];
    $data['assign_date'] = $this->get_current_date();
    $data['assign_time'] = $this->get_current_time();
    $this->load->model('Complain_model');
    $numRows = $this->Complain_model->assignAdmin($data);

  }

  //download documents
  public function downloadFile(){
    $id = $_GET['id'];
    $target_dir = $this->config->item('docs_path');
    $file = $target_dir.$id.".pdf";
    if (file_exists($file) && is_readable($file) && preg_match('/\.pdf$/',$file)) {
    header('Content-Type: application/pdf');
    header("Content-Disposition: attachment; filename=".$id.".pdf");
    readfile($file);
    }

  }

  //Complain rejected by police officer
  public function rejOfficerAction(){
     $data['complain_id'] = $_POST['comId3'];
      $data['note'] = $_POST['note'];
      $data['log_user'] = $_SESSION['user_name'];
      $data['log_date'] = $this->get_current_date();
      $data['log_time'] = $this->get_current_time();
      $data['action'] = 'J';

      $message =$_POST['note'];

      $this->load->model('Complain_model');
      $numRows = $this->Complain_model->rejOfficerAction($data);
  }

  private function SendSMS($data){

    $this->load->model('Complain_model');
    $category = $this->Complain_model->getCategorybyId($data['type']);
    $oicPhone = $this->Complain_model->getOICPhone($data['near_police']);

    $oicPhone = '94'.$oicPhone;

    $msg = $category." case happen in your area please attend";
    $this->load->model('Otp_model');
    $this->Otp_model->send_sms($oicPhone,$msg);

  }
  public function test(){
                /*$a = 'How are you?';

                if (strpos($a, 'are') !== false) {
                    echo 'true';
                }

                $myString = "9,admin@example.com,8";
                $myArray = explode(',', $myString);
                print_r($myArray);

                echo end($myArray); //last element

                SELECT * FROM mytable
                WHERE column1 LIKE '%LASTELEMENT%'
                */               
  }

}
?>