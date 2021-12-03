<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/*
|--------------------------------------------------------------------------
| Application Messages
|--------------------------------------------------------------------------
|
*/

// Login Messages
defined('ER_MSG_USER_BLOCKED')        		 	 		OR define('ER_MSG_USER_BLOCKED', 'This user account has been blocked.'); 
defined('ER_MSG_USER_DISABLED')        		 	 		OR define('ER_MSG_USER_DISABLED', 'This user account has been disabled.'); 
defined('ER_MSG_REQUIRED_FIELD')        		 		OR define('ER_MSG_REQUIRED_FIELD', 'Required.'); 
defined('ER_MSG_REQUIRED_FIELD_USERNAME')        		OR define('ER_MSG_REQUIRED_FIELD_USERNAME', 'Username is required.'); 
defined('ER_MSG_REQUIRED_FIELD_PASSWORD')        		OR define('ER_MSG_REQUIRED_FIELD_PASSWORD', 'Password is required.'); 
defined('ER_MSG_REQUIRED_FIELD_USERNAME_PASSWORD')      OR define('ER_MSG_REQUIRED_FIELD_USERNAME_PASSWORD', 'Username and password is required.');
defined('ER_MSG_INVALID_USERNAME')   		            OR define('ER_MSG_INVALID_USERNAME', 'Invalid username.');
defined('ER_MSG_INVALID_USERNAME_OR_PASSWORD')   		OR define('ER_MSG_INVALID_USERNAME_OR_PASSWORD', 'Invalid username or password'); 
defined('ER_MSG_AUTH_FAILED_IN_FIELD')   				OR define('ER_MSG_AUTH_FAILED_IN_FIELD', 'Field authentication is failed'); 
defined('ER_MSG_ACCOUNT_NOT_ACTIVATE')   		        OR define('ER_MSG_ACCOUNT_NOT_ACTIVATE', 'User Account is not activated.');
defined('ER_MSG_INVALID_PASSWORD')   		            OR define('ER_MSG_INVALID_PASSWORD', 'Invalid password.');
defined('ER_MSG_USER_NOT_EXISTS')   		            OR define('ER_MSG_USER_NOT_EXISTS', 'Username does not exists.');

//User Registration Messages
defined('ER_MSG_USER_ALREADY_EXISTS')   		        OR define('ER_MSG_USER_ALREADY_EXISTS', 'Username already exists.');
defined('ER_MSG_EMAIL_ALREADY_EXISTS')   		        OR define('ER_MSG_EMAIL_ALREADY_EXISTS', 'E-Mail address already exists.');
defined('ER_MSG_PHONE_ALREADY_EXISTS')   		        OR define('ER_MSG_PHONE_ALREADY_EXISTS', 'Phone number already exists.');

//Common Messages
defined('SC_MSG_FOR_CREATION')   				        OR define('SC_MSG_FOR_CREATION', 'has been created successfully.'); 
defined('SC_MSG_FOR_UPDATE')   				            OR define('SC_MSG_FOR_UPDATE', 'have been changed successfully.'); 
defined('SC_MSG_FOR_DELETE')   				            OR define('SC_MSG_FOR_DELETE', 'has been deleted successfully.'); 
defined('ER_MSG_FOR_SAVE_DATA')   				        OR define('ER_MSG_FOR_SAVE_DATA', 'Error in save data.'); 
defined('ER_MSG_FOR_UPDATE_DATA')   				    OR define('ER_MSG_FOR_UPDATE_DATA', 'Error in update data.'); 


defined('ER_MSG_URL_NOT_FOUND')   				        OR define('ER_MSG_URL_NOT_FOUND', 'The requested URL could not be retrieved.'); 
defined('ER_MSG_PAGE_NOT_FOUND')   				        OR define('ER_MSG_PAGE_NOT_FOUND', 'The page you requested was not found.'); 
defined('ER_MSG_FUNCTION_IS_BLOCKED')   				OR define('ER_MSG_FUNCTION_IS_BLOCKED', 'This function is blocked for your user level.'); 

//Mail Contents
defined('MAIL_HEADER')   				                OR define('MAIL_HEADER', 'Online Criminal Reprting and Management System'); 
defined('USER_ACCOUNT_APPROVE')   				        OR define('USER_ACCOUNT_APPROVE', 'Your User Account Creation Request for Online Criminal Reporting and Management System is Accepted.'); 
defined('USER_ACCOUNT_REJECT')   				        OR define('USER_ACCOUNT_REJECT', 'Your User Account Creation Request for Online Criminal Reporting and Management System is Rejected.');
defined('USER_ACCOUNT_CREATE')   				        OR define('USER_ACCOUNT_CREATE', 'Your User Account is created sucessfully.');
defined('ASSIGN_OFFICER_TO_POLICE')   				    OR define('ASSIGN_OFFICER_TO_POLICE', 'You are Assigned to Below Police Station.'); 

defined('COMPLAIN_APPROVE')   				            OR define('COMPLAIN_APPROVE', 'Your Complain with below details is approved.');  
defined('COMPLAIN_REJECT')   				            OR define('COMPLAIN_REJECT', 'Your Complain with below details is rejected.'); 
defined('COMPLAIN_START_INVESTIGATE')   				OR define('COMPLAIN_START_INVESTIGATE', 'Investigations Start on Your Complain with below details.'); 
defined('COMPLAIN_RESOLVE')   				            OR define('COMPLAIN_RESOLVE', 'Your Complain with below details is Resolved .'); 
defined('COMPLAIN_SUBMIT_COURT')   				        OR define('COMPLAIN_SUBMIT_COURT', 'Your Complain with below details is Submitted for Court Actions.'); 