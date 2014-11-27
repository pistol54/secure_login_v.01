<?php 
session_start();
//require_once ('assets/include/checktimming.php');

		// user is logged in
	if(!isset($_SESSION['isLoggedIn']) || !($_SESSION['isLoggedIn']))
	{
		//user is not logged in
		// simply redirect to index.html
		session_unset();
//		header("Location:index.php");	
	}
	else
	{
		require 'assets/include/timeCheck.php';
		$hasSessionExpired = checkIfTimedOut();
		if($hasSessionExpired)
		{
			session_unset();
//			header("Location:index.php");	
			//exit;
		}
		else
		{
			$_SESSION['loggedAt']= time();// update last accessed time
//			showLoggedIn();
		}
	}
	include ('assets/include/Check_Permissions.php');
	$search = Check_Permissions();
?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Login Security</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
	<link href="assets/css/mainsite.css" rel="stylesheet" />
	<link href="assets/css/index_style.css" rel="stylesheet" />
    <link href="assets/css/navbar_vert.css" rel="stylesheet" />
<!--	<link href="assets/css/styles.css" rel="stylesheet" >
-->
<body>
<?php
//			require_once ('assets/include/dbc.php');
			require_once ('assets/include/appvars.php');
			require_once ('assets/include/debugConst.php');
			include ("assets/include/intro.php");
?>
<div class="container">
<?php
	if(!isset($_SESSION['isLoggedIn']) || !($_SESSION['isLoggedIn']))
	{	
	}
	else {
	?>
//		<script src="assets/js/ajax.js"></script>;
<?php
	}
	?>
    <header class="header title">
        <h1 >Welcome Login Security</h1>
    </header>
           <?php
			if ($search) {
        ?>
        <div class="search">
            <h5>Search</h5>
            <form method="get" action="#">
        <table width="100%" border="0" cellpadding="3" cellspacing="3" class="forms">
     		<tr>    
     			<td><label for="usersearch">portfolio</label> </td>
      			<td><input type="text" id="usersearch" name="usersearch" /></td>
 				<td><input type="hidden" id="sort" name="sort"value=1  /></td>
				<td><input type="submit" name="submit" value="Submit" maxlength="8"></td>
               </tr>
               </table>
       </form>
        </div>
        <?php
		}
		?>
<?php
    require_once ("assets/include/nav_bar.inc.php");
?>

<!--//    <style type="text/css">
//					.content {
//						width: 600px;
//					}
//                </style>-->
    <article class="content">
        <p>It is the star to every wand'ring bark, which alters when it alteration finds, love alters not with his brief hours and weeks. Whose worth's unknown, although his height be taken. Let me not to the marriage of true minds within his bending sickle's compass come; it is the star to every wand'ring bark.
            
            But bears it out even to the edge of doom. Or bends with the remover to remove. Love alters not with his brief hours and weeks, oh, no, it is an ever fixed mark admit impediments; love is not love. </p>
        <p></p>
        </article>
 
    <div class="footer">
    <p >Copyright Covert Computer Operations, 2013</p>
    <!-- end .footer -->
    </div>

    <!-- end .container --> 
</div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
	<script  src="assets/js/script.js"></script>
<!-- <script>-->
</body>
</html>
