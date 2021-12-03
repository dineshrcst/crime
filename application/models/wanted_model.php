<?php
/**
* Class:  Wanted_Model
* Author: Dinesh Rathnayake
* Date:   20/09/2021
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Wanted_model extends CI_Model{

	public function __construct(){
		parent::__construct();  
		$this->load->database();
	}

    //get the maximum id in the table
	public function getMaxId(){
		$query = "select max(id) as id from most_wanted";
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

	//Save most wanted person details
	public function saveWantedData($data){
		$this->db->insert('most_wanted',$data);
        return $this->db->insert_id();
	}

//View most wanted persons for view
	public function viewWantedPersons(){
		$query = "select m.id as id, m.name as name, m.age as age, m. sex as sex, m.aliases as 	aliases, m.remarks as remarks,m.caution as caution, p.name as police_station, m.image_name as image_name, m.image_type as image_type from  most_wanted m inner join police_station p on m.police_station = p.id where m.status = 'A'";
    	$data = $this->db->query($query);
    	return $data->result();
	}

	//Load data for update and delete
	public function loadDataForModify(){
		$roll_id =  $_SESSION['roll_id']; 
        $police_station = $_SESSION['police_station'];
		if($roll_id == 1){
			$query = "select m.id as id, m.name as name, m.age as age, m. sex as sex, m.aliases as 	aliases, m.remarks as remarks,m.caution as caution, p.name as police_station, m.image_name as image_name, m.image_type as image_type from  most_wanted m inner join police_station p on m.police_station = p.id where m.status = 'A' ";
		}else{
			$query = "select m.id as id, m.name as name, m.age as age, m. sex as sex, m.aliases as 	aliases, m.remarks as remarks,m.caution as caution, p.name as police_station, m.image_name as image_name, m.image_type as image_type from  most_wanted m inner join police_station p on m.police_station = p.id where m.status = 'A' and
    	    	m.police_station = ".$police_station."";
		}
		$data = $this->db->query($query);
		return $data->result();
	}

	//load data for update according to particular id
	public function loadDataForUpdate($id){
		$this->db->from('most_wanted');
    	$this->db->where('id', $id );
    	$query = $this->db->get();
    	return $query->result();
	}

	//update record to the database
	public function updateWantedData($data){
		if($data['image_name'] == ""){
			$updateData = array(
		        'name' 		        => $data['name'],
		        'age' 			    => $data['age'],
		        'sex'               => $data['sex'],
		        'aliases' 		    => $data['aliases'],
		        'remarks' 		    => $data['remarks'],
		        'caution'           => $data['caution'],
		        'police_station'    => $data['police_station'],
		        'modify_user'       => $data['modify_user'],
		        'modify_date'		=> $data['modify_date'],
		        'modify_time'		=> $data['modify_time'],
		        'status'			=> $data['status']
			);						
		}else{
			$updateData = array(
		        'name' 		        => $data['name'],
		        'age' 			    => $data['age'],
		        'sex'               => $data['sex'],
		        'aliases' 		    => $data['aliases'],
		        'remarks' 		    => $data['remarks'],
		        'caution'           => $data['caution'],
		        'police_station'    => $data['police_station'],
		        'modify_user'       => $data['modify_user'],
		        'modify_date'		=> $data['modify_date'],
		        'modify_time'		=> $data['modify_time'],
		        'status'			=> $data['status'],
		        'image_name'	    => $data['image_name'],									
		        'image_type'        => $data['image_type']
			);

		}
		$this->db->where("id",$data['id']);
		$this->db->update("most_wanted",$updateData);
		return $this->db->affected_rows();
	}

	//delete Most Wanted Persons
	public function deleteData($data){
		$updateData = array(
	        'status' 		    => "D",
	        'delete_user' 		=> $data['delete_user'],
	        'delete_date' 		=> $data['delete_date'],
	        'delete_time' 		=> $data['delete_time']
			);
		$this->db->where("id",$data['id']);
		$this->db->update("most_wanted",$updateData);
	}
	
}