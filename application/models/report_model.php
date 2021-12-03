<?php
/**
* Class:  Complain_Model
* Author: Dinesh Rathnayake
* Date:   8/9/2021
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model{

	public function __construct(){
		parent::__construct(); 
		$this->load->database();
	}

	//get data for date range report
	public function viewDateRangeReport($fromDate, $toDate, $rollId, $user_id, $userName, $police_station){

		$query1 = "";
		if($rollId == 1){
            $query1 = "select c1.id as id, c1.date as date, c1.time as time, c1.address as address, c1. description as description, c2.name as type, c1.action as status , p.name as police_station, u.firstname as fName, u.lastname as lName from criminal_case c1 inner join crime c2 on c1.type = c2.id left join police_station p on p.id = c1.assign_police 
                left join user u on u.user_id = c1.assign_officer where enter_date between '".$fromDate."' and '".$toDate."'"; 

        }elseif($rollId == 2) {
            $query1 = "select c1.id as id, c1.date as date, c1.time as time, c1.address as address, c1. description as description, c2.name as type, c1.action as status , p.name as police_station, u.firstname as fName, u.lastname as lName from criminal_case c1 inner join crime c2 on c1.type = c2.id left join police_station p on p.id = c1.assign_police 
                left join user u on u.user_id = c1.assign_officer where assign_police = ".$police_station." and  enter_date between '".$fromDate."' and '".$toDate."'"; 
        
        }elseif($rollId == 3){
            $query1 = "select c1.id as id, c1.date as date, c1.time as time, c1.address as address, c1. description as description, c2.name as type, c1.action as status , p.name as police_station, u.firstname as fName, u.lastname as lName from criminal_case c1 inner join crime c2 on c1.type = c2.id left join police_station p on p.id = c1.assign_police 
                left join user u on u.user_id = c1.assign_officer where assign_officer = ".$user_id." and enter_date between '".$fromDate."' and '".$toDate."'";
        }elseif ($rollId == 4) {
             $query1 = "select c1.id as id, c1.date as date, c1.time as time, c1.address as address, c1. description as description, c2.name as type, c1.action as status , p.name as police_station, u.firstname as fName, u.lastname as lName from criminal_case c1 inner join crime c2 on c1.type = c2.id left join police_station p on p.id = c1.assign_police left join user u on u.user_id = c1.assign_officer where assign_officer = ".$user_name." and enter_date between '".$fromDate."' and '".$toDate."'";
        }

        $data = $this->db->query($query1);
		return $data->result();
	}

    //get data for complain type report
    public function viewTypeReport($type, $rollId, $user_id, $userName, $police_station){

        $query1 = "";
        if($rollId == 1){
            $query1 = "select c1.id as id, c1.date as date, c1.time as time, c1.address as address, c1. description as description, c2.name as type, c1.action as status , p.name as police_station, u.firstname as fName, u.lastname as lName from criminal_case c1 inner join crime c2 on c1.type = c2.id left join police_station p on p.id = c1.assign_police 
                left join user u on u.user_id = c1.assign_officer where type = ".$type.""; 

        }elseif($rollId == 2) {
            $query1 = "select c1.id as id, c1.date as date, c1.time as time, c1.address as address, c1. description as description, c2.name as type, c1.action as status , p.name as police_station, u.firstname as fName, u.lastname as lName from criminal_case c1 inner join crime c2 on c1.type = c2.id left join police_station p on p.id = c1.assign_police 
                left join user u on u.user_id = c1.assign_officer where assign_police = ".$police_station." and  type = ".$type.""; 
        
        }elseif($rollId == 3){
            $query1 = "select c1.id as id, c1.date as date, c1.time as time, c1.address as address, c1. description as description, c2.name as type, c1.action as status , p.name as police_station, u.firstname as fName, u.lastname as lName from criminal_case c1 inner join crime c2 on c1.type = c2.id left join police_station p on p.id = c1.assign_police 
                left join user u on u.user_id = c1.assign_officer where assign_officer = ".$user_id." and type = ".$type.""; 
        }elseif ($rollId == 4) {
             $query1 = "select c1.id as id, c1.date as date, c1.time as time, c1.address as address, c1. description as description, c2.name as type, c1.action as status , p.name as police_station, u.firstname as fName, u.lastname as lName from criminal_case c1 inner join crime c2 on c1.type = c2.id left join police_station p on p.id = c1.assign_police left join user u on u.user_id = c1.assign_officer where assign_officer = ".$user_name." and type = ".$type."";
        }

        $data = $this->db->query($query1);
        return $data->result();
    }

    //criminal status report
    public function viewStatusReport($crimeStatus, $rollId, $user_id, $userName, $police_station){
         $query1 = "";
        if($rollId == 1){
            $query1 = "select c1.id as id, c1.date as date, c1.time as time, c1.address as address, c1. description as description, c2.name as type, c1.action as status , p.name as police_station, u.firstname as fName, u.lastname as lName from criminal_case c1 inner join crime c2 on c1.type = c2.id left join police_station p on p.id = c1.assign_police 
                left join user u on u.user_id = c1.assign_officer where action = '".$crimeStatus."'"; 

        }elseif($rollId == 2) {
            $query1 = "select c1.id as id, c1.date as date, c1.time as time, c1.address as address, c1. description as description, c2.name as type, c1.action as status , p.name as police_station, u.firstname as fName, u.lastname as lName from criminal_case c1 inner join crime c2 on c1.type = c2.id left join police_station p on p.id = c1.assign_police 
                left join user u on u.user_id = c1.assign_officer where assign_police = ".$police_station." and action = '".$crimeStatus."'";
        
        }elseif($rollId == 3){
            $query1 = "select c1.id as id, c1.date as date, c1.time as time, c1.address as address, c1. description as description, c2.name as type, c1.action as status , p.name as police_station, u.firstname as fName, u.lastname as lName from criminal_case c1 inner join crime c2 on c1.type = c2.id left join police_station p on p.id = c1.assign_police 
                left join user u on u.user_id = c1.assign_officer where assign_officer = ".$user_id." and action = '".$crimeStatus."'"; 
        }elseif ($rollId == 4) {
             $query1 = "select c1.id as id, c1.date as date, c1.time as time, c1.address as address, c1. description as description, c2.name as type, c1.action as status , p.name as police_station, u.firstname as fName, u.lastname as lName from criminal_case c1 inner join crime c2 on c1.type = c2.id left join police_station p on p.id = c1.assign_police left join user u on u.user_id = c1.assign_officer where assign_officer = ".$user_name." and action = '".$crimeStatus."'";
        }

        $data = $this->db->query($query1);
        return $data->result();
    }

    //display police stations
    public function viewPoliceReport($rollId, $userName, $policeStation){
        $query1 = "";
        if($rollId == 1){
            $query1 = "select c1.id as id, c1.date as date, c1.time as time, c1.address as address, c1. description as description, c2.name as type, c1.action as status , p.name as police_station, u.firstname as fName, u.lastname as lName from criminal_case c1 inner join crime c2 on c1.type = c2.id left join police_station p on p.id = c1.assign_police 
                left join user u on u.user_id = c1.assign_officer where c1.assign_police = '".$policeStation."'"; 
        }else{
             $query1 = "";
        }
        $data = $this->db->query($query1);
        return $data->result();
    }

    //Load list of police stations for administrator
    public function listPoliceStations(){
        $this->db->from('police_station');
        $this->db->where('status != ', 'D');
        $query = $this->db->get();
        return $query->result();

    }

    //Get details about police officer
    public function viewOfficerDetails($policeOfficer){

      $userName = '';
      $firstName = '';
      $lastName = '';
      $email = '';
      $phoneNo = 0;
      $status = '';
      $assignCount = 0;
      $resolveCount = 0;

      $query = "select user_id as id, username as username, firstname as fName, lastname as lName, email as email, phone as phone,  status as status from user where user_id = ".$policeOfficer."";

      $data = $this->db->query($query);
      $result = $data->result();
        foreach ($result as $row)
        {
            $userName =  $row->username;
            $firstName = $row->fName;
            $lastName = $row->lName;
            $email = $row->email;
            $status = $row->status;
            $phoneNo = $row->phone;
        }

     $query1 = "select count(*) as count from criminal_case where assign_officer = ".$policeOfficer."";
      $data1 = $this->db->query($query1);
      $result1 = $data1->result();
        foreach ($result1 as $row)
        {
            $assignCount =  $row->count;
        }


     $query2 = "select count(*) as count from criminal_case where assign_officer = ".$policeOfficer." and action = 'R'";
      $data1 = $this->db->query($query2);
      $result1 = $data1->result();
        foreach ($result1 as $row)
        {
            $resolveCount =  $row->count;
        }

    $offierDate = array("userName"=>$userName, "firstName"=>$firstName,"lastName"=>$lastName, "email" => $email, "phoneNo"=>$phoneNo,"status" => $status,"assignCount" => $assignCount,"resolveCount" => $resolveCount);

    return $offierDate;
    }

    //get the police officer complain details
    public function listPoliceOfficerComplains($policeOfficer){
        $query = "select c1.id as id, c1.date as date, c1.time as time, c1.address as address, c1. description as description, c2.name as type, c1.action as status , p.name as police_station, u.firstname as fName, u.lastname as lName, u.username as username, 
            DATEDIFF(accept_date, assign_date) as accDays,   DATEDIFF(resolve_date, assign_date) as resDays from criminal_case c1 inner join crime c2 on c1.type = c2.id left join police_station p on p.id = c1.assign_police 
            left join user u on u.user_id = c1.assign_officer where assign_officer = ".$policeOfficer."";

        $data = $this->db->query($query);
        return $data->result();
    }

    //get data for the delayed report
    public function viewDelayedReport($duration, $rollId, $user_id, $userName, $police_station,$currentDate){
        if($duration == 1){
        //one week delay
            $where = "action != 'R' and DATEDIFF(CURDATE(), assign_date) > 7";
        }elseif($duration == 2){
        //Two weeks delay
            $where = "action != 'R' and DATEDIFF(CURDATE(), assign_date) > 14";
        }elseif($duration == 3){
        //One month delay
            $where = "action != 'R' and DATEDIFF(CURDATE(), assign_date) > 30";
        }elseif($duration == 4){
        //Three months delay
            $where = "action != 'R' and DATEDIFF(CURDATE(), assign_date) > 90";
        }elseif($duration == 5){
        //Six months delay
            $where = "action != 'R' and DATEDIFF(CURDATE(), assign_date) > 180";
        }elseif($duration == 6){
        //One year delay
            $where = "action != 'R' and DATEDIFF(CURDATE(), assign_date) > 365";
        }


        $query1 = "";
        if($rollId == 1){
            $query1 = "select c1.id as id, c1.date as date, c1.time as time, c1.address as address, c1. description as description, c2.name as type, c1.action as status , p.name as police_station, u.firstname as fName, u.lastname as lName, c1. enter_date as   enter_date, c1.assign_date as assign_date from criminal_case c1 inner join crime c2 on c1.type = c2.id left join police_station p on p.id = c1.assign_police 
                left join user u on u.user_id = c1.assign_officer where ".$where.""; 

        }elseif($rollId == 2) {
            $query1 = "select c1.id as id, c1.date as date, c1.time as time, c1.address as address, c1. description as description, c2.name as type, c1.action as status , p.name as police_station, u.firstname as fName, u.lastname as lName, c1. enter_date as   enter_date, c1.assign_date as assign_date from criminal_case c1 inner join crime c2 on c1.type = c2.id left join police_station p on p.id = c1.assign_police 
                left join user u on u.user_id = c1.assign_officer where assign_police = ".$police_station." and ".$where.""; 
        
        }elseif($rollId == 3){
            $query1 = "select c1.id as id, c1.date as date, c1.time as time, c1.address as address, c1. description as description, c2.name as type, c1.action as status , p.name as police_station, u.firstname as fName, u.lastname as lName, c1. enter_date as   enter_date, c1.assign_date as assign_date from criminal_case c1 inner join crime c2 on c1.type = c2.id left join police_station p on p.id = c1.assign_police 
                left join user u on u.user_id = c1.assign_officer where assign_officer = ".$user_id." and ".$where.""; 
        }elseif ($rollId == 4) {
             $query1 = "select c1.id as id, c1.date as date, c1.time as time, c1.address as address, c1. description as description, c2.name as type, c1.action as status , p.name as police_station, u.firstname as fName, u.lastname as lName, c1. enter_date as   enter_date, c1.assign_date as assign_date from criminal_case c1 inner join crime c2 on c1.type = c2.id left join police_station p on p.id = c1.assign_police left join user u on u.user_id = c1.assign_officer where assign_officer = ".$user_name." and = ".$where."";
        }

        $data = $this->db->query($query1);
        return $data->result();
    }
}


?>