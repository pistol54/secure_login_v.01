<?php 
/*************** PHP LOGIN SCRIPT V 2.3*********************
(c) Balakrishnan 2009. All Rights Reserved

Usage: This script can be used FREE of charge for any commercial or personal projects. Enjoy!

Limitations:
- This script cannot be sold.
- This script should have copyright notice intact. Dont remove it please...
- This script may not be provided for download except from its original site.

For further usage, please contact me.

***********************************************************/
require_once ('dbc.php');
require_once 'get_data.php';
include_once ("crypt.php");
$err = array();

foreach($_GET as $key => $value) {
	$get[$key] = filter($link, $value); //get variables are filtered.
}

if (isset($_POST['doLogin'])) {
	if ($_POST['doLogin'] == 'Login')
{

foreach($_POST as $key => $value) {
	$data[$key] = filter($link, $value); // post variables are filtered
}
}

$user_email = $data['usr_email'];
$pass = $data['pwd'];


if (strpos($user_email,'@') === false) {
    $user_cond = "user_name='$user_email'";
} else {
      $user_cond = "user_email='$user_email'";
    
}

$query_statement =  "SELECT `id`,`pwd`,`full_name`,`approved`,`user_level` FROM users WHERE $user_cond AND `banned` = '0'";

list($id,$pwd,$full_name,$approved,$user_level,$num) = query_login_data($query_statement);	

//$id = $list(0);
//$pwd = $list(1);
//$full_name = $list(2);
//$approved = $list(3);
//$user_level = $list(4);
//$num = $list(5);

//$result = mysqli_query($link, "SELECT `id`,`pwd`,`full_name`,`approved`,`user_level` FROM users WHERE 
//           $user_cond
//			AND `banned` = '0'
//			") or die (mysql_error()); 
//$num = mysqli_num_rows($result);

  // Match row found with more than 1 results  - the user is authenticated. 
    if ( $num > 0 ) { 
	
//	list($id,$pwd,$full_name,$approved,$user_level) = mysqli_fetch_row($result);
	
	if(!$approved) {
	//$msg = urlencode("Account not activated. Please check your email for activation code");
	$err[] = "Account not activated. Please check your email for activation code";
	
	//header("Location: login.php?msg=$msg");
	 //exit();
	 }
	 
		//check against salt
	if ($pwd === PwdHash($pass,substr($pwd,0,9))) { 
	if(empty($err)){			

     // this sets session and logs user in  
//       session_start();
	   session_regenerate_id (true); //prevent against session fixation attacks.
//		ob_end_flush();
	   // this sets variables in the session 
		$_SESSION['user_id']= $id;  
		$_SESSION['user_name'] = $full_name;
		$_SESSION['user_level'] = $user_level;
		$_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
//		$_SESSION['isLoggedIn'] = 1;
		$_SESSION['timeOut'] = 100;
		$logged = time();
		$_SESSION['isLoggedIn'] = true;
		$_SESSION['loggedAt']= $logged;	
		//update the timestamp and key for cookie
		$stamp = time();
		$ckey = GenKey();
//		mysqli_query($link, "update users set `ctime`='$stamp', `ckey` = '$ckey' where id='$id'") or die(mysql_error());
		$query_statement =   "update users set `ctime`='$stamp', `ckey` = '$ckey' where id='$id'";

		$result  = query_login_update_data($query_statement);	
		
		//set a cookie 
$cookie_key = 7513965;		//Code is used during encryption [not mor the 7 numbers and not 0]
$cookie_value = $_SESSION['user_id'];		//determines the value of a variable (string);
$cookie_name = "user_id";//Specifies the name (string) assigned to the Cookie;
$cookie_expire = array(
	"hour"=>1,//live one hour
	"minute"=>0,
	"second"=>0,
	"day"=>0,
	"month"=>0,
	"year"=>0);
	//while "Life" variable (integer). If this parameter is not specified, the Cookie will be "live" until the end of the session, ie until you close your browser. If the time specified, when it will occur, Cookie self-destruct.
$cookie_path = "";		//way to the Cookie (string);
$cookie_domain = "";	//domain (string). The value is set the host name from which Cookie has been set;
$cookie_secure = 0;		//Cookie transmission over a secure HTTPS-connection. [ 0 or 1 ]
		
	   if(isset($_POST['remember'])){
			$a=new cookie;
			$a->params($cookie_key,$cookie_name,$cookie_value,$cookie_expire,$cookie_path,$cookie_domain,$cookie_secure);
			if($a->cookie_encrypt()){
				if($_COOKIE[$cookie_name]){
					echo "<h1>".$cookie_name." -> this cookie already exists and has been updated"."</h1><br /><br />";
				}
			}
//				  setcookie("user_id", $_SESSION['user_id'], time()+60*60, "/");
		//set a cookie 
			$cookie_key = 7513965;		//Code is used during encryption [not mor the 7 numbers and not 0]
			$cookie_value = sha1($ckey);		//determines the value of a variable (string);
			$cookie_name = "user_key";//Specifies the name (string) assigned to the Cookie;
			$cookie_expire = array(
				"hour"=>1,//live one hour
				"minute"=>0,
				"second"=>0,
				"day"=>0,
				"month"=>0,
				"year"=>0);
				//while "Life" variable (integer). If this parameter is not specified, the Cookie will be "live" until the end of the session, 
				//ie until you close your browser. If the time specified, when it will occur, Cookie self-destruct.
			$cookie_path = "";		//way to the Cookie (string);
			$cookie_domain = "";	//domain (string). The value is set the host name from which Cookie has been set;
			$cookie_secure = 0;		//Cookie transmission over a secure HTTPS-connection. [ 0 or 1 ]
			$b=new cookie;
			$b->params($cookie_key,$cookie_name,$cookie_value,$cookie_expire,$cookie_path,$cookie_domain,$cookie_secure);
			if($b->cookie_encrypt()){
				if($_COOKIE[$cookie_name]){
					echo "<h1>".$cookie_name." -> this cookie already exists and has been updated"."</h1><br /><br />";
				}
			}
		//set a cookie 
			$cookie_key = 7513965;		//Code is used during encryption [not mor the 7 numbers and not 0]
			$cookie_value = $_SESSION['user_name'];		//determines the value of a variable (string);
			$cookie_name = "user_name";//Specifies the name (string) assigned to the Cookie;
			$cookie_expire = array(
				"hour"=>1,//live one hour
				"minute"=>0,
				"second"=>0,
				"day"=>0,
				"month"=>0,
				"year"=>0);
				//while "Life" variable (integer). If this parameter is not specified, the Cookie will be "live" until the end of the session, 
				//ie until you close your browser. If the time specified, when it will occur, Cookie self-destruct.
			$cookie_path = "";		//way to the Cookie (string);
			$cookie_domain = "";	//domain (string). The value is set the host name from which Cookie has been set;
			$cookie_secure = 0;		//Cookie transmission over a secure HTTPS-connection. [ 0 or 1 ]
			$c=new cookie;
			$c->params($cookie_key,$cookie_name,$cookie_value,$cookie_expire,$cookie_path,$cookie_domain,$cookie_secure);
			if($c->cookie_encrypt()){
				if($_COOKIE[$cookie_name]){
					echo "<h1>".$cookie_name." -> this cookie already exists and has been updated"."</h1><br /><br />";
				}
			}

//				  setcookie("user_key", sha1($ckey), time()+60*60, "/");
//				  setcookie("user_name",$_SESSION['user_name'], time()+60*60, "/");
				   }
		header("Location: ../index.php");
/*		  header("Location: ../common/myaccount.php");
*/		 }
		}
		else
		{
		//$msg = urlencode("Invalid Login. Please try again with correct user email and password. ");
		$err[] = "Invalid Login. Please try again with correct user email and password.";
		//header("Location: login.php?msg=$msg");
		}
	} else {
		$err[] = "Error - Invalid login. No such user exists";
	  }		
}
					 
					 

?>