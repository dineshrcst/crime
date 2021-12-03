<?php
/**
* Class:  Complain_Model
* Author: Dinesh Rathnayake
* Date:   4/6/2021
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Complain_model extends CI_Model{

	public function __construct(){
		parent::__construct(); 
		$this->load->database();
	}

	public function getCrimes(){	
		$query=$this->db->get("crime");
	    return $query->result();
	}

	//Save Complain Details to teh Database
	public function saveComplain($data){
		
		$this->db->insert('criminal_case',$data);
        return $this->db->insert_id();
	}

	//Save uploaded file details
	public function saveFile($data){
		$this->db->insert('upload_files',$data);
        return true;
	}
 
	//return all pending complains
	public function vieWPendingComplains(){

    	$roll_id =  $_SESSION['roll_id']; 
        $police_station = $_SESSION['police_station'];

        if($roll_id == 1){
        	$query = "select c1.id as id, c1.date as date, c1.time as time, c1.address as address, c1. description as description,c1.status as status, c2.name as type, p.name as near_police, c1.near_police as np from criminal_case c1 inner join crime c2 on c1.type = c2.id inner join police_station p on p.id = c1.near_police  where c1.status = 'H'";
        }elseif ($roll_id == 2) {
        	$query = "select c1.id as id, c1.date as date, c1.time as time, c1.address as address, c1. description as description,c1.status as status, c2.name as type, p.name as near_police, c1.near_police as np from criminal_case c1 inner join crime c2 on c1.type = c2.id inner join police_station p on p.id = c1.near_police
        	where (c1.status = 'P' OR c1.status = 'M') and near_police =".$police_station."";
        }

    	
    	$data = $this->db->query($query);

    	$query2 = "select id, criminal_id, count(*) as countNew from upload_files GROUP by criminal_id";
		$data2 = $this->db->query($query2);

		$returnData1 =  $data->result();
		$returnData2 =  $data2->result();               
		
		for($i=0;$i<sizeof($returnData1);$i++){ 
			for($j=0;$j<sizeof($returnData2);$j++){
				$count1 = $returnData2[$j]->countNew;
				if($returnData1[$i]->id == $returnData2[$j]->criminal_id){
					$returnData1[$i]->count =  $returnData2[$j]->countNew;
				}
			}
		}
		return $returnData1;
	}

	//Approve Complains
	public function approveData($data){ 
		$roll_id =  $_SESSION['roll_id'];
		if($roll_id == 1){
			$updateData = array(
		        'status' 		    => "A",
		        'approve_user' 		=> $data['approve_user'],
		        'approve_date' 		=> $data['approve_date'],
		        'approve_time' 		=> $data['approve_time']
				);
		}elseif($roll_id == 2){
			$updateData = array(
		    'status' 		    => "A",
		    'approve_user' 		=> $data['approve_user'],
		    'approve_date' 		=> $data['approve_date'],
		    'approve_time' 		=> $data['approve_time'],
		    'assign_police'     => $data['near_police']
			);
		}
		
		$this->db->where("id",$data['id']);
		$this->db->update("criminal_case",$updateData);
		return $this->db->affected_rows();
	}
	
	//Reject Complains
	public function rejectData($data){
			$updateData = array(
	        'status' 		    => "R",
	        'reject_user' 		=> $data['reject_user'],
	        'reject_date' 		=> $data['reject_date'],
	        'reject_time' 		=> $data['reject_time'],
	        'reject_reason'     => $data['message']
			);
		$this->db->where("id",$data['id']);
		$this->db->update("criminal_case",$updateData);
		return $this->db->affected_rows();
	}

	//Load data for update and delete
	public function loadDataForModify(){
		$userName = trim($_SESSION['user_name']);

		if("ADMIN" == strtoupper($userName)){
			$query = "select c1.id as id, c1.date as date, c1.time as time, c1.address as address, c1. description as description, c2.name as type, c1.status as status, p.name as policeStation from criminal_case c1 inner join crime c2 
    	    	on c1.type = c2.id left join police_station p on C1.assign_police = p.id";
		}else{
			$query = "select c1.id as id, c1.date as date, c1.time as time, c1.address as address, c1. description as description, c2.name as type, c1.status as status ,p.name as policeStation from criminal_case c1 inner join crime c2 
    	    	on c1.type = c2.id left join police_station p on C1.assign_police = p.id  
    	    	where (c1.status = 'P' OR c1.status = 'R' OR c1.status = 'M') and 
    	    	c1.enter_user = '".$userName."'";
		}
		$data = $this->db->query($query);

		$query2 = "select id, criminal_id, count(*) as countNew from upload_files GROUP by criminal_id";
		$data2 = $this->db->query($query2);

		$returnData1 =  $data->result();
		$returnData2 =  $data2->result();               
		
		for($i=0;$i<sizeof($returnData1);$i++){
			for($j=0;$j<sizeof($returnData2);$j++){
				$count1 = $returnData2[$j]->countNew;
				if($returnData1[$i]->id == $returnData2[$j]->criminal_id){
					$returnData1[$i]->count =  $returnData2[$j]->countNew;
				}
			}
		}
		return $returnData1;
	}


	//delete Complains
	public function deleteData($data){
		$updateData = array(
	        'status' 		    => "D",
	        'delete_user' 		=> $data['delete_user'],
	        'delete_date' 		=> $data['delete_date'],
	        'delete_time' 		=> $data['delete_time']
			);
		$this->db->where("id",$data['id']);
		$this->db->update("criminal_case",$updateData);
	}

	/*//View complains which are not assigned
	public function viewAssignPendingComplains($roll_id,$police_station){
		$query = "";
		if ($roll_id == 1){
			$query = "select c1.id as id, c1.date as date, c1.time as time, c1.address as address, c1. description as description, c2.name as type, c1.status as status 
			    from criminal_case c1 inner join crime c2 
    	    	on c1.type = c2.id where assign_police = 0 and status = 'A'";
		}else if ($roll_id == 2){
			$query = "select c1.id as id, c1.date as date, c1.time as time, c1.address as address, c1. description as description, c2.name as type, c1.status as status 
			    from criminal_case c1 inner join crime c2 
    	    	on c1.type = c2.id where assign_police = ".$police_station." and assign_officer = 0 and status = 'A'";
		}

		$data = $this->db->query($query);
		
		$query2 = "select id, criminal_id, count(*) as countNew from upload_files GROUP by criminal_id";
		$data2 = $this->db->query($query2);

		$returnData1 =  $data->result();
		$returnData2 =  $data2->result();               
		
		for($i=0;$i<sizeof($returnData1);$i++){
			for($j=0;$j<sizeof($returnData2);$j++){
				$count1 = $returnData2[$j]->countNew;
				if($returnData1[$i]->id == $returnData2[$j]->criminal_id){
					$returnData1[$i]->count =  $returnData2[$j]->countNew;
				}
			}
		}
		return $returnData1;
	}*/


	//View complains which are not assigned
	public function viewAssignPendingComplains($roll_id,$police_station){
		$query = "";
		if ($roll_id == 1){
			$query = "select c1.id as id, c1.date as date, c1.time as time, c1.address as address, c1. description as description, c2.name as type, c1.status as status, p.name as near_police, c1.near_police as np from criminal_case c1 inner join crime c2 
    	    	on c1.type = c2.id inner join police_station p on p.id = c1.near_police 
    	    	where c1.assign_police = 0 and c1.status = 'A'";
		}else if ($roll_id == 2){
			$query = "select c1.id as id, c1.date as date, c1.time as time, c1.address as address, c1. description as description, c2.name as type, c1.status as status, p.name as near_police, c1.near_police as np from criminal_case c1 inner join crime c2 
    	    	on c1.type = c2.id inner join police_station p on p.id = c1.near_police  
    	    	where c1.assign_police = ".$police_station." and c1.assign_officer = 0 and c1.status = 'A'";
		}

		$data = $this->db->query($query);
		
		$query2 = "select id, criminal_id, count(*) as countNew from upload_files GROUP by criminal_id";
		$data2 = $this->db->query($query2);

		$returnData1 =  $data->result();
		$returnData2 =  $data2->result();               
		
		for($i=0;$i<sizeof($returnData1);$i++){
			for($j=0;$j<sizeof($returnData2);$j++){
				$count1 = $returnData2[$j]->countNew;
				if($returnData1[$i]->id == $returnData2[$j]->criminal_id){
					$returnData1[$i]->count =  $returnData2[$j]->countNew;
				}
			}
		}
		return $returnData1;
	}
	//Load list of police stations for administrator
	public function listPoliceStations(){
		$this->db->from('police_station');
    	$this->db->where('status != ', 'D');
    	$query = $this->db->get();
    	return $query->result();

	}

	//Load list of police officers related to police station
	public function listPoliceOfficers($police_station){
		$this->db->from('user');
    	$this->db->where('rollid',3 );
    	$this->db->where('police_station',$police_station );
    	$data = $this->db->get();


    	$query2 = "select assign_officer as id , COUNT(*) as count from criminal_case where assign_officer != 0 and action != 'R' group By assign_officer";

    	$data2 = $this->db->query($query2);

    	$returnData1 =  $data->result();
		$returnData2 =  $data2->result(); 
 
    	for($i=0;$i<sizeof($returnData1);$i++){
			for($j=0;$j<sizeof($returnData2);$j++){
				if($returnData1[$i]->user_id == $returnData2[$j]->id){
					$returnData1[$i]->count =  $returnData2[$j]->count;
				}
			}
		}
		/*
		echo "<pre>";
	    print_r($returnData1);
	    echo "</pre>";
	    die;*/
		return $returnData1;
	}

	//Assign police station to the complain
	public function assignPolice($data){
		$updateData = array(
	        'assign_police' 	=> $data['policeStation']
			);
		$this->db->where("id",$data['complainId']);
		$this->db->update("criminal_case",$updateData);
	}

	//Assign police officer to the complain
	public function assignOfficer($data){
		$updateData = array(
	        'assign_officer' 	=> $data['policeOfficer'],
	        'assign_date' 	=> $data['assignDate']
			);
		$this->db->where("id",$data['complainId']);
		$this->db->update("criminal_case",$updateData);
	}

	//load data for update according to particular id
	public function loadDataForUpdate($id){
		$this->db->from('criminal_case');
    	$this->db->where('id', $id );
    	$query = $this->db->get();
    	return $query->result();
	}
	
	//update complain details to the database
	public function updateComplain($data){
		$updateData = array(
	        'type' 		        => $data['type'],
	        'date' 				=> $data['date'],
	        'time'              => $data['time'],
	        'address' 			=> $data['address'],
	        'description' 		=> $data['description'],
	        'withness_name_1'   => $data['withness_name_1'],
	        'withness_phone_1'	=> $data['withness_phone_1'],									
	        'withness_name_2'   => $data['withness_name_2'],
	        'withness_phone_2'  => $data['withness_phone_2'],
	        'latitude'			=> $data['latitude'],
	        'longitude'			=> $data['longitude'],
	        'modify_user'       => $data['modify_user'],
	        'modify_date'		=> $data['modify_date'],
	        'modify_time'		=> $data['modify_time'],
	        'status'			=> $data['status']
			);
		$this->db->where("id",$data['id']);
		$this->db->update("criminal_case",$updateData);
		return $this->db->affected_rows();
	}

	//load the images for complain
	public function loadImages($id){
		$this->db->from('upload_files');
    	$this->db->where('criminal_id' , $id);
    	$query = $this->db->get();
    	return $query->result();
	}

	//view Complains to take actions
	public function viewComplains($roll_id,$police_station,$user,$user_id){
		if($roll_id == 1){
			$query = "select c1.id as id, c1.date as date, c1.time as time, c1.address as address, c1. description as description, c2.name as type, c1.action as status, d. file_name,c1.crime_person_name as crime_person_name, c1.crime_person_address as crime_person_address  
			    from criminal_case c1 inner join crime c2 
    	    	on c1.type = c2.id left join upload_docs d on c1.id = d.criminal_id";
		}elseif ($roll_id == 2) {
			$query = "select c1.id as id, c1.date as date, c1.time as time, c1.address as address, c1. description as description, c2.name as type, c1.action as status , d. file_name, c1.crime_person_name as crime_person_name, c1.crime_person_address as crime_person_address  
			    from criminal_case c1 inner join crime c2 
    	    	on c1.type = c2.id left join upload_docs d on c1.id = d.criminal_id 
    	    	where assign_police = ".$police_station."";
		}elseif ($roll_id == 3) {
			$query = "select c1.id as id, c1.date as date, c1.time as time, c1.address as address, c1. description as description, c2.name as type, c1.action as status , d. file_name ,c1.crime_person_name as crime_person_name, c1.crime_person_address as crime_person_address  
			    from criminal_case c1 inner join crime c2 
    	    	on c1.type = c2.id left join upload_docs d on c1.id = d.criminal_id 
    	    	where assign_police = ".$police_station." and assign_officer = ".$user_id."";
		}elseif ($roll_id == 4) {
			$query = "select c1.id as id, c1.date as date, c1.time as time, c1.address as address, c1. description as description, c2.name as type, c1.action as status , d. file_name, c1.crime_person_name as crime_person_name, c1.crime_person_address as crime_person_address  
			    from criminal_case c1 inner join crime c2 
    	    	on c1.type = c2.id left join upload_docs d on c1.id = d.criminal_id  
    	    	where enter_user = '".$user."'";
		}else{
			$query ="";
		}
		$data = $this->db->query($query);
		
		$query2 = "select id, criminal_id, count(*) as countNew from upload_files GROUP by criminal_id";
		$data2 = $this->db->query($query2);

		$returnData1 =  $data->result();
		$returnData2 =  $data2->result();               
		
		for($i=0;$i<sizeof($returnData1);$i++){
			for($j=0;$j<sizeof($returnData2);$j++){
				$count1 = $returnData2[$j]->countNew;
				if($returnData1[$i]->id == $returnData2[$j]->criminal_id){
					$returnData1[$i]->count =  $returnData2[$j]->countNew;
				}
			}
		}
		return $returnData1;
	}

	//update complain status
	public function updateStatus($data){
		$updateData = array(
	        'action' 		    => $data['action'],
	        'action_user' 		=> $data['action_user'],
	        'action_date' 		=> $data['action_date'],
	        'action_time' 		=> $data['action_time']
			);
		$this->db->where("id",$data['id']);
		$this->db->update("criminal_case",$updateData);
	}

	//Get criminal location
	public function getGeoLocation($id){
		$query = "Select id,latitude,longitude from criminal_case where id=".$id."";
		$data = $this->db->query($query);
		return $data->result(); 
	}

	//update complain action
	public function updateAction($data){
		
		$this->db->insert('criminal_logs',$data);
        $insertId =  $this->db->insert_id();

        //update main table
        if($data['action'] == 'I'){
        	$updateData = array(
	        'action' 		    => $data['action'],
	        'action_user' 		=> $data['log_user'],
	        'action_date' 		=> $data['log_date'],
	        'action_time' 		=> $data['log_time'],
	        'accept_date'      => $data['log_date']
			);
        	
        }elseif($data['action'] == 'R' || $data['action'] == 'C'){        	
        	$updateData = array(
	        'action' 		    => $data['action'],
	        'action_user' 		=> $data['log_user'],
	        'action_date' 		=> $data['log_date'],
	        'action_time' 		=> $data['log_time'],
	        'resolve_date'      => $data['log_date']
			);
        }else{
        	$updateData = array(
	        'action' 		    => $data['action'],
	        'action_user' 		=> $data['log_user'],
	        'action_date' 		=> $data['log_date'],
	        'action_time' 		=> $data['log_time']
			);
        }
		$this->db->where("id",$data['complain_id']);
		$this->db->update("criminal_case",$updateData);
		return $this->db->affected_rows();
	}

	//load history of the criminal cae
	public function loadHistory($id){
		$this->db->from('criminal_logs');
    	$this->db->where('complain_id' , $id);
    	$query = $this->db->get();
    	return $query->result();
	}

	//function to get save images count
	public function getSaveImageCount($id){
		$query = "select count(*) as count from upload_files where criminal_id = ".$id."";
		$data = $this->db->query($query);
		$results =  $data->result();

		foreach ($results as $row)
        {
            $counRec =  $row->count;
        }
        return $counRec;
	}

	//Assign Complains to the admin
	public function assignAdmin($data){ 
		$updateData = array(
	        'status' 		    => "H",
	        'assign_user' 		=> $data['assign_user'],
	        'assign_date' 		=> $data['assign_date'],
	        'assign_time' 		=> $data['assign_time']
			);
		$this->db->where("id",$data['id']);
		$this->db->update("criminal_case",$updateData);
		return $this->db->affected_rows();
	}

	//Save documents for the complains
	public function saveComplainDocs($data){
		$this->db->insert('upload_docs',$data);
        return $this->db->insert_id();
	}

	//complain rejected by the police offier
	public function rejOfficerAction($data){
		$this->db->insert('criminal_logs',$data);
        $insertId =  $this->db->insert_id();

        //update main table
        $updateData = array(
	        'action' 		    => 'P',
	        'assign_officer'    =>  0,
	        'action_user' 		=> $data['log_user'],
	        'action_date' 		=> $data['log_date'],
	        'action_time' 		=> $data['log_time']
			);
		$this->db->where("id",$data['complain_id']);
		$this->db->update("criminal_case",$updateData);
		return $this->db->affected_rows();
	}

	//get crime category by id
	public function getCategorybyId($crimeId){
		$query = "select name from crime where id = ".$crimeId."";
		$data = $this->db->query($query);
		$results =  $data->result();
		$category = "";
		foreach ($results as $row)
        {
            $category =  $row->name;
        }
        return $category;
	}

	//get police oic phone number
	public function getOICPhone($policeStation){
		$query = "select phone from user where police_station = ".$policeStation." and rollid = 2";
		$data = $this->db->query($query);
		$results =  $data->result();
		$phone = 0;
		foreach ($results as $row)
        {
            $phone =  $row->phone;
        }
        return $phone;
	}
}
?>