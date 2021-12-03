<?php
/**
* Class:  Missing_Model
* Author: Dinesh Rathnayake
* Date:   12/09/2021
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Missing_model extends CI_Model{

	public function __construct(){
		parent::__construct();  
		$this->load->database();
	}

    //get the maximum id in the table
	public function getMaxId(){
		$query = "select max(id) as id from missing_person";
		$data = $this->db->query($query);
		$result = $data->result();
		$maxid = 0;
        foreach ($result as $row)
        {
            $maxid =  $row->id;
        }
        if(is_null($maxid)){
        	$maxid = 0;
        }
        return $maxid; 
	}

	//Save missing person details
	public function saveMissingData($data){
		$this->db->insert('missing_person',$data);
        return $this->db->insert_id();
	}

	//View missing person details
	public function vieWPendingPersons(){
		$query = "select m.id as id, m.name as name, m.address as address, m. description as description, m.missing_from as missing_from, m.contact as phone, p.name as police_station, m.image_name as image_name, m.image_type as image_type from  missing_person m inner join police_station p on m.police_station = p.id where m.status = 'P' OR m.status = 'M'";
    	$data = $this->db->query($query);
    	return $data->result();
	}

	//reject missing person details
	public function rejectData($data){
			$updateData = array(
	        'status' 		    => "R",
	        'reject_date' 		=> $data['reject_date'],
	        'reject_time' 		=> $data['reject_time'],
	        'reject_reason'     => $data['message']
			);
		$this->db->where("id",$data['id']);
		$this->db->update("missing_person",$updateData);
	}
//Approne Missing Person details
public function approveData($data){
		$updateData = array(
	        'status' 		    => "A",
	        'approve_date' 		=> $data['approve_date'],
	        'approve_time' 		=> $data['approve_time']
			);
		$this->db->where("id",$data['id']);
		$this->db->update("missing_person",$updateData);
	}

//View missing persons for view
	public function viewMissingPersons(){
		$query = "select m.id as id, m.name as name, m.address as address, m. description as description, m.missing_from as missing_from, m.contact as phone, p.name as police_station, m.image_name as image_name, m.image_type as image_type from  missing_person m inner join police_station p on m.police_station = p.id where m.status = 'A'";
    	$data = $this->db->query($query);
    	return $data->result();
	}

	//Load data for update and delete
	public function loadDataForModify(){
		$userName = trim($_SESSION['user_name']);

		if("ADMIN" == strtoupper($userName)){
			$query = "select m.id as id, m.name as name, m.address as address, m. description as description, m.missing_from as missing_from, m.contact as phone, p.name as police_station, m.image_name as image_name, m.image_type as image_type from  missing_person m inner join police_station p on m.police_station = p.id";
		}else{
			$query = "select m.id as id, m.name as name, m.address as address, m. description as description, m.missing_from as missing_from, m.contact as phone, p.name as police_station, m.image_name as image_name, m.image_type as image_type from  missing_person m inner join police_station p on m.police_station = p.id where
			   (m.status = 'P' OR m.status = 'R' OR m.status = 'M') and 
    	    	m.enter_user = '".$userName."'";
		}
		$data = $this->db->query($query);
		return $data->result();
	}

	//load data for update according to particular id
	public function loadDataForUpdate($id){
		$this->db->from('missing_person');
    	$this->db->where('id', $id );
    	$query = $this->db->get();
    	return $query->result();
	}

	//update record to the database
	public function updateMissingData($data){
		if($data['image_name'] == ""){
			$updateData = array(
		        'name' 		        => $data['name'],
		        'address' 			=> $data['address'],
		        'description'       => $data['description'],
		        'missing_from' 		=> $data['missing_from'],
		        'contact' 		    => $data['contact'],
		        'police_station'    => $data['police_station'],
		        'status'            => $data['status'],
		        'modify_user'       => $data['modify_user'],
		        'modify_date'		=> $data['modify_date'],
		        'modify_time'		=> $data['modify_time'],
		        'status'			=> $data['status']
			);						
		}else{
			$updateData = array(
		        'name' 		        => $data['name'],
		        'address' 			=> $data['address'],
		        'description'       => $data['description'],
		        'missing_from' 		=> $data['missing_from'],
		        'contact' 		    => $data['contact'],
		        'police_station'    => $data['police_station'],
		        'image_name'	    => $data['image_name'],									
		        'image_type'        => $data['image_type'],
		        'status'            => $data['status'],
		        'modify_user'       => $data['modify_user'],
		        'modify_date'		=> $data['modify_date'],
		        'modify_time'		=> $data['modify_time'],
		        'status'			=> $data['status']
			);

		}
		$this->db->where("id",$data['id']);
		$this->db->update("missing_person",$updateData);
		return $this->db->affected_rows();
	}

	//delete Missing Persons
	public function deleteData($data){
		$updateData = array(
	        'status' 		    => "D",
	        'delete_user' 		=> $data['delete_user'],
	        'delete_date' 		=> $data['delete_date'],
	        'delete_time' 		=> $data['delete_time']
			);
		$this->db->where("id",$data['id']);
		$this->db->update("missing_person",$updateData);
	}
	
}