<?php
/**
* Class:  Police_Model
* Author: Dinesh Rathnayake
* Date:   28/08/2021
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Police_model extends CI_Model{

public function __construct(){
		parent::__construct(); 
		$this->load->database(); 
}

//get districts
public function getDistricts(){	
		$query=$this->db->get("district");
	    return $query->result(); 
}

//get police OIC who are not assign to the police station
public function getPoliceOIC(){
		$this->db->from('user');
    	$this->db->where('rollid',2 );
    	$this->db->where('police_station',0 );
    	$query = $this->db->get();
    	return $query->result();
}
//Get Police OIC for Modify
public function getPoliceOICModify(){
		$query = "select u.user_id as user_id, u.firstname as firstname, u.lastname as 	lastname,
		p.id as policeId, p.name as policeName from police_station p left join user u
		on p.id = u.police_station where u.rollid = 2";

		$data = $this->db->query($query);
		return $data->result();
		//$this->db->from('user');
    	//$this->db->where('rollid',2 );
    	//$query = $this->db->get();
    	//return $query->result();
}

//Save police Station Details
public function savePolice($data){
		$this->db->insert('police_station',$data);
	    $insertRec = $this->db->insert_id();

	    //update User Table
	    $updateData = array(
		        'police_station' => $insertRec
				);
		$this->db->where("user_id",$data['oic']);
		$this->db->update("user",$updateData);

		
		//check Alreay Assign OIC assigned to this police stattion

		//Get Previous police station oic 
		$query2 = "select oic from police_station where id = ".$insertRec."";
		$result2 = $this->db->query($query2);
		foreach ($result2->result_array() as $row)
		{
	        $oicOld =  $row['oic'];
		}

		//get previous ly assign police station
		$idPolice = 0;
		$query = "select id as police from police_station where oic = ".$oicOld."";
		$result = $this->db->query($query);
		foreach ($result->result_array() as $row)
		{
			if($row['police'] != $insertRec){
	        	$idPolice =  $row['police'];
	    	}
		}

		//check police oic modified
		if($idPolice != 0){
		if($idPolice != $insertRec){
			if($idPolice !=  0){
				//set 0 to already assign OIC
				$updateData2 = array(
			    'oic' 	=> 0
				);
				$this->db->where("id",$idPolice);
				$this->db->update("police_station",$updateData2);

				$updateData3 = array(
			    'police_station' 	=> 0
				);
				$this->db->where('user_id',$oicOld);
				$this->db->update("user",$updateData3);

			}
			
			}
			}
			
			$updateData4 = array(
		    'police_station' 	=> $insertRec
			);
			$this->db->where('user_id',$data['oic']);
			$this->db->update("user",$updateData4);

		
		return $insertRec;
	}

	//Check email address already exists
	public function checkEmailExists($eMail){
		$query = "select count(*) as count from police_station where email = '".$eMail."' and status != 'D'";
		$data = $this->db->query($query);
		return $data->result();

	}

	//Check phone number already exists
	public function checkMobileExists($phone){
		$query = "select count(*) as count from police_station where phone = '".$phone."' and status != 'D'";
		$data = $this->db->query($query);
		return $data->result();
	}

	//Load police station details for modify
	public function loadDataForModify(){

		$userName = trim($_SESSION['user_name']);
		if("ADMIN" == strtoupper($userName)){
			$query = "select p.id as id, p.name as name, p.address as address, p.phone as phone, p.email as email, d.name as district, u. firstname as name1, u. lastname as name2 
			    from police_station p inner join district d 
    	    	on p.district = d.id left join user u on p.oic = u.user_id 
    	    	where p.status != 'D'";
		}else{
			$query = "";
		}
		$data = $this->db->query($query);
		return $data->result();
	}

	//Load police station details according to id
	public function loadDataForUpdate($id){
		$this->db->from('police_station');
    	$this->db->where('id', $id );
    	$query = $this->db->get();
    	return $query->result();
	}

	//update Record
	public function updatePolice($data){
		
		//Get already assined police station Id
		/////////////////////////////////
		$query = "select id as police from police_station where oic = ".$data['oic']."";
		$result = $this->db->query($query);
		foreach ($result->result_array() as $row)
		{
			if($row['police'] != $data['id']){
	        	$idPolice =  $row['police'];
	    	}
		}
		/////////////////////////////////
		//Get Previous police station oic 
		$query2 = "select oic from police_station where id = ".$data['id']."";
		$result2 = $this->db->query($query2);
		foreach ($result2->result_array() as $row)
		{
	        $oicOld =  $row['oic'];
		}

		///////////////////////////////////

			/*echo "New Police >>>>  " .$data['id'];
			echo "new Oic >>>> " .$data['oic'];
			echo "old police >>>> " .$idPolice;
			echo "oicOld >>>> ".$oicOld;
			die;*/

		$updateData = array(
	        'name' 	   		=> $data['name'],
	        'address' 		=> $data['address'],
	        'district'      => $data['district'],
	        'phone' 		=> $data['phone'],
	        'email' 		=> $data['email'],
	        'oic'			=> $data['oic']
			);
		$this->db->where("id",$data['id']);
		$this->db->update("police_station",$updateData);

			

		//check oic is changed
		if($idPolice != $data['id']){
			if($idPolice !=  0){
				//set 0 to already assign OIC
				$updateData2 = array(
			    'oic' 	=> 0
				);
				$this->db->where("id",$idPolice);
				$this->db->update("police_station",$updateData2);

				$updateData3 = array(
			    'police_station' 	=> 0
				);
				$this->db->where('user_id',$oicOld);
				$this->db->update("user",$updateData3);

			}
			

			$updateData4 = array(
		    'police_station' 	=> $data['id']
			);
			$this->db->where('user_id',$data['oic']);
			$this->db->update("user",$updateData4);

		}
		
		return $this->db->affected_rows();
	}

	//Delete Plice Station Details
	public function deleteData($data){
			$updateData = array(
	        'status' 		    => "D",
	        'delete_date' 		=> $data['delete_date'],
	        'delete_time' 		=> $data['delete_time']
			);
		$this->db->where("id",$data['id']);
		$this->db->update("police_station",$updateData);
	}

}
?>