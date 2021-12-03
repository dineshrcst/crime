<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Otp_model extends CI_Model
{
	public function send_otp($phone_number, $otp) 
    {

         $user = "94718380254";
		 $password = "9434";
		 $text = urlencode("Use the code ".$otp. " to verify your number.");
		 $to = $phone_number;

		 $baseurl ="http://www.textit.biz/sendmsg";
		 $url = "$baseurl/?id=$user&pw=$password&to=$to&text=$text";

		 $ret = $this->get_web_page($url);
		 $res= explode(":",$ret);

		 if (trim($res[0])=="OK")
		 {
		 return true;
		 }
		 else
		 {
		 echo "Sent Failed - Error : ".$res[1];
		 return false;
		 }
		return true;
    }


    public function send_sms($phone_number, $msg) 
    {

         $user = "94718380254";
		 $password = "9434";
		 $text = urlencode($msg);
		 $to = $phone_number;

		 $baseurl ="http://www.textit.biz/sendmsg";
		 $url = "$baseurl/?id=$user&pw=$password&to=$to&text=$text";

		 $ret = $this->get_web_page($url);
		 $res= explode(":",$ret);

		 if (trim($res[0])=="OK")
		 {
		 return true;
		 }
		 else
		 {
		 echo "Sent Failed - Error : ".$res[1];
		 return false;
		 }
		return true;
    }


    public function get_web_page( $url )
	{
	$options = array(
	CURLOPT_RETURNTRANSFER => true, // return web page
	CURLOPT_HEADER => false, // don't return headers
	);

	$ch = curl_init( $url );
	curl_setopt_array( $ch, $options );
	$content = curl_exec( $ch );
	$header = curl_getinfo( $ch );
	curl_close( $ch );

	return $content;
	}





}