<?php
/**
* Class:  Auth_model
* Author: Dinesh Rathnayake
* Date:   23/5/2021
*/
defined('BASEPATH') OR exit('No direct script access allowed');


class Auth_model extends CI_Model{
	protected $table_user_logs = "user_logs";
	protected $table_user = "user";
	public function __construct(){
		parent::__construct(); 
		$this->load->database();
	}

	//return password for the user
	public function getUserPassword($userName){
		$this->db->from('user');
    	$this->db->where('username', $userName );
    	$query = $this->db->get();
    	return $query->result();
	}

	//return user permission data
	public function getUserData($userName){
		$query = "select u.user_id, u.username, u.firstname, u.lastname,u.police_station, p.status, p.read_permission, p.write_permission, p.update_permission, p.delete_permission, p.roll_id, r.roll_name, p.module_id, m.module_name, p.status, p.approve_permission, p.assign_permission
		    from user u RIGHT JOIN user_permission p ON u.rollid = p.roll_id 
			INNER JOIN user_roll r on p.roll_id = r.roll_id
			INNER JOIN module m on m.module_id = p.module_id			
			where u.username = '".$userName."'";

		$data = $this->db->query($query);
		return $data->result();
	}

	//check session exists
	public function is_session_exist($userid="")
	{
		$this->db->where('username', $userid);
		$this->db->where('status', 'A');

		$query = $this->db->get($this->table_user_logs);

        if($query->num_rows() > 0) {
        return true;
        } else {
        return false;
        }
	}

	//Update user login details to the database
	public function update_user_logs($state='')
	{
		if ($state==="in") {
			$data = array(
	        'username' 		    => $_SESSION['user_name'],
	        'log_in_date' 		=> $_SESSION['logged_in_on'],
	        'log_in_time' 		=> $_SESSION['logged_in_at'],
	        'reset_status' 		=> "N",
	        'session_id' 		=> session_id(),
	        'status' 		    => "A"
			);

			$this->db->insert($this->table_user_logs, $data);
			$this->session->set_userdata('sessionid', $this->db->insert_id()); 
		} else {
			if (isset($_SESSION['sessionid'])) {
			# update based on session id
			$now = new DateTime();
			$this->db->set('log_out_date', $now->format('Y-m-d'));
			$this->db->set('log_out_time', $now->format('H:i:s'));
			$this->db->set('status', 'D');

			$this->db->where('session_id', $_SESSION['sessionid']);	
			$this->db->update($this->table_user_logs);
		}
		}
	}

	public function reset_user_logs($user_id=0)
	{
		$now = new DateTime();
		$this->db->set('log_out_date', $now->format('Y-m-d'));
		$this->db->set('log_out_time', $now->format('H:i:s'));
		$this->db->set('reset_status', 'Y');
		$this->db->set('status', 'D');

		$this->db->where('status', 'A');	
		$this->db->where('username', $user_id);	
		$this->db->update($this->table_user_logs);
	}

	//get User Status
	public function getUserStatus($userName){
		$query = "select status  from user where username = '".$userName."'";
		$data = $this->db->query($query);
		return $data->result();
	}

	//get email verified
	public function checkMailVerified($userName){
		$query = "select emailVerified from user where username = '".$userName."'";
		$data = $this->db->query($query);
		return $data->result();
	}

	//update user password
	public function updatePassword($userName,$password){
		$this->db->set('password', $password);
		$this->db->where('username', $userName);
		$this->db->update($this->table_user);
		return $this->db->affected_rows();

	}

