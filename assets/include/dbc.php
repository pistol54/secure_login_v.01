<?php
/*************** PHP LOGIN SCRIPT V 2.3*********************
(c) Balakrishnan 2010. All Rights Reserved

Usage: This script can be used FREE of charge for any commercial or personal projects. Enjoy!

Limitations:
- This script cannot be sold.
- This script should have copyright notice intact. Dont remove it please...
- This script may not be provided for download except from its original site.

For further usage, please contact me.

/******************** MAIN SETTINGS - PHP LOGIN SCRIPT V2.1 **********************
Please complete wherever marked xxxxxxxxx

/************* MYSQL DATABASE SETTINGS *****************
1. Specify Database name in $dbname
2. MySQL host (localhost or remotehost)
3. MySQL user name with ALL previleges assigned.
4. MySQL password

Note: If you use cpanel, the name will be like account_database
*************************************************************/
//require_once ('appvars.php');
//require_once ('connectvars.php');
//require_once ('open_file.php');
//$useresults = mysqli_query($link, $connect_table );



/*$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("Couldn't make connection.");*/
//$db = mysql_select_db(DB_NAME, $link) or die("Couldn't select database");

/* Registration Type (Automatic or Manual) 
 1 -> Automatic Registration (Users will receive activation code and they will be automatically approved after clicking activation link)
 0 -> Manual Approval (Users will not receive activation code and you will need to approve every user manually)
*/
$user_registration = 1;  // set 0 or 1

define("COOKIE_TIME_OUT", 10); //specify cookie timeout in days (default is 10 days)
define('SALT_LENGTH', 9); // salt for password

//define ("ADMIN_NAME", "admin"); // sp

/* Specify user levels */
//define ("ADMIN_LEVEL", 5);
//define ("USER_LEVEL", 1);
//define ("GUEST_LEVEL", 0);



/*************** reCAPTCHA KEYS****************/
$publickey = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
$privatekey = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";


/**** PAGE PROTECT CODE  ********************************
This code protects pages to only logged in users. If users have not logged in then it will redirect to login page.
If you want to add a new page and want to login protect, COPY this from this to END marker.
Remember this code must be placed on very top of any html or php page.
********************************************************/

function page_protect() {
//session_start();
include ('appvars.php');
include ('connectvars.php');
require_once ('open_file.php');
$useresults = mysqli_query($link, $connect_table );

global $db; 
/*$db = $link; */
/* Secure against Session Hijacking by checking user agent */
if (isset($_SESSION['HTTP_USER_AGENT']))
{
    if ($_SESSION['HTTP_USER_AGENT'] != md5($_SERVER['HTTP_USER_AGENT']))
    {
        logout();
        exit;
    }
}

// before we allow sessions, we need to check authentication key - ckey and ctime stored in database

/* If session not set, check for cookies set by Remember me */
if (!isset($_SESSION['user_id']) && !isset($_SESSION['user_name']) ) 
{
	if(isset($_COOKIE['user_id']) && isset($_COOKIE['user_key'])){
	/* we double check cookie expiry time against stored in database */
//	$a->cookie_decrypt($_COOKIE[$cookie_name],$cookie_key);
	$cookie_key = 7513965;
	$cookie_name = "user_id";
	$cookie_user_id  = filter($link, $a->cookie_decrypt($_COOKIE[$cookie_name],$cookie_key));
	
//	$cookie_user_id  = filter($link, $_COOKIE['user_id']);
	$query_statement =  "select `ckey`,`ctime` from `users` where `id` ='$cookie_user_id'";

	$rs_ctime = mysqli_query($link,$query_statement ) or die(mysql_error());
	list($ckey,$ctime) = mysqli_fetch_row($rs_ctime);
	// coookie expiry
	if( (time() - $ctime) > 60*60*24*COOKIE_TIME_OUT) {

		logout($link);
		}
/* Security check with untrusted cookies - dont trust value stored in cookie. 		
/* We also do authentication check of the `ckey` stored in cookie matches that stored in database during login*/

			$cookie_key = 7513965;
			$cookie_name = "user_id";
			$cookie_user_id  = filter($link, $a->cookie_decrypt($_COOKIE[$cookie_name],$cookie_key));
			$cookie_name = "user_name";
			$cookie_user_name = filter($link, $c->cookie_decrypt($_COOKIE[$cookie_name],$cookie_key));
			$cookie_name = "user_key";	//Specifies the name (string) assigned to the Cookie;
			$cookie_user_key = filter($link, $b->cookie_decrypt($_COOKIE[$cookie_name],$cookie_key));

	 if( !empty($ckey) && is_numeric($cookie_user_id) && isUserID($cookie_user_name) && $cookie_user_key == sha1($ckey)  ) {
	 	  session_regenerate_id(); //against session fixation attacks.


		  $_SESSION['isLoggedIn'] = 1;
		  $_SESSION['user_id'] = $cookie_user_id;
		  $_SESSION['user_name'] = $cookie_user_name;
		  $query_statement =  "select user_level from users where id='$_SESSION[user_id]'";
		  
		/* query user level from database instead of storing in cookies */	
		  list($user_level) = mysql_fetch_row(mysqli_query($link,$query_statement ));

		  $_SESSION['user_level'] = $user_level;
		  $_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
		  mysqli_close($link);

	   } else {
	   logout($link);
	   }

  } else {
	header("Location: ../../login/login.php");
	exit();
	}
}
}



