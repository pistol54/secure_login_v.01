<?php
date_default_timezone_set('America/Los_Angeles');
$date = new DateTime();
if (isset($_SESSION["username"])) {
	$username = $_SESSION["username"];
	echo '<p id="intro" >' . "Welcome " . '<span>' . $username . '</span>' . " " . date('m/d/y');
	'</p>';

} else {
	echo '<p id="intro" >' . "Welcome " . " " . date('m/d/y h:iA');
	'</p>';
}
?>