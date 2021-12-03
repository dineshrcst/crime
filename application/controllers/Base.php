<?php
/**
* Class:  Base Controller 
* Author: Dinesh Rathnayake
* Date:   04/06/2021
*/
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'controllers/'.'Auth.php');

class Base extends Auth {
	public function __construct() {
        parent::__construct(); 
    }

    public function get_system_name()
    {
        return $this->config->item('app_code');
    }  
    public function get_current_timestamp() 
    {
        $now = new DateTime();
        return $now->format('Y-m-d H:i:s'); 
    }

    protected function get_error_message($data)
    {
        $skelton = $this->load->view("messages/error_message", $data, true);
        return $skelton;
    }
    protected function get_success_message($data)
    {
        $skelton = $this->load->view("messages/success_message", $data, true);
        return $skelton;
    }
    protected function get_warning_message($data)
    {
        $skelton = $this->load->view("messages/warning_message", $data, true);
        return $skelton;
    }

    protected function handle_json_response($resdta, $return_json=false)
    {
        if ($return_json) {
            echo json_encode($resdta);
        } else {
            $this->show_error('internal', ER_MSG_URL_NOT_FOUND); 
        }
    }
    
    protected function show_error($error_type='404', $error_message=ER_MSG_PAGE_NOT_FOUND, $description='')
    {       
        $data['message']     = $error_message;
        $data['description'] = $description;

        if ($error_type=="permission") {
        $data['heading'] = 'Access Forbidden';
        $this->load->view('errors/html/error_permission', $data);  
        } else {
        $data['heading'] = 'Page Not Found';
        $this->load->view('errors/html/error_notfound', $data);   
        }
    }

     protected function show_warning($error_type='404', $warning_message=ER_MSG_PAGE_NOT_FOUND, $description='')
    {       
        $data['message']     = $warning_message;
        $data['description'] = $description;

        if ($error_type=="timedout") {
        $data['heading'] = 'Request Time-out';
        } else {
        $data['heading'] = '';
        }
        
        $this->load->view('errors/html/system_warning', $data);
    }


    protected function is_post()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return true;
        } else {
            return false;
        }
    }
    protected function is_get()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            return true;
        } else {
            return false;
        }
    }

    /*******************************************************************************
     * Get json post input value by key
     *
     * @return response
    *******************************************************************************/
    protected function get_json_input($token) 
    {
        $_POST = json_decode(file_get_contents('php://input'), true);        
        if (isset($_POST[$token])) {
            return $_POST[$token];
        } else {
            return null;
        }
    }

    /*******************************************************************************
     * Get post input value by key
     *
     * @return response
    *******************************************************************************/
    protected function get_input($token) 
    {
        return $this->input->post($token);
    }

    /*******************************************************************************
     * Get all post inputs values
     *
     * @return response
    *******************************************************************************/
    protected function get_all_inputs() 
    {
        return $this->input->post();
    }
    /*******************************************************************************
     * check email is valid or not
     *
     * @return boolean
    *******************************************************************************/
    protected function get_email_validator($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
          return true;
        } else {
          return false;
        }
    }

    protected function get_formatted_date ($date) 
    {
        if ($date != 0) {
            $year  = substr($date, 0, 4);
            $month = substr($date, 4, 2);
            $day   = substr($date, 6, 2);

            return $year.'-'.$month.'-'.$day;
        } else {
            return '0';
        }        
    } 
    /*******************************************************************************
     * Get timestamp for given date and time 
     *
     * @params $date(20190603), $time(10:12:30)
     * @return number (float)
    *******************************************************************************/
    protected function get_timestamp($date, $time)
    {
        $_time = trim($time);

        if ($date==0 || $_time=="") {
        return (float)0;
        }

        $_timeArray = explode(':', $_time);

        $_timeString = $_timeArray[0].$_timeArray[1].$_timeArray[2];

        $_timestamp = $date.$_timeString;

        return (float)$_timestamp;
    }

    /*******************************************************************************
     * Get boolean value as char true => "Y/N"
     *
     * @return string
    *******************************************************************************/
    protected function get_boolean_as_char ($val) 
    {
    if ($val) { return "Y"; } else { return "N"; }        
    }


}
?>