	//function to get dashboard counts
	public function getCounts($rollId,$user_id,$userName,$police_station){
		$pendingCount = 0;
        $completeCount = 0;
        $pendingUsers = 0;
        $courtCount = 0;
        $workingCount = 0;

        $query1 = "";
        $query2 = "";
        $query3 = "";
        $query4 = "";
        $query5 = "";

        if($rollId == 1){
            //$query1 = "select count(*) as cont from criminal_case where action = 'P' ";
            $query1 = "select count(*) as cont from criminal_case where assign_police = 0 ";
            $query2 = "select count(*) as cont from criminal_case where action = 'R' ";
            $query3 = "select count(*) as cont from user where status = 'P'";
            $query4 = "select count(*) as cont from criminal_case where action = 'C' ";
            $query5 = "select count(*) as cont from criminal_case where action = 'I' ";
        }elseif($rollId == 2) {
        	
        	//$query1 = "select count(*) as cont from criminal_case where action = 'P' and (assign_police = ".$police_station." OR near_police = ".$police_station.")";
        	$query1 = "select count(*) as cont from criminal_case where assign_officer = 0 and (assign_police = ".$police_station." OR near_police = ".$police_station.")";
            $query2 = "select count(*) as cont from criminal_case where action = 'R' and assign_police = ".$police_station."";
             $query4 = "select count(*) as cont from criminal_case where action = 'C' and assign_police = ".$police_station."";
             $query5 = "select count(*) as cont from criminal_case where action = 'I' and assign_police = ".$police_station."";
        }elseif($rollId == 3){
            $query1 = "select count(*) as cont from criminal_case where action = 'P' and assign_officer = ".$user_id."";
            $query2 = "select count(*) as cont from criminal_case where action = 'R' and assign_officer = ".$user_id."";
            $query4 = "select count(*) as cont from criminal_case where action = 'C' and assign_officer = ".$user_id."";
            $query5 = "select count(*) as cont from criminal_case where action = 'I' and assign_officer = ".$user_id."";
        }elseif ($rollId == 4) {
             $query1 = "select count(*) as cont from criminal_case where action = 'P' and 
             enter_user = '".strtoupper($userName)."'";
             $query2 = "select count(*) as cont from criminal_case where action = 'R' and 
             enter_user = '".strtoupper($userName)."'";
             $query4 = "select count(*) as cont from criminal_case where action = 'C' and 
             enter_user = '".strtoupper($userName)."'";
             $query5 = "select count(*) as cont from criminal_case where action = 'I' and 
             enter_user = '".strtoupper($userName)."'";


        }
        //get pending count
        $data = $this->db->query($query1);
        $result = $data->result();
        foreach ($result as $row)
        {
            $pendingCount =  $row->cont;
        }

        //get resolved count
        $data2 = $this->db->query($query2);
        $result2 = $data2->result();
        foreach ($result2 as $row)
        {
            $completeCount =  $row->cont;
        }

        //get pending users count
        if($query3 == ""){
        	$pendingUsers = 0;
        }else{
        	//get pending count
	        $data3 = $this->db->query($query3);
	        $result3 = $data3->result();
	        foreach ($result3 as $row)
	        {
	            $pendingUsers =  $row->cont;
	        }
        }

        //get court complains
        $data4 = $this->db->query($query4);
        $result4 = $data4->result();
        foreach ($result4 as $row)
        {
            $courtCount =  $row->cont;
        }

        //get working complains
        $data5 = $this->db->query($query5);
        $result5 = $data5->result();
        foreach ($result5 as $row)
        {
            $workingCount =  $row->cont;
        }

        $allCounts = array("pendingCount"=>$pendingCount, "completeCount"=>$completeCount,
        	"pendingUsers"=>$pendingUsers, "courtCount" => $courtCount, 
        	"workingCount" => $workingCount);

        echo json_encode($allCounts);
        return json_encode($allCounts);
	}

	//Save OTP to the database
	public function saveRandomNumber($userName,$otp){
		$updateData = array(
	        'otp' 	=> $otp
			);
		$this->db->where("username",$userName);
		$this->db->update("user",$updateData);
	}

	//get saved phone number from database
    public function getPhoneNumber($userName){
        $query = "select phone from user where username = '".$userName."'";
		$data = $this->db->query($query);
		return $data->result();
    }
}

?>
