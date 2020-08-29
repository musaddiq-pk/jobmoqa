<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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


define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/


/*			*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/* End of file constants.php */
/* Location: ./application/config/constants.php */



/*	User Constants*/
define('STATUS_ACTIVE',1);
define('STATUS_DEACTIVE',0);
/*	User Constants*/
define('CUST_MEMBER',1);
define('CUST_GUEST',2);
/*	Customer Business Type*/
define('SELLER_INDIVIDUAL',1);
define('SELLER_BUSINESS',2); 

/* Feature Display Type   */
define('DISPLAY_TEXT',1); 
define('DISPLAY_SELECT',2); 
define('DISPLAY_CHECK',3); 
define('DISPLAY_RADIO',4);

/* Feature Search Display Type   */
define('SEARCH_DISPLAY_CHEK',1);
define('SEARCH_DISPLAY_RANGE',2);  

//paging numbers 
define('NUM_LINKS', '5');
define('LIMIT', '10');

define('FRONT_LIMIT', '40');

define('SITE_NAME', 'JobMoqa');
define('SITE_TEAM', 'JobMoqa Team');
//Constants for AdminArea

define('BASE_URL', 'http://localhost/jobmoqa_create2/');
//define('BASE_URL', 'http://www.jobmoqa.pk/');

define('PAPER_URL',BASE_URL.'epaper/');
define('CAT_URL',BASE_URL.'industry/');

define('ADMIN_BASE_URL', BASE_URL.'admin/');
define('STATIC_URL',BASE_URL.'static/');
define('FRONT_STATIC_URL',BASE_URL.'static/front/');
define('ADMIN_STATIC_URL',BASE_URL.'static/admin/');
define('FRONT_TEMPLATE_URL','front/template/');
define('ADMIN_TEMPLATE_URL','admin/template/');

define('AD_SMALL_IMG','uploads/ad/small_img/');
define('AD_LARGE_IMG','uploads/ad/large_img/');
define('AD_SMALL_IMG_PATH',BASE_URL.'uploads/ad/small_img/');
define('AD_LARGE_IMG_PATH',BASE_URL.'uploads/ad/large_img/');
define('PAPER_IMG_PATH',BASE_URL.'uploads/newspaper/');
define('CAT_IMG_PATH',BASE_URL.'uploads/newspaper/');
define('DOC_FILE_PATH',BASE_URL.'uploads/docs/');