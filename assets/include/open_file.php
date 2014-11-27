<?php
require_once ("db.php");
$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (!$link) {
	echo "bad connection =";
	showerror($link);
	echo "connection " . DB_HOST . ' ' . DB_USER . ' ' . DB_PASSWORD . ' ' . DB_NAME;
	die('Could not connect: ');
}
$connect_table = "USE pistol54_login_security";
?>