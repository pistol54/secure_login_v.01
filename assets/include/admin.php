<?php 
require_once ('dbc.php');
require_once ('db.php');
page_protect();

if(!checkAdmin()) {
header("Location: login/login.php");
exit();
}

$page_limit = 10; 
//include ('appvars.php');
//include ('connectvars.php');
include ('open_file.php');
$useresults = mysqli_query($link, $connect_table );


$host  = $_SERVER['HTTP_HOST'];
$host_upper = strtoupper($host);
$login_path = @ereg_replace('admin','',dirname($_SERVER['PHP_SELF']));
$path   = rtrim($login_path, '/\\');

// filter GET values
foreach($_GET as $key => $value) {
	$get[$key] = filter($link, $value);
}

foreach($_POST as $key => $value) {
	$post[$key] = filter($link, $value);
}

if (isset($post['doBan'])) {
	if($post['doBan'] == 'Ban') {

if(!empty($_POST['u'])) {
	foreach ($_POST['u'] as $uid) {
		$id = filter($link, $uid);
		$query_statement =  "update users set banned='1' where id='$id' and `user_name` <> 'pistol54'";
		mysqli_query($link,$query_statement );
			if (mysqli_errno($link) != 0) {
		showerror($link);
	die('Error querying database.');
	}
	}
 }
 $ret = $_SERVER['PHP_SELF'] . '?'.$_POST['query_str'];;
 	mysqli_close($link);

 header("Location: $ret");
 exit();
}
}

if (isset($_POST['doUnban'])) {
	if ($_POST['doUnban'] == 'Unban') {

if(!empty($_POST['u'])) {
	foreach ($_POST['u'] as $uid) {
		$id = filter($link, $uid);
		$query_statement =  "update users set banned='0' where id='$id'";
		mysqli_query($link,$query_statement );
			if (mysqli_errno($link) != 0) {
		showerror($link);
	die('Error querying database.');
	}
 }
}
 $ret = $_SERVER['PHP_SELF'] . '?'.$_POST['query_str'];;
  	mysqli_close($link);

 header("Location: $ret");
 exit();
}
}
if (isset($_POST['doDelete'])) {
	if($_POST['doDelete'] == 'Delete') {

if(!empty($_POST['u'])) {
	foreach ($_POST['u'] as $uid) {
		$id = filter($link, $uid);
		$query_statement =  "delete from users where id='$id' and `user_name` <> 'pistol54'";
		mysqli_query($link,$query_statement );
			if (mysqli_errno($link) != 0) {
		showerror($link);
	die('Error querying database.');
			}
	}
 }
}
 $ret = $_SERVER['PHP_SELF'] . '?'.$_POST['query_str'];;
  	mysqli_close($link);

 header("Location: $ret");
 exit();
}

if (isset($_POST['doApprove'])) {
	if($_POST['doApprove'] == 'Approve') {

if(!empty($_POST['u'])) {
	foreach ($_POST['u'] as $uid) {
		$id = filter($link, $uid);
		$query_statement =  "update users set approved='1' where id='$id'";
		mysqli_query($link,$query_statement );
			if (mysqli_errno($link) != 0) {
		showerror($link);
	die('Error querying database.');
			}
		$query_statement =  "select user_email from users where id='$uid'";
		
	list($to_email) = mysql_fetch_row(mysqli_query($link,$query_statement ));	
 
$message = 
"Hello,\n
Thank you for registering with us. Your account has been activated...\n

*****LOGIN LINK*****\n
http://$host$path/login/login.php

Thank You

Administrator
$host_upper
______________________________________________________
THIS IS AN AUTOMATED RESPONSE. 
***DO NOT RESPOND TO THIS EMAIL****
";

@mail($to_email, "User Activation", $message,
    "From: \"Member Registration\" <auto-reply@$host>\r\n" .
     "X-Mailer: PHP/" . phpversion()); 
	 
	}
 }
 
 $ret = $_SERVER['PHP_SELF'] . '?'.$_POST['query_str'];	 
  	mysqli_close($link);

 header("Location: $ret");
 exit();
	}
}
	$query_statement =  "select count(*) as total_all from users";
	$rs_all = mysqli_query($link,$query_statement ) or die(mysql_error());
	$query_statement =  "select count(*) as total_active from users where approved='1'";
	$rs_active = mysqli_query($link,$query_statement ) or die(mysql_error());
	$query_statement =  "select count(*) as tot from users where approved='0'";
	$rs_total_pending = mysqli_query($link,$query_statement );						   

	list($total_pending) = mysqli_fetch_row($rs_total_pending);
	list($all) = mysqli_fetch_row($rs_all);
	list($active) = mysqli_fetch_row($rs_active);
 	mysqli_close($link);


function query_admin_data($sql_statement) {
include ('open_file.php');
$useresults = mysqli_query($link, $connect_table );
	
	$rs_results = mysqli_query($link, $sql_statement) ;
	if (mysqli_errno($link) != 0) {
		showerror($link);
	die('Error querying database.');
	}
//	
	$total = mysqli_num_rows($rs_results);
//	$total = mysqli_fetch_row($rs_results);
	mysqli_close($link);

	return $total;
	
}

function query_admin_2_data($sql,$start,$page_limit) {
include ('open_file.php');
$useresults = mysqli_query($link, $connect_table );
	
	  $rs_results = mysqli_query($link, $sql . " limit $start,$page_limit") ;
	if (mysqli_errno($link) != 0) {
		showerror($link);
	die('Error querying database.');
	}
//	
//	list($total) = mysqli_fetch_row($rs_results);
	mysqli_close($link);

	return $rs_results;
	
}
function query_admin_chk_dups_user($query_string) {
include ('open_file.php');
	$useresults = mysqli_query($link, $connect_table );
	
	$rs_dup = mysqli_query($link,$query_string);
	if (mysqli_errno($link) != 0) {
		showerror($link);
		die('Error querying database.');
	}
	list($dups) = mysqli_fetch_row($rs_dup);
//	
//	list($total) = mysqli_fetch_row($rs_results);
	mysqli_close($link);

	return $dups;
	
}
function insert_admin_data($sql_statement) {
include ('open_file.php');
$useresults = mysqli_query($link, $connect_table );
	if (mysqli_errno($link) != 0) {
		showerror($link);
		die('Error querying database.');
	}
	$rs_results = mysqli_query($link, $sql_statement);
	if (mysqli_errno($link) != 0) {
		showerror($link);
		die('Error querying database.');
	}

	mysqli_close($link);

	return ;
}
?>