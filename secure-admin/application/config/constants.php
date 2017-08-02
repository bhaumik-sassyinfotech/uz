<?php

defined('BASEPATH') OR exit('No direct script access allowed');
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
define('DIR_WRITE_MODE', 0755);

/*
  |--------------------------------------------------------------------------
  | File Stream Modes
  |--------------------------------------------------------------------------
  |
  | These modes are used when working with fopen()/popen()
  |
 */

define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

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
define('SHOW_DEBUG_BACKTRACE', TRUE);

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
  |       http://tldp.org/LDP/abs/html/exitcodes.html|
 */
define('EXIT_SUCCESS', 0); // no errors
define('EXIT_ERROR', 1); // generic error
define('EXIT_CONFIG', 3); // configuration error
define('EXIT_UNKNOWN_FILE', 4); // file not found
define('EXIT_UNKNOWN_CLASS', 5); // unknown class
define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
define('EXIT_USER_INPUT', 7); // invalid user input
define('EXIT_DATABASE', 8); // database error
define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

define('CURRENCY', '₦');
define('SITE_TITLE', 'UPZURGE');
define('API_SCRIPT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/upzurge/space/showads/');
define('FRONT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/upzurge/');
define('ADMIN_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/upzurge/secure-admin/');
define('ASSETS_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/upzurge/secure-admin/assets/');
define('IMAGE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/upzurge/secure-admin/assets/images/');
define('JS_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/upzurge/secure-admin/assets/js/');
define('CSS_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/upzurge/secure-admin/assets/css/');
define('UPLOAD_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/upzurge/secure-admin/assets/uploads/');
define('UPLOAD_PATH', $_SERVER['DOCUMENT_ROOT'] . '/upzurge/secure-admin/assets/uploads/');
define('UPLOAD_ON_ROOT',$_SERVER['DOCUMENT_ROOT']. '/upzurge/assets/uploads/');
define('UPLOAD_URL_ROOT', 'http://' . $_SERVER['HTTP_HOST'] . '/upzurge/assets/uploads/');

$privileges_array = array(
    'users' => array(
        'add' => 1,
        'edit' => 1,
        'delete' => 1,
        'index' => 1
    ),
	'customer' => array(
        'edit' => 1,
        'index' => 1
    ),
    'website' => array(
        'add' => 1,
        'edit' => 1,
        'delete' => 1,
        'index' => 1
    ),
    'space' => array(
        'add' => 1,
        'edit' => 1,
        'delete' => 1,
        'index' => 1
    ),
//	'sale_price' => array(
//        'add' => 1,
//        'edit' => 1,
//        'delete' => 1,
//        'index' => 1
//    ),
	'coupons' => array(
        'add' => 1,
        'edit' => 1,
        'delete' => 1,
        'index' => 1
    ),
    /*'client_testimonial' => array(
        'add' => 1,
        'edit' => 1,
        'delete' => 1,
        'index' => 1
    ),*/
    'group' => array(
        'add' => 1,
        'edit' => 1,
        'delete' => 1,
        'index' => 1
    ),
    'enquiries' => array(
        'index' => 1
    ),
    'template' => array(
        'edit' => 1,
        'index' => 1
    ),
    'cms' => array(
        'edit' => 1
    ),
    'order' => array(
        'index' => 1
    )
);
define("privileges_array", json_encode($privileges_array));

$discount_type = array(
    'percentage' => '%',
//    'rupee' => '&#x20A6;',
);
define ("discount_type", json_encode($discount_type));