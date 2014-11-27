<?php
session_start();
// for logout or destroy session
	if (isset($_GET["action"])) {
		$action = $_GET['action'];
	}
//	echo $_SESSION['username'];
	if (isset($_SESSION['username'])) {
		if ($action == "logout") {
			setcookie('user_id', 0, time() - 3600);
			setcookie('username', "", time() - 3600);
	//		setcookie('contactid', 0, time() - 3600);
	//		session_unset();
	//		session_destroy();
			$_SESSION['isLoggedIn'] = 0;
			$_SESSION['username'] = '';
			$_SESSION['uname'] = "";
			//setting another variable
			$_SESSION['permission'] = 0;
	//		$_SESSION["contactid"] = 0;
			$_SESSION['mid'] = 0;
	
			//      
			//unset all session variables
	
			//      session_destroy();
		}
	}
		header('Location:  ../../index.php');
		// destroy session
	


//if(isset($_GET['action'])) {
//
//if(isset($_SESSION['user']) && $action == "login") {
//    header("Location: {$_SCRIPTNAME}?action=overview");
//    exit;
//} elseif($action == 'logout') {
//    session_unset();
//    header("Location: {$_SCRIPTNAME}?action=login");
//    exit;
//} else {
//    header("Location: {$_SCRIPTNAME}?action=login");
//    exit;
//}
?>