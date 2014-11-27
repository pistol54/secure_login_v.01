<?php 
//session_start();
if (isset($_SESSION["isLoggedIn"])) {
	if ((!$_SESSION["isLoggedIn"] == 1) && (!isset($_COOKIE['username']))) {
		echo "Sorry you you need to login ";
		header('Location:  ../index.php');
	} else {
		if (!isset($_SESSION['username'])) {
			echo "Sorry you you need to login ";
			header('Location:  ../index.php');
		}
	}
} else {
echo "Sorry you you need to login ";
	header('Location:  ../index.php');
}

// $permission = $_GET["permission"];
//if ($_SESSION["permission"] <= '7') {
	//		echo "Sorry you can only edit your profile. ";
//	header('Location:  ../index.php');
//}
?>