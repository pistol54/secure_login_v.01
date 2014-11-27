<?php
require_once ('../assets/include/debugConst.php');
require_once ('../assets/include/appvars.php');
require_once ('../assets/include/connectvars.php');

// CHECK if form is submitted
if (isset($_POST['username'])) {
	$password = (sha256_check($_POST['password']));
	$username = stripslashes(trim($_POST['username']));
	// $password = $_POST['password'];
	require_once ("../assets/include/open_file.php");
	// if (!NODEBUG) {
	// 	print("check password  " . $_POST["username"]);
	// }
	$useresults = mysqli_query($dbc, $connect_table );

	$query = "select  user_id, username, password, permission  from user WHERE username = '" . $username . "'";

	$data = mysqli_query($dbc, $query ) or die('Error querying database.');
//	if (!$data)
//		echo "Error on query" . mysql_error();

	if (mysqli_num_rows($data) == 1) {
		// The user row was found so display the user data
//		$row = mysqli_fetch_array($result, MYSQL_BOTH)
		$row = mysqli_fetch_array($data);
		if (!NODEBUG) {
			print("check password  " . $username);
		}
		if ($row != NULL) {
			$id = $row['user_id'];
			$user_name = $row['username'];
			$pass_word = $row['password'];
//			$id = htmlspecialchars($row['user_id']);
//			$user_name = htmlspecialchars($row['username']);
//			$pass_word = htmlspecialchars($row['password']);
//			$contactid = $row['contactId'];
			if (!NODEBUG) {
				print("check user_id  " . $user_id);
			}
			if ($username == $user_name && $password == $pass_word) {
				$_SESSION['isLoggedIn'] = 1;
				//setting a varable so that later i know
				// that this user i logged in
				$exp = time() + (60 * 60 * 1);
				$_SESSION['username'] = $username;
				//setting another variable
				
				$_SESSION['permission'] = $row['permission'];
	//			$_SESSION["contactid"] = $contactid;
				$_SESSION['mid'] = $id;
				setcookie('user_id', htmlspecialchars($row['user_id'], $exp));
				setcookie('username', htmlspecialchars($row['username'], $exp));
//				setcookie('contactid', htmlspecialchars($row['contactId'], $exp));

				header('Location: ../index.php?action=logout');
				exit();
			} else {
				echo "There was an error username/password do not match";
			}
		}
	}
	// for logout or destroy session
	if (isset($_GET["action"])) {
		if ($_GET["action"]) {

			session_unset();
			//unset all session variables

			session_destroy();
			// destroy session
		}
	}
};

function sha256_check($str) {
	//$sha256_regex = "/^[0-9a-f]{64}$/";
	$pword = hash('sha256', $str);
	//	$pword = ($sha256_regex, $str)) ;
	return $pword;
}
?>