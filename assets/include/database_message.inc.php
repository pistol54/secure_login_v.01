<?php
require_once ('debugConst.php');
require_once ('appvars.php');
require_once ('connectvars.php');
require_once ('db.php');

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
if (!$dbc) {
	echo "bad connection =" . mysql_error();
	showerror($dbc);
	echo "connection " . DB_HOST . ' ' . DB_USER . ' ' . DB_PASSWORD . ' ' . DB_NAME . ' ' . "<br>";
	die('Could not connect: ' . mysql_error());
}
	
$query = 'CREATE Database pistol54_login_security';
$data = mysqli_query($dbc, $query ) ;
	if (mysqli_errno($dbc) != 0) {
		showerror($dbc);
		die('Error querying database. user table');
	}
echo "<h3>Database created successfully\n </h3>";
mysqli_close($dbc);
//require_once("registrate.php");

?>