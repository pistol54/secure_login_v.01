<?php session_start(); 
$install_flag = 1;
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Login Security</title>
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
	<link href="../assets/css/mainsite.css" rel="stylesheet" />
	<link href="../assets/css/install.css" rel="stylesheet" />
    <link href="../assets/css/navbar_vert.css" rel="stylesheet" />
	<link href="../assets/css/styles.css" rel="stylesheet" >
<script type="text/javascript" src="../assets/js/ajaxpagefetcher.js"> /*********************************************** * Ajax Page Fetcher- by JavaScript Kit (www.javascriptkit.com) * This notice must stay intact for usage * Visit JavaScript Kit at http://www.javascriptkit.com/ for this script and 100s more ***********************************************/ </script>

</head>
<body>
<?php
	require_once ('../assets/include/appvars.php');
	require_once ('../assets/include/debugConst.php');
	require_once ('../assets/include/connectvars.php');
//	$messages = '';
?>
<?php

//if (isset($_GET['run'])) $linkchoice=$_GET['run'];
//else $linkchoice='';
//
//switch($linkchoice){
//	case 'create_database' :
//    create_database();
//    break;
//case 'create_tables' :
//    create_tables();
////	echo $messages;
//    break;
//
//case 'populate_tables' :
//    populate_tables();
//    break;
//
//case 'insert_user' :
//    insert_user();
//	break;
//default :
//	break;
//} 
?>
<div class="container">
<?php
	include ("../assets/include/intro.php");
?>
<header class="header title">
        <h1 >Welcome Login Security </h1>
   </header>
<?php
$_SESSION['human_page'] = false;
$_SESSION['project_page'] = false;
//require_once ("../assets/include/navbar_vert.inc.php");
?>
    <div class="content">
    <p>This interface is a one time process that you do when you are setting up your database.</p>

    <p>Step 1 Create Database. 
<a  href="javascript:ajaxpagefetcher.load('database_message', '../assets/include/database_message.inc.php', false, '', ['../assets/css/install.css'])">Create Database</a></p>
     <div id="database_message"></div>
   <hr>
    <p>Step 2 Create Tables.
 <a  href="javascript:ajaxpagefetcher.load('table_message', '../assets/include/table_message.inc.php', false, '', ['../assets/css/install.css'])">Create Tables</a></p>
    <div id="table_message"></div>
   <hr>

<!--	<script type="text/javascript">
--><!-- Fetch and display "../assets/include/insert_user.php" inside a DIV when a link is clicked on. Also load one .css file-->
<p>Step 3 Setup your Root users for your tables.    
<a  href="javascript:ajaxpagefetcher.load('user_insert', '../assets/include/insert_user.php', false, '', ['../assets/css/install.css'])">Create Root User</a></p>
<!--</script>-->
	<div id="user_insert"></div>

   <hr>

<!--    <p>Step 4 Populate Tables. 
<a  href="javascript:ajaxpagefetcher.load('populate_message', '../assets/include/populate_message.inc.php', false, '', ['../assets/css/install.css'])">Populate Tables</a></p>
    <div id="populate_message"></div>
   <hr>
-->
</div>
  <div class="footer">
    <p >Copyright Covert Computer Operations, 2013</p>
    <!-- end .footer -->
    </div>
</div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="../assets/js/bootstrap.js"></script>
<!-- <script>-->
</body>
</html>
