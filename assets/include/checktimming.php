<?php
		// user is logged in
	if(!isset($_SESSION['isLoggedIn']) || !($_SESSION['isLoggedIn']))
	{
		//user is not logged in
		// simply redirect to index.html
		session_unset();
		header("Location:index.php");	
	}
	else
	{
		require 'timeCheck.php';
		$hasSessionExpired = checkIfTimedOut();
		if($hasSessionExpired)
		{
			session_unset();
			header("Location:index.php");	
			//exit;
		}
		else
		{
			$_SESSION['loggedAt']= time();// update last accessed time
//			showLoggedIn();
		}
	}
	?>