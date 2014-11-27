<?php 
require_once 'dbc.php';
require_once ('db.php');
require_once ('appvars.php');
require_once ('connectvars.php');

function insert_reg_data($sql_statement) {
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

$user_id = mysqli_insert_id($link);  
$md5_id = md5($user_id);
mysqli_query($link, "update users set md5_id='$md5_id' where id='$user_id'");
	mysqli_close($link);

	return ;

}
?>