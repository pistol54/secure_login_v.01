<?php 
require_once 'dbc.php';
require_once ('db.php');
require_once ('appvars.php');
require_once ('connectvars.php');
include ('open_file.php');
$useresults = mysqli_query($link, $connect_table );

function query_data($sql_statement) {
include ('open_file.php');
$useresults = mysqli_query($link, $connect_table );
	
	$rs_results = mysqli_query($link, $sql_statement) ;
	if (mysqli_errno($link) != 0) {
		showerror($link);
	die('Error querying database.');
	}
//	
	list($total) = mysqli_fetch_row($rs_results);
	mysqli_close($link);

	return $total;
	
}

function query_login_data($sql_statement) {
include ('open_file.php');
$useresults = mysqli_query($link, $connect_table );

	$result = mysqli_query($link, $sql_statement) ;
	if (mysqli_errno($link) != 0) {
		showerror($link);
	die('Error querying database.');
	}
	$num = mysqli_num_rows($result);

  // Match row found with more than 1 results  - the user is authenticated. 
    if ( $num > 0 ) { 
	
	list($id,$pwd,$full_name,$approved,$user_level) = mysqli_fetch_row($result);
	
	if(!$approved) {
	//$msg = urlencode("Account not activated. Please check your email for activation code");
	$err[] = "Account not activated. Please check your email for activation code";
	
	//header("Location: login.php?msg=$msg");
	 //exit();
	 }
//	 $items = explode( "\n", list() ); // Split by newline ( you can also use "<br>" as separator )
//	list($id,$pwd,$full_name,$approved,$user_level)= array_merge( explode( '=', $num ), array( true ) );
	$list = array(); 
	$list[] = $id;
	$list[] = $pwd;
	$list[] = $full_name;
	$list[] = $approved;
	$list[] = $user_level;
	$list[] = $num;
	} else {
		$list = array(0,0,0,0,0,0);
	}
	mysqli_close($link);

	return array($id,$pwd,$full_name,$approved,$user_level,$num);
}
function query_login_update_data($sql_statement) {
include ('open_file.php');
$useresults = mysqli_query($link, $connect_table );

	$results = mysqli_query($link, $sql_statement) ;
	if (mysqli_errno($link) != 0) {
		showerror($link);
	die('Error querying database.');
	}
	mysqli_close($link);

	return $results;
}

function query_mysettings_data($sql_statement) {
include ('open_file.php');
$useresults = mysqli_query($link, $connect_table );
	
	$rs_results = mysqli_query($link, $sql_statement) ;
	if (mysqli_errno($link) != 0) {
		showerror($link);
	die('Error querying database.');
	}
//	
	list($total) = mysqli_fetch_row($rs_results);
	mysqli_close($link);

	return $total;
	
}

?>
<!--$rs_duplicate = mysqli_query($link, "select count(*) as total from users where user_email='$usr_email' OR user_name='$user_name'") or die(mysql_error());
list($total) = mysqli_fetch_row($rs_duplicate);

if ($total > 0)
{
$rs_dup_results  = mysqli_query($link, "select user_name, user_email from users where user_email='$usr_email' OR user_name='$user_name'") or die(mysql_error());
while ($row_settings = mysqli_fetch_array($rs_dup_results)) {	
$dup_data =	 $row_settings['user_name'] . '    ' .  $row_settings['user_email']; 
$err[] = "ERROR - The username/email already exists. Please try again with different username and email." . $dup_data;
}
}-->