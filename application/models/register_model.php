<?php
/**
* Class:  Register_model
* Author: Dinesh Rathnayake
* Date:   4/6/2021
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_model extends CI_Model{

	public function __construct(){
		parent::__construct(); 
		$this->load->database();
	}

	//Return User Types
	public function getUserTypes(){
		$this->db->from('user_roll');
    	$this->db->where('roll_name != ', 'Administrator');
    	$query = $this->db->get();
    	return $query->result();
	}

	//Check user already exists
	public function checkUserExists($userName){
		$query = "select count(*) as count from user where username = '".$userName."' and status != 'D'";
		$data = $this->db->query($query);
		return $data->row();
	}

	//Save Registration Details to the Database
	public function saverecords($data){
		return $this->db->insert('user',$data);
	}

	//Save Registration Details to the Database
	public function verifyEmail($userName){
		//$query = "update user set status = 'A' where username = '".$userName."'";
		$query = "update user set emailVerified = 'Y' where username = '".$userName."'";
        return $this->db->query($query);
	}

	//Check email address already exists
	public function checkEmailExists($eMail){
		$query = "select count(*) as count from user where email = '".$eMail."' and status != 'D'";
		$data = $this->db->query($query);
		return $data->result();

	}

	//Check phone number already exists
	public function checkMobileExists($phone){
		$query = "select count(*) as count from user where phone = '".$phone."' and status != 'D'";
		$data = $this->db->query($query);
		return $data->result();

	}


    //get saved OTP from database
    public function getSavedOTP($userName){
        $query = "select otp from user where username = '".$userName."'";
		$data = $this->db->query($query);
		return $data->result();
    }

    //update user status
    public function updateUserStatus($username){
    	$query = "update user set status = 'A' where username = '".$username."'";
        return $this->db->query($query);
    }

}
?>