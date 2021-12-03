<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*APPLICATION ROUTES)*/

/*Register Routes*/

//$route['register'] = 'Register';
//$route['register/user'] = 'Register/registerUser';
$route['register/email/verification'] = 'Register/emailVerification';
$route['register/email/verification/resend'] = 'Register/emailVerificationResend';
$route['register/email/verification/auth'] = 'Register/emailVerificationAuth';
$route['register/email/verified'] = 'Register/emailVerified';


$route['register/otp/verification'] = 'Register/otpVerification';
$route['register/otp/verification/auth'] = 'Register/otpVerificationAuth';
$route['register/otp/resend'] = 'Register/otpVerificationResend';



/*Complain Routes*/
$route['complain/create/new'] = 'Complain/new_complain';
$route['complain/edit'] = 'Complain/edit_complain';
$route['complain/approve'] = 'Complain/approve_complain';
$route['complain/assign'] = 'Complain/assign_complain';
$route['complain/read'] = 'Complain/read_complain';

$route['complain/save'] = 'Complain/saveComplainData';
$route['complain/update'] = 'Complain/updateComplainData';

/*User Routes*/
$route['user/create/new'] = 'User/new_user';
$route['user/edit'] = 'User/edit_user';
$route['user/approve'] = 'User/approve_user';
$route['user/assign'] = 'User/assign_user';

/*Police Routes*/
$route['police/new'] = 'Police/new_police';
$route['police/edit'] = 'Police/edit_police';
$route['police/save'] = 'Police/savePoliceData';

/*Login Routes*/
$route['change'] = 'Auth/change_password';

/*Missing persons routes*/
$route['missing/new'] = 'Missing/new_person';
$route['missing/edit'] = 'Missing/edit_person';
$route['missing/approve'] = 'Missing/approve_person';
$route['missing/view'] = 'Missing/view_person';

/*Most Wanted Persons*/
$route['wanted/new'] = 'Wanted/new_person';
$route['wanted/edit'] = 'Wanted/edit_person';
$route['wanted/view'] = 'Wanted/view_person';

/*Non login Complain*/
$route['complain/guest/new'] = 'Complain/new_Guest_Complain';

