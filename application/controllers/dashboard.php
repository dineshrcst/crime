<?php
/**
* Class:  Dashboard Controller 
* Author: Dinesh Rathnayake
* Date:   23/05/2021
*/
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'controllers/'.'Base.php');
class Dashboard extends Base{
	
	public function __construct() {
        parent::__construct();

    }

	public function index(){
		$data['title'] = 'Dashboard';   
        $data['permissions'] = Auth::get_session_permissions(); 
    	$data['body'] = $this->load->view('app/dashboard/app', $data, true);
    	/*print_r('<pre>');
    	print_r($data);
		print_r('</pre>');
		die;*/
    	$this->load->view('layouts/layout_page', $data); 
	}
}
?>