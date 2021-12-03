<?php
/**
* Class:  User_Model
* Author: Dinesh Rathnayake  
* Date:   4/6/2021
*/   
defined('BASEPATH') OR exit('No direct script access allowed');


class User_model extends CI_Model{

public function __construct(){
			parent::__construct(); 
			$this->load->database();
}
//Load data for update and delete
public function loadDataForModify(){

	$userName = trim($_SESSION['user_name']);

		if("ADMIN" == strtoupper($userName)){
			$query = "select u.user_id as id, u.username as username, u.firstname as fName, u.lastname as lName, u.email as email, u.phone as phone, roll_name as rName, u.status as status  
			    from user u inner join user_roll r 
    	    	on u.rollid = r.roll_id where (u.status = 'A' OR  u.status = 'R') and u.username != 'admin'";
		}else{
			$query = "";
		}
		$data = $this->db->query($query);
		return $data->result();
}

//delete users
	public function deleteData($data){
		$updateData = array(
	        'status' 		    => "D",
	        'delete_date' 		=> $data['delete_date'],
	        'delete_time' 		=> $data['delete_time']
			);
		$this->db->where("user_id",$data['id']);
		$this->db->update("user",$updateData);
	}

	//load data for update according to particular id
	public function loadDataForUpdate($id){
		$this->db->from('user');
    	$this->db->where('user_id', $id );
    	$query = $this->db->get();
    	return $query->result();
	}

	//Return User Types
	public function getUserTypes(){
		$this->db->from('user_roll');
    	$this->db->where('roll_name != ', 'Administrator');
    	$query = $this->db->get();
    	return $query->result();
	}

	//Return Police Stations
	public function getPoliceStation(){	 
		$query=$this->db->get("police_station");
	    return $query->result();
	}

	//update user details
	public function updateUser($data){

		//get previous police station
		$query = "select police_station from user where user_id = ".$data['id']."";
		$result = $this->db->query($query);

		foreach ($result->result_array() as $row)
		{
	        $policeStation =  $row['police_station'];
		}


		$updateData = array(
	        'firstname' 	   => $data['firstname'],
	        'lastname' 		   => $data['lastname'],
	        'email'            => $data['email'],
	        'phone' 		   => $data['phone'],
	        'rollid' 		   => $data['rollid'],
	        'police_station'   => $data['police_station']
			);
		$this->db->where("user_id",$data['id']);
		$this->db->update("user",$updateData);

		//check police station updated for OIC
		if (($policeStation != $data['police_station']) and ($data['rollid'] == 2)){

			//Set 0 to already assign oic
			$updateData2 = array(
		    'police_station' 	=> 0
			);
			$this->db->where("police_station",$data['police_station']);
			$this->db->where("rollid",2);
			$this->db->where('user_id !=', $data['id']);
			$this->db->update("user",$updateData2);

			//Set 0 to already assign oic in police station
			$updateData3 = array(
		    'oic' 	=> 0
			);
			$this->db->where("oic",$data['id']);
			$this->db->update("police_station",$updateData3);

			//Set new OIC to police station
			$updateData4 = array(
		    'oic' 	=> $data['id']
			);
			$this->db->where("id",$data['police_station']);
			$this->db->update("police_station",$updateData4);
			
		}

		return $this->db->affected_rows();
	}

	//return all pending users
	public function vieWPendingUsers(){
    	$query = "select u.user_id as id, u.username as username, u.firstname as fName, u.lastname as lName, u.email as email, u.phone as phone, roll_name as rName, u.status as status   
			    from user u inner join user_roll r 
    	    	on u.rollid = r.roll_id where u.status = 'P'";
    	$data = $this->db->query($query);
		return $data->result(); 
	}

	//Approve Users
	public function approveData($data){
		$updateData = array(
	        'status' 		    => "A",
	        'approve_date' 		=> $data['approve_date'],
	        'approve_time' 		=> $data['approve_time']
			);
		$this->db->where("user_id",$data['id']);
		$this->db->update("user",$updateData);
	}

	//Reject Users
	public function rejectData($data){
		$updateData = array(
	        'status' 		    => "R",
	        'reject_date' 		=> $data['reject_date'],
	        'reject_time' 		=> $data['reject_time'],
	        'reject_reason'     => $data['message']
			);
		$this->db->where("user_id",$data['id']);
		$this->db->update("user",$updateData);
	}

	//Get users list not assign for police stations
	public function viewAssignPendingUsers(){
			$query = "select u.user_id as id, u.username as username, u.firstname as fName, u.lastname as lName, u.email as email, u.phone as phone, roll_name as rName, u.status as status  
			    from user u inner join user_roll r 
    	    	on u.rollid = r.roll_id where u.police_station = 0 and u.status = 'A' and 
    	    	(rollid = 2 or rollid = 3)";
			$data = $this->db->query($query);
			return $data->result();
	}

	//Load police stations for assign users
	public function listPoliceStations(){
		$this->db->from('police_station');
        $this->db->where('status != ', 'D');
        $query = $this->db->get();
        return $query->result();
	}
 
	//Assign police station to the user
	public function assignPolice($data){
		$updateData = array(
	        'police_station' 	=> $data['policeStation']
			);
		$this->db->where("user_id",$data['userId']);
		$this->db->update("user",$updateData);

		//check oic already assign to police station

		if($data['rollId'] == 1){
			$query = "select oic from police_station where id = ".$data['policeStation']."";
			$result = $this->db->query($query);

			foreach ($result->result_array() as $row)
			{
		        $policeOic =  $row['oic'];
			}
	       //un Assign already assigned oic.
			if ($policeOic != 0){
				$updateData2 = array(
		        'police_station' 	=> 0
				);
				$this->db->where("user_id",$policeOic);
				$this->db->update("user",$updateData2);
			}

			//update new OIC to the police station
				$updateData3 = array(
		        'oic' 	=> $data['userId']
				);
				$this->db->where("id",$data['policeStation']);
				$this->db->update("police_station",$updateData3);
				return $this->db->affected_rows();
		}
	}

	//get email address for user id
	public function getUserMail($userId){
		$query = "select email from user where user_id = ".$userId."";
		$result = $this->db->query($query);

		foreach ($result->result_array() as $row)
		{
	        $email =  $row['email'];
		}
		return trim($email);
	}

	//Get Email from userName
	public function getUserMailFromUserName($userName){
		$query = "select email from user where username = '".$userName."'";
		$result = $this->db->query($query);

		$email = '';
		foreach ($result->result_array() as $row)
		{
	        $email =  $row['email'];
		}
		return trim($email);
	}

	//Check email address already exists
	public function checkEmailExists($eMail,$id){
		$query = "select count(*) as count from user where email = '".$eMail."' and status != 'D' and user_id != ".$id."";
		$data = $this->db->query($query);
		return $data->result();

	}

	//Check phone number already exists
	public function checkMobileExists($phone,$id){
		$query = "select count(*) as count from user where phone = '".$phone."' and status != 'D' and user_id != ".$id."";
		$data = $this->db->query($query);
		return $data->result();

	}

	//check user is active
	public function isActivated($userName)
	{
		$query = "select count(*) as count from user where username = '".$userName."' and status = 'A'";
		$data = $this->db->query($query);
		return $data->row();
	}

	//list police officers in given police station
	public function listPoliceOfficers($policeStation){
		$this->db->from('user');
    	$this->db->where('status != ', 'D');
    	$this->db->where('police_station', $policeStation);
    	$query = $this->db->get();
    	return $query->result();

	}

}

?>