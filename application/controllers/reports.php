<?php
/**
* Class:  Reports Controller 
* Author: Dinesh Rathnayake
* Date:   07/06/2021
*/
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'controllers/'.'Base.php');
class Reports extends Base{
	
	public function __construct() {
        parent::__construct();

    }
 
	public function index(){ 
		$data['title'] = 'Reports';   
        $data['permissions'] = Auth::get_session_permissions(); 
    	$data['body'] = $this->load->view('app/dashboard/app', $data, true);
    	/*print_r('<pre>');
    	print_r($data);
		print_r('</pre>');
		die;*/
    	$this->load->view('layouts/layout_page', $data); 
	}

	//Date Range Report
	public function dateRange(){

		if (Auth::has_permission('REPORTS_STATUS')) {
			$data['title']        = 'Complains - Date Range Report';  
			$data['permissions']  = Auth::get_session_permissions();
			$data['body'] = $this->load->view('core/reports/date_range', $data, true);   
			$this->load->view('layouts/layout_page', $data);  
		}else{
			 $this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED); 
		}
	}

	//View Date Range Report
	public function viewDateRange(){
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

        $this->form_validation->set_rules('fromdate', 'From Date', 'required');
        $this->form_validation->set_rules('todate', 'To Date', 'required');

        if ($this->form_validation->run() == FALSE){
                   
                $this->dateRange();
        }else{
			$fromDate = $_POST['fromdate'];
			$toDate = $_POST['todate'];
			$rollId = $_SESSION['roll_id']; 
            $user_id = $_SESSION['user_id'];
        	$userName = $_SESSION['user_name'];
        	$police_station = $_SESSION['police_station'];

        	$this->load->model('Report_model');
    		$results = $this->Report_model->viewDateRangeReport($fromDate, $toDate, $rollId, $user_id, $userName, $police_station);
    		$data_array = array();
               foreach ($results as $row) {
                        $data_array[] = $row;
                }

            $data['datepicker'] = false;
        	$data['datatables'] = true;
        	$data['dataexport'] = false;
        	$data['bootstrap_select'] = true;
  
			$data['list'] =  $data_array;				
			$data['title']        = 'Complains - Date Range Report';  
			$data['permissions']  = Auth::get_session_permissions();		
			$data['body'] = $this->load->view('core/reports/date_range', $data, true);   
			$this->load->view('layouts/layout_page', $data);
	}
	}

	//complains type Report
	public function type(){		
		if (Auth::has_permission('REPORTS_STATUS')) {
			$data['title']        = 'Complains - Type Report';  
			$data['permissions']  = Auth::get_session_permissions();

			//get criminal types
			$this->load->model('Complain_model');
    		$results = $this->Complain_model->getCrimes();
    		$data_array = array();
               foreach ($results as $row) {
                        $data_array[] = $row;
                }
			$data['crimes'] =  $data_array;

			$data['body'] = $this->load->view('core/reports/type', $data, true);   
			$this->load->view('layouts/layout_page', $data);  
		}else{
			 $this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED); 
		}
	}

    //view complain type report
	public function viewType(){

		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('crimeselector', 'Criminal Type', 'required');

        $crimeType =  $_POST['crimeselector'];
        if($crimeType == 0){
            $this->form_validation->set_rules('crimeselector', 'Criminal Type', 'callback_crimetype_check');
            $this->form_validation->set_message('crimetype_check', 'Please select criminal type.');
            $this->type();
        }else{      
        
        	$type = $_POST['crimeselector'];        	
			$rollId = $_SESSION['roll_id']; 
            $user_id = $_SESSION['user_id'];
        	$userName = $_SESSION['user_name'];
        	$police_station = $_SESSION['police_station'];        

        	$this->load->model('Report_model');
    		$results = $this->Report_model->viewTypeReport($type, $rollId, $user_id, $userName, $police_station);
    		$data_array = array();
               foreach ($results as $row) {
                        $data_array[] = $row;
                }

            $this->load->model('Complain_model');
            $results2 = $this->Complain_model->getCrimes();
    		$data_array2 = array();
               foreach ($results2 as $row) {
                        $data_array2[] = $row;
                }
			$data['crimes'] =  $data_array2;

            $data['datepicker'] = false;
        	$data['datatables'] = true;
        	$data['dataexport'] = false;
        	$data['bootstrap_select'] = true;
  
			$data['list'] =  $data_array;				
			$data['title']        = 'Complains - Type Report';  
			$data['permissions']  = Auth::get_session_permissions();		
			$data['body'] = $this->load->view('core/reports/type', $data, true);   
			$this->load->view('layouts/layout_page', $data);
        	

        }
	}

	//complains status report
	public function status(){		
		if (Auth::has_permission('REPORTS_STATUS')) {
			$data['title']        = 'Complains - Status Report';  
			$data['permissions']  = Auth::get_session_permissions();
			$data['body'] = $this->load->view('core/reports/status', $data, true);   
			$this->load->view('layouts/layout_page', $data);  
		}else{
			 $this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED); 
		}
	}

	//View Complain Status Report
	public function viewStatus(){
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('statusselector', 'Criminal Status', 'required');

        $crimeStatus =  $_POST['statusselector'];

        if($crimeStatus == ""){
            $this->form_validation->set_rules('statusselector', 'Criminal Status', 'callback_status_check');
            $this->form_validation->set_message('status_check', 'Please select criminal status.');
            $this->status();
        }else{       	
			$rollId = $_SESSION['roll_id']; 
            $user_id = $_SESSION['user_id'];
        	$userName = $_SESSION['user_name'];
        	$police_station = $_SESSION['police_station'];   

        	$this->load->model('Report_model');
    		$results = $this->Report_model->viewStatusReport($crimeStatus, $rollId, $user_id, $userName, $police_station);
    		$data_array = array();
               foreach ($results as $row) {
                        $data_array[] = $row;
                }

            $data['datepicker'] = false;
        	$data['datatables'] = true;
        	$data['dataexport'] = false;
        	$data['bootstrap_select'] = true;
  
			$data['list'] =  $data_array;				
			$data['title']        = 'Complains - Status Report';  
			$data['permissions']  = Auth::get_session_permissions();		
			$data['body'] = $this->load->view('core/reports/status', $data, true);   
			$this->load->view('layouts/layout_page', $data);
        }
	}

	//complains police station report
	public function police(){
		if (Auth::has_permission('REPORTS_STATUS')) {
			$data['title']        = 'Complains - Police Station Report';  
			$data['permissions']  = Auth::get_session_permissions();

			//get list of districts
			$this->load->model('Report_model');
    		$results = $this->Report_model->listPoliceStations();
    		$data_array = array();
               foreach ($results as $row) {
                        $data_array[] = $row;
                }
			$data['districts'] =  $data_array;

			$data['body'] = $this->load->view('core/reports/police', $data, true);   
			$this->load->view('layouts/layout_page', $data);  
		}else{
			 $this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED); 
		}

	}


	//display records according to police station 
	public function viewPolice(){

		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('policeselector', 'Police Station', 'required');

        $policeStation =  $_POST['policeselector'];

        if($policeStation == 0){
            $this->form_validation->set_rules('policeselector', 'Police Station', 'callback_police_check');
            $this->form_validation->set_message('police_check', 'Please select police station.');
            $this->police();
        }else{       	
			$rollId = $_SESSION['roll_id']; 
        	$userName = $_SESSION['user_name'];
        	$policeStation = $_POST['policeselector'];
   

        	$this->load->model('Report_model');
    		$results = $this->Report_model->viewPoliceReport($rollId, $userName, $policeStation);
    		$data_array = array();
               foreach ($results as $row) {
                        $data_array[] = $row;
                }

            $data['datepicker'] = false;
        	$data['datatables'] = true;
        	$data['dataexport'] = false;
        	$data['bootstrap_select'] = true;

        	$results2 = $this->Report_model->listPoliceStations();
    		$data_array2 = array();
               foreach ($results2 as $row) {
                        $data_array2[] = $row;
                }
			$data['districts'] =  $data_array2;
  
			$data['list'] =  $data_array;				
			$data['title']        = 'Complains - Police Station Report';  
			$data['permissions']  = Auth::get_session_permissions();		
			$data['body'] = $this->load->view('core/reports/police', $data, true);   
			$this->load->view('layouts/layout_page', $data);
	}
}

    //officer analysis report
    public function analysys(){     
        if (Auth::has_permission('REPORTS_STATUS')) {
            $data['title']        = 'Officer - Analysis Report';  
            $data['permissions']  = Auth::get_session_permissions();

            //get police stations for admin
            $rollId = $_SESSION['roll_id']; 

            if($rollId == 1){
                $this->load->model('Complain_model');
                $results = $this->Complain_model->listPoliceStations();
                $data_array = array();
                   foreach ($results as $row) {
                            $data_array[] = $row;
                    }
                $data['stations'] =  $data_array;
            }elseif($rollId == 2){
                //get police station
                $policeStation = $_SESSION['police_station'];                
                $this->load->model('User_model');
                $results = $this->User_model->listPoliceOfficers($policeStation);
                $data_array = array();
                foreach ($results as $row) {
                    $data_array[] = $row;
                }
                 $data['officers'] =  $data_array;
            } 
           

            $data['body'] = $this->load->view('core/reports/analysis', $data, true);   
            $this->load->view('layouts/layout_page', $data);  
        }else{
             $this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED); 
        }
    }

    //display analysis report
    public function viewAnalysis(){


        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('officerselector', 'Police Officer', 'required');

        $policeOfficer =  $_POST['officerselector'];
        if($policeOfficer == 0){
            $this->form_validation->set_rules('officerselector', 'Police Officer', 'callback_policeOfficer_check');
            $this->form_validation->set_message('policeOfficer_check', 'Please select police officer.');
            $this->analysys();
        }else{  

            $this->load->model('Report_model');
            $results = $this->Report_model->viewOfficerDetails($policeOfficer);

            $data['officerData'] = $results;

            //get police officers
            $policeStation = $_SESSION['police_station']; 

            //for admin get the selected police station 
            if($policeStation == 0){
                if(isset($_POST['policeStation'])){
                    $policeStation = $_POST['policeStation'];
                }else{
                    $policeStation = 2;
                }
            }  
                        
            $this->load->model('User_model');
            $results2 = $this->User_model->listPoliceOfficers($policeStation);
            $data_array = array();
            foreach ($results2 as $row) {
                $data_array[] = $row;
            }
            $data['officers'] =  $data_array;

            $results3 = $this->Report_model->listPoliceOfficerComplains($policeOfficer);
            $data_array3 = array();
            foreach ($results3 as $row) {
                $data_array3[] = $row;
            }

            $data['datepicker'] = false;
            $data['datatables'] = true;
            $data['dataexport'] = false;
            $data['bootstrap_select'] = true;
  
            $data['list'] =  $data_array3;               
            $data['title']        = 'Officer - Analysis Report';  
            $data['permissions']  = Auth::get_session_permissions();        
            $data['body'] = $this->load->view('core/reports/analysis', $data, true);   
            $this->load->view('layouts/layout_page', $data);
            

        }
    }

    public function getPoliceOfficers(){
      $policeStation = $_GET['policeStation'];
      $this->load->model('User_model');
      $results = $this->User_model->listPoliceOfficers($policeStation);
      $data_array = array();
               foreach ($results as $row) {
                        $data_array[] = $row;
                }          
        echo json_encode($data_array);  
        return json_encode($data_array);
    }

    //view delayed report
    public function delayed(){
        if (Auth::has_permission('REPORTS_STATUS')) {
            $data['title']        = 'Complain - Delayed Report';  
            $data['permissions']  = Auth::get_session_permissions();

            $data['body'] = $this->load->view('core/reports/delayed', $data, true);   
            $this->load->view('layouts/layout_page', $data);  
        }else{
             $this->show_error('permission', ER_MSG_FUNCTION_IS_BLOCKED); 
        }
    }

    //view delayed report data
    public function viewDuraion(){
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('durationselector', 'Duration', 'required');

        $duration =  $_POST['durationselector'];
        if($duration == 0){
            $this->form_validation->set_rules('durationselector', 'Duration', 'callback_duration_check');
            $this->form_validation->set_message('duration_check', 'Please Select Duration.');
            $this->delayed();
        }else{            
            $duration = $_POST['durationselector']; 
            $rollId = $_SESSION['roll_id']; 
            $user_id = $_SESSION['user_id'];
            $userName = $_SESSION['user_name'];
            $police_station = $_SESSION['police_station']; 
            $currentDate = $this->get_current_date();
            $this->load->model('Report_model');
            $results = $this->Report_model->viewDelayedReport($duration, $rollId, $user_id, $userName, $police_station,$currentDate);
            $data_array = array();
               foreach ($results as $row) {
                        $data_array[] = $row;
                }

            $data['datepicker'] = false;
            $data['datatables'] = true;
            $data['dataexport'] = false;
            $data['bootstrap_select'] = true;
  
            $data['list'] =  $data_array; 
            $data['duration'] = $duration;              
            $data['title']        = 'Complains - Delayed Report';  
            $data['permissions']  = Auth::get_session_permissions();        
            $data['body'] = $this->load->view('core/reports/delayed', $data, true);   
            $this->load->view('layouts/layout_page', $data);
    }
}
}
?>