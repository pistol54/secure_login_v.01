<?php 
/********************** MYSETTINGS.PHP**************************
This updates user settings and password
************************************************************/
require_once ('dbc.php');
page_protect();

$err = array();
$msg = array();

if (isset($_POST['doUpdate'])) {
if($_POST['doUpdate'] == 'Update')  
{
include ('open_file.php');
$useresults = mysqli_query($link, $connect_table );
$query_statement = "select pwd from users where id='$_SESSION[user_id]'";


$rs_pwd = mysqli_query($link, $query_statement);
list($old) = mysqli_fetch_row($rs_pwd);
$old_salt = substr($old,0,9);

//check for old password in md5 format
	if($old === PwdHash($_POST['pwd_old'],$old_salt))
	{
	$newsha1 = PwdHash($_POST['pwd_new']);
	$query_statement = "update users set pwd='$newsha1' where id='$_SESSION[user_id]'";
	
	mysqli_query($link, $query_statement);
	$msg[] = "Your new password is updated";
	//header("Location: mysettings.php?msg=Your new password is updated");
	} else
	{
	 $err[] = "Your old password is invalid";
	 //header("Location: mysettings.php?msg=Your old password is invalid");
	}
	mysqli_close($link);

	}
}

if (isset($_POST['doSave'])) {
if($_POST['doSave'] == 'Save')  
{
include ('open_file.php');
$useresults = mysqli_query($link, $connect_table );
// Filter POST data for harmful code (sanitize)
foreach($_POST as $key => $value) {
	$data[$key] = filter($link, $value);
}
	$query_statement = "UPDATE users SET
			`full_name` = '$data[name]',
			`zipcode` = '$data[zipcode]',
			`tel` = '$data[tel]',
			`fax` = '$data[fax]',
			`country` = '$data[country]',
			`website` = '$data[web]'
			 WHERE id='$_SESSION[user_id]'
			";


mysqli_query($link, $query_statement) or die(mysql_error());

//header("Location: mysettings.php?msg=Profile Sucessfully saved");
$msg[] = "Profile Sucessfully saved";
	mysqli_close($link);

 }
}
include ('open_file.php');
$useresults = mysqli_query($link, $connect_table );

$rs_settings = mysqli_query($link, "select * from users where id='$_SESSION[user_id]'"); 
	mysqli_close($link);

?>