function filter($link, $data) {
	$data = trim(htmlentities(strip_tags($data)));
	
	if (get_magic_quotes_gpc())
		$data = stripslashes($data);
	
	$data = mysqli_real_escape_string($link, $data);
	
	return $data;
}



function EncodeURL($url)
{
$new = strtolower(ereg_replace(' ','_',$url));
return($new);
}

function DecodeURL($url)
{
$new = ucwords(ereg_replace('_',' ',$url));
return($new);
}

function ChopStr($str, $len) 
{
    if (strlen($str) < $len)
        return $str;

    $str = substr($str,0,$len);
    if ($spc_pos = strrpos($str," "))
            $str = substr($str,0,$spc_pos);

    return $str . "...";
}	

function isEmail($email){
  return preg_match('/^\S+@[\w\d.-]{2,}\.[\w]{2,6}$/iU', $email) ? TRUE : FALSE;
}

function isUserID($username)
{
	if (preg_match('/^[a-z\d_]{5,20}$/i', $username)) {
		return true;
	} else {
		return false;
	}
 }	
 
function isURL($url) 
{
	if (preg_match('/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i', $url)) {
		return true;
	} else {
		return false;
	}
} 

function checkPwd($x,$y) 
{
if(empty($x) || empty($y) ) { return false; }
if (strlen($x) < 4 || strlen($y) < 4) { return false; }

if (strcmp($x,$y) != 0) {
 return false;
 } 
return true;
}

function GenPwd($length = 7)
{
  $password = "";
  $possible = "0123456789bcdfghjkmnpqrstvwxyz"; //no vowels
  
  $i = 0; 
    
  while ($i < $length) { 

    
    $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
       
    
    if (!strstr($password, $char)) { 
      $password .= $char;
      $i++;
    }

  }

  return $password;

}

function GenKey($length = 7)
{
  $password = "";
  $possible = "0123456789abcdefghijkmnopqrstuvwxyz"; 
  
  $i = 0; 
    
  while ($i < $length) { 

    
    $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
       
    
    if (!strstr($password, $char)) { 
      $password .= $char;
      $i++;
    }

  }

  return $password;

}


function logout()
{
	require_once ('appvars.php');
	require_once ('connectvars.php');
	require_once ('open_file.php');
	$useresults = mysqli_query($link, $connect_table );

global $db;
/*$link = $db;*/
session_start();

$sess_user_id = strip_tags(mysqli_real_escape_string($link, $_SESSION['user_id']));
$cook_user_id = strip_tags(mysqli_real_escape_string($link, $_COOKIE['user_id']));

if(isset($sess_user_id) || isset($cook_user_id)) {
	$query_statement =  "update `users` 
			set `ckey`= '', `ctime`= '' 
			where `id`='$sess_user_id' OR  `id` = '$cook_user_id'";

mysqli_query($link, $query_statement) or die(mysql_error());
	mysqli_close($link);

}		

/************ Delete the sessions****************/
unset($_SESSION['user_id']);
unset($_SESSION['user_name']);
unset($_SESSION['user_level']);
unset($_SESSION['HTTP_USER_AGENT']);
session_unset();
session_destroy(); 

/* Delete the cookies*******************/
setcookie("user_id", '', time()-60*60*24*COOKIE_TIME_OUT, "/");
setcookie("user_name", '', time()-60*60*24*COOKIE_TIME_OUT, "/");
setcookie("user_key", '', time()-60*60*24*COOKIE_TIME_OUT, "/");

header("Location: ../index.php");
/*header("Location: ../../login/login.php");
*/}

// Password and salt generation
function PwdHash($pwd, $salt = null)
{
    if ($salt === null)     {
        $salt = substr(md5(uniqid(rand(), true)), 0, SALT_LENGTH);
    }
    else     {
        $salt = substr($salt, 0, SALT_LENGTH);
    }
    return $salt . sha1($pwd . $salt);
}

function checkAdmin() {

if($_SESSION['user_level'] == ADMIN_LEVEL) {
return 1;
} else { return 0 ;
}

}

?>