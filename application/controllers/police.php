<?php
/**
* Class:  Police Controller 
* Author: Dinesh Rathnayake
* Date:   23/05/2021
*/
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'controllers/'.'Base.php');
class Police extends Base{
	
	public function __construct() {
        parent::__construct();

    }

	public function index(){
		$data['title'] = 'Manage Police Station';   
        $data['permissions'] = Auth::get_session_permissions(); 
    	$data['body'] = $this->load->view('app/dashboard/app', $data, true);
    	/*print_r('<pre>');
    	print_r($data);
		print_r('</pre>');
		die;*/ 
    	$this->load->view('layouts/layout_page', $data); 
	}

	public function new_police(){
		if (Auth::has_permission('POLICE_WRITE_PERMISSION')) {
			$data['title']        = 'New Police Station';  
			$data['permissions']  = Auth::get_session_permissions();

			$this->load->model('Police_model');

			//get list of districts
    		$results = $this->Police_model->getDistricts();
    		$data_array = array();
               foreach ($results as $row) {
                        $data_array[] = $row;
                }
			$data['districts'] =  $data_array;

			//get list of police OIC
			$results2 = $this->Police_model->getPoliceOIC();
            //$results2 = $this->Police_model->getPoliceOICModify();
			$data_array2 = array();
               foreach ($results2 as $row) {
                        $data_array2[] = $row;
                }
			$data['p_oic'] =  $data_array2;

			$data['body'] = $this->load->view('core/police/create_police', $data, true); 
			$this->load->view('layouts/layout_page', $data);  
		}else{
			 $this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED); 
		}
	}

	//Save Police Station Details to the database
	public function savePoliceData(){
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('pName', 'Police Station Name', 'required');               
        $this->form_validation->set_rules('address', 'Address', 'required');

        $this->form_validation->set_rules('eMail', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone Number', 'trim|required|min_length[10]|max_length[10]');

        $district =  trim($this->input->post('districtselector'));
        if($district == 0){
                     $this->form_validation->set_rules('districtselector', 'District', 'callback_district_check');
                     $this->form_validation->set_message('district_check', 'Please select District.');
        }

        $oic =  trim($this->input->post('oicselector'));
        if($oic == 0){
                     $this->form_validation->set_rules('oicselector', 'OIC', 'callback_oic_check');
                     $this->form_validation->set_message('oic_check', 'Please select Police OIC.');
        }

        $eMail = trim($this->input->post('eMail'));
        $phone = trim($this->input->post('phone'));  

        if(!$this->checkEmail($eMail)){
                   $this->form_validation->set_rules('eMail', 'E-Mail', 'callback_email_check');
                   $this->form_validation->set_message('email_check', 'E-Mail Already Exists.');
        }
        if(!$this->checkMobile($phone)){
                   $this->form_validation->set_rules('phone', 'Pnone No', 'callback_phone_check');
                   $this->form_validation->set_message('phone_check', 'Phone Number Already Exists.');
        }

                 
        if ($this->form_validation->run() == FALSE){
                   $this->new_police();
        }else{
        	$data['name'] = trim($this->input->post('pName'));
        	$data['address'] = trim($this->input->post('address'));
            $data['district'] = $this->input->post('districtselector');
            $data['phone'] = $this->input->post('phone');
            $data['email'] = trim($this->input->post('eMail'));
            $data['oic'] = $this->input->post('oicselector');
            $data['status'] = 'A';

            $this->load->model('Police_model');
            $insert_Id = $this->Police_model->savePolice($data);

            if($insert_Id != 0){
                $this->session->set_flashdata('success', 'Police '. SC_MSG_FOR_CREATION);
               } 
             else{
                $this->session->set_flashdata('error', ER_MSG_FOR_SAVE_DATA);
             }                        
             $this->new_police();  
        }
	}

	//update and delete police stations
	public function edit_police(){		
		if (Auth::has_permission('POLICE_UPDATE_PERMISSION')){
			$data['title']        = 'Manage Police';
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

        	$data['screen_name'] = "Manage Police Stations";
        	$this->load->model('Police_model');

        	$results = $this->Police_model->loadDataForModify();

        	$data_array = array();
               foreach ($results as $row) {
                        $data_array[] = $row;
                }
			$data['list'] =  $data_array;
			$data['delete_modal'] = $this->load->view('app/temp/model_delete', $data, true);
			$data['update_sucess_modal'] = $this->load->view('app/temp/model_update_sucess', $data, true);
			$data['update_error_Modal'] = $this->load->view('app/temp/model_update_error', $data, true);
			$data['body'] = $this->load->view('core/police/manage_police', $data, true); 
			$this->load->view('layouts/layout_page', $data);

		}else{
			$this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED); 
		}
	}

	//check email address already exists
    private function checkEmail($email){
        $this->load->model('Police_model');
        $results = $this->Police_model->checkEmailExists($email);
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
        $this->load->model('Police_model');
        $results = $this->Police_model->checkMobileExists($phone);
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

    //Update Police Station Details
    public function updatePolice(){
    	if (Auth::has_permission('POLICE_UPDATE_PERMISSION')) {
    		$id = $_POST['id'];
      		$data['id'] = $id;
			$data['title']        = 'Update Police';  
			$data['permissions']  = Auth::get_session_permissions();

			$this->load->model('Police_model');

			//get list of districts
    		$results = $this->Police_model->getDistricts();
    		$data_array = array();
               foreach ($results as $row) {
                        $data_array[] = $row;
                }
			$data['districts'] =  $data_array;

			//get list of police OIC
			$results2 = $this->Police_model->getPoliceOICModify();
			$data_array2 = array();
               foreach ($results2 as $row) {
                        $data_array2[] = $row;
                }
			$data['p_oic'] =  $data_array2;

    		$resultsNew = $this->Police_model->loadDataForUpdate($id);
    		$data['list'] =  $resultsNew;
			$data['body'] = $this->load->view('core/police/update_police', $data, true); 
			$this->load->view('layouts/layout_page', $data);
    	}else{
    		$this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED); 
    	}
    }

    //Update database record
    public function updatePoliceData(){
    	$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('pName', 'Police Station Name', 'required');               
        $this->form_validation->set_rules('address', 'Address', 'required');

        $this->form_validation->set_rules('eMail', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone Number', 'trim|required|min_length[9]|max_length[10]');

        $district =  trim($this->input->post('districtselector'));
        if($district == 0){
                     $this->form_validation->set_rules('districtselector', 'District', 'callback_district_check');
                     $this->form_validation->set_message('district_check', 'Please select District.');
        }

        $oic =  trim($this->input->post('oicselector'));
        if($oic == 0){
                     $this->form_validation->set_rules('oicselector', 'OIC', 'callback_oic_check');
                     $this->form_validation->set_message('oic_check', 'Please select Police OIC.');
        }

        if ($this->form_validation->run() == FALSE){
                $_POST['id'] = $this->input->post('id'); 
                $this->updatePolice();
        }else{
        	    $data['id'] = $this->input->post('id');
                $data['name'] = trim($this->input->post('pName'));
        		$data['address'] = trim($this->input->post('address'));
            	$data['district'] = $this->input->post('districtselector');
            	$data['phone'] = $this->input->post('phone');
           		$data['email'] = trim($this->input->post('eMail'));
            	$data['oic'] = $this->input->post('oicselector');

                    $this->load->model('Police_model');
                    $numRows = $this->Police_model->updatePolice($data);

                    if($numRows > 0){
                      $this->session->set_flashdata('success', 'Police '. SC_MSG_FOR_UPDATE);
                    }
                    else{
                         $this->session->set_flashdata('error', ER_MSG_FOR_UPDATE_DATA);
                    }

                    $this-> edit_police();
        }

    }

    //Delete Police Station Details
    public function deleteData(){
        $data['id'] = $_GET['id'];
        $data['delete_date'] = $this->get_current_date();
        $data['delete_time'] = $this->get_current_time();
        $this->load->model('Police_model');
        $status = $this->Police_model->deleteData($data);
        return $status;
    }
}
?>