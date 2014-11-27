<?php session_start(); 
$install_flag = 1;
// require_once("installfileupdate.php");
require_once("../assets/include/registrate.php");
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>8162 Technologists Group</title>
<link id="stylesheet" href="../assets/css/install.css" rel="stylesheet" type="text/css" />
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

if (isset($_GET['run'])) $linkchoice=$_GET['run'];
else $linkchoice='';

switch($linkchoice){
	case 'create_database' :
    create_database();
    break;
case 'create_tables' :
    create_tables();
//	echo $messages;
    break;

case 'populate_tables' :
    populate_tables();
    break;

case 'insert_user' :
    insert_user();
	break;
default :
	break;
} 
?>
<div class="container">
<?php
	include ("../assets/include/intro.php");
?>
    <div class="sidebar1">
        <ul class="nav">
            <li>
                <a href="../index.php">Home</a>
            </li>
        </ul>
        <!-- end .sidebar1 -->
    </div>
      <div class="title">
        <h1 >Welcome 8162 Technologists Group </h1>
    </div>
    <div class="content">
    <p>This interface is a one time process that you do when you are setting up your database.</p>
    <p>Step 1 Create Database. <a href="?run=create_database">Create Database </a></p>
    <p>Step 2 Create Tables. <a href="?run=create_tables">Create Tables</a> </p>

	<div id="user_insert"> </div>
<!--	<script type="text/javascript">
--><!-- Fetch and display "sub/content2.htm" inside a DIV when a link is clicked on. Also load one .css file-->
<p>Step 3 Setup your Root users for your tables.    
<a  href="javascript:ajaxpagefetcher.load('user_insert', '../assets/include/insert_user.php', false, '', ['../assets/css/install.css'])">Create Root User 2</a>
<!--</script>
Create Root User</p>-->
<!--     <a href="?run=insert_user">Create Root User</a> </p>-->
    <p>Step 4 Populate Tables. <a href="?run=populate_tables">Populate Tables</a> 
    

</div>
<?php
function create_database() {
require_once ('../assets/include/debugConst.php');
require_once ('../assets/include/appvars.php');
require_once ('../assets/include/connectvars.php');
require_once ('../assets/include/db.php');

echo "connection " . DB_HOST . ' ' . DB_USER . ' ' . DB_PASSWORD . ' ' . DB_NAME;
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
if (!$dbc) {
	echo "bad connection =" . mysql_error();
	echo "connection " . DB_HOST . ' ' . DB_USER . ' ' . DB_PASSWORD . ' ' . DB_NAME;
	die('Could not connect: ' . mysql_error());
}
	
echo 'Connected successfully';
$query = 'CREATE Database pistol54_8162technologists_group';
$data = mysqli_query($dbc, $query ) ;
	if (mysqli_errno($dbc) != 0) {
		showerror($dbc);
		die('Error querying database. user table');
	}
echo "Database test_db created successfully\n";
mysqli_close($dbc);
require_once("../assets/include/registrate.php");

}
function create_tables() {
require_once ('../assets/include/debugConst.php');
require_once ('../assets/include/appvars.php');
require_once ('../assets/include/connectvars.php');
require_once ('../assets/include/open_file.php');
require_once ('../assets/include/db.php');
$useresults = mysqli_query($dbc, $connect_table );

// $messages .=  "Create the USER TABLE ... \n";
	//Print "Create the USER TABLE ..."; 
 // Connects to your Database 
// mysql_connect("your.hostaddress.com", "username", "password") or die(mysql_error()); 
// mysql_select_db("Database_Name") or die(mysql_error()); 

if (!NODEBUG) {
	 $query = "CREATE TABLE user (".
	  "user_id int(11) NOT NULL,".
	  "username varchar(255) DEFAULT NULL,".
	  "email varchar(255) DEFAULT NULL,".
	  "password char(64) DEFAULT NULL,".
	  "permission int(10) unsigned NOT NULL,".
	  "create_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,".
	  "old_password char(64) DEFAULT NULL,".
	  "limit_time_in_no_days tinyint(4) unsigned DEFAULT NULL,".
	  "last_modifidy_date timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,".
	  "password_reset tinyint(1) unsigned DEFAULT '0',".
	  "PRIMARY KEY (user_id),".
	  "UNIQUE KEY email (email),".
	  "KEY username (username)".
	") ENGINE=InnoDB DEFAULT CHARSET=latin1;";
	
	//echo 'this is my query _ ' . $query . 'the end <br />';
	$data = mysqli_query($dbc, $query ); //or die(printf("Error: %s\n", $mysqli->error));'Error querying database. user table');

	if (mysqli_errno($dbc) != 0) {
		showerror($dbc);
		die('Error querying database. user table');
	}
//	$messages .=  'Your USER TABLE has been created \n';
//	Print "Your USER TABLE has been created"; 
	
//	$messages .=  "Create the PROJECT TABLE ...\n"; 
	$query = "CREATE TABLE project_master (".
    "proj_num int(10) unsigned NOT NULL COMMENT 'Primary Key: Unique batch ID.',".
    "proj_name varchar(255) NOT NULL COMMENT 'The project name.',".
    "active char(1) NOT NULL COMMENT 'Active=A,New=0,Completed=C',".
    "create_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,".
    "last_modifidy_date timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,".
    "PRIMARY KEY (proj_num),".
    "UNIQUE KEY proj_num_unique (proj_num)".
	")  ENGINE=InnoDB DEFAULT CHARSET=latin1;";

	$data = mysqli_query($dbc, $query );

	if (mysqli_errno($dbc) != 0) {
		showerror($dbc);
		die('Error querying database. user table');
	}

} // NO_DEBUG

	$query = "CREATE TABLE project_detail (".
  "proj_num int(10) unsigned NOT NULL COMMENT 'The project num.',".
  "emp_num int(10) unsigned NOT NULL COMMENT 'The employee.nid to which this one of the employyees assign to this project.',".
  "project_leader tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '= 1 means project leader.',".
  "hours decimal(5,2) NOT NULL COMMENT 'The hours the employee has worked on this project.',".
  "create_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,".
  "last_modifidy_date timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,".
  "PRIMARY KEY (proj_num,emp_num),".
  "UNIQUE KEY proj_num_UNIQUE (proj_num,emp_num),".
  "KEY proj_num (proj_num,emp_num)".
  ") ENGINE=InnoDB DEFAULT CHARSET=latin1;";
  	
	$data = mysqli_query($dbc, $query );

	if (mysqli_errno($dbc) != 0) {
		showerror($dbc);
		die('Error querying database. user table');
	}

	$query = "CREATE TABLE employees (".
	  "emp_num int(10) unsigned NOT NULL COMMENT 'Primary Key: Unique batch ID.',".
	  "emp_name varchar(255) NOT NULL COMMENT 'The Employee name.',".
	 "job_id int(10) unsigned NOT NULL COMMENT 'The job.nid points to the job skill and hourly pay rate.',".
	 "create_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,".
	 "last_modifidy_date timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,".
	  "PRIMARY KEY (emp_num),".
	 "UNIQUE KEY emp_num_unique (emp_num),".
	  "KEY job_id (job_id)".
	") ENGINE=InnoDB DEFAULT CHARSET=latin1;";
	
	$data = mysqli_query($dbc, $query );

	if (mysqli_errno($dbc) != 0) {
		showerror($dbc);
		die('Error querying database. user table');
	}

	$query = "CREATE TABLE job_class (".
	  "job_id int(10) unsigned NOT NULL COMMENT 'Primary Key: Unique batch ID.',".
	  "job_class varchar(255) NOT NULL COMMENT 'Job Classification.',".
	  "chg_hour decimal(8,2) DEFAULT NULL COMMENT 'Hourly Rate',".
	  "create_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,".
	  "last_modifidy_date timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,".
	  "PRIMARY KEY (job_id),".
	  "UNIQUE KEY job_id_unique (job_id),".
	  "KEY job_id (job_id)".
	") ENGINE=InnoDB DEFAULT CHARSET=latin1;";
	
	$data = mysqli_query($dbc, $query );
	
	if (mysqli_errno($dbc) != 0) {
		showerror($dbc);
		die('Error querying database. user table');
	}

	mysqli_close($dbc);
}




function populate_tables() {
require_once ('../assets/include/debugConst.php');
require_once ('../assets/include/appvars.php');
require_once ('../assets/include/connectvars.php');
require_once ('../assets/include/open_file.php');
require_once ('../assets/include/db.php');

$useresults = mysqli_query($dbc, $connect_table );
// Build the JOB_CLASS Table
if (NODEBUG) {
$job_array[] = '';
for ($i = 0; $i < 8; $i++) {
switch($i){
	case '0' :
		$job_class = 'Applications Designer';	
		$chg_hour = 48.10;
		$job_arry[$job_class] = ($i);
    	break;	
	case '1' :
		$job_class = 'Clerical Support';
		$chg_hour =	26.87;  
		$job_arry[$job_class] = ($i);
		break;	
	case '2' :
		$job_class = 'Database Designer';
		$chg_hour =	105.00;
		$job_arry[$job_class] = ($i);
    	break;	
	case '3' :
		$job_class = 'DSS Analyst';
		$chg_hour =	45.95;
		$job_arry[$job_class] = ($i);
    	break;	
	case '4' :
		$job_class = 'Elect.Engineer';
		$chg_hour =	84.50;
		$job_arry[$job_class] = ($i);
	    break;	
	case '5' :
		$job_class = 'General Support';
		$chg_hour =	18.36;
		$job_arry[$job_class] = ($i);
	    break;	
	case '6' :
		$job_class = 'Programmer';
		$chg_hour =	35.75;
		$job_arry[$job_class] = ($i);
	    break;	
	case '7' :
		$job_class = 'Systems Analyst';
		$chg_hour =	96.75;
		$job_arry[$job_class] = ($i);
	    break;	
	default:
    break;	
}
	$query = "INSERT INTO job_class (job_id,job_class,chg_hour) VALUES ('$i','$job_class','$chg_hour')";
	$data = mysqli_query($dbc, $query ); 
	
	if (mysqli_errno($dbc) != 0) {
		showerror($dbc);
		die('Error inserting JOB_CLASS data');
	}

}


//   Build The EMPLOYEE TABLE
for ($i = 0; $i < 14; $i++) {
switch($i){
	case '0' :
		$emp_num = 101;	
		$emp_name = 'John G. News';
		$job_id = $job_arry['Database Designer'];
    	break;	
	case '1' :
		$emp_num = 102;
		$emp_name =	'David H. Senior';    
		$job_id = $job_arry['Systems Analyst'];
		break;	
	case '2' :
		$emp_num = 103;		
		$emp_name =	'June E. Arbough';    
		$job_id = $job_arry['Elect.Engineer'];
    	break;	
	case '3' :
		$emp_num = 104;	
		$emp_name =	'Anne K. Ramores';    
		$job_id = $job_arry['Systems Analyst'];
    	break;	
	case '4' :
		$emp_num = 105;		
		$emp_name =	'Aice K. Johnson';    
		$job_id = $job_arry['Database Designer'];
	    break;	
	case '5' :
		$emp_num = 106;		
		$emp_name =	'William Smithfield';    
		$job_id = $job_arry['Programmer'];
	    break;	
	case '6' :
		$emp_num = 107;		
		$emp_name =	'Maria D. Alonzo';    
		$job_id = $job_arry['Programmer'];
	    break;	
	case '7' :
		$emp_num = 108;		
		$emp_name =	'Ralph B. Washington';    
		$job_id = $job_arry['Systems Analyst'];
	    break;	
	case '8' :
		$emp_num = 111;	
		$emp_name =	'Geoff B. Wabash';    
		$job_id = $job_arry['Clerical Support'];
	    break;	
	case '9' :
		$emp_num = 112;		
		$emp_name =	'Darlene M. Smithson';    
		$job_id = $job_arry['DSS Analyst'];
	    break;	
	case '10' :
		$emp_num = 113;		
		$emp_name =	'Detsetl K. Joenbrood';    
		$job_id = $job_arry['Applications Designer'];
	    break;	
	case '11' :
		$emp_num = 114;		
		$emp_name =	'Annelise Jones';    
		$job_id = $job_arry['Applications Designer'];
	    break;	
	case '12' :
		$emp_num = 115;		
		$emp_name =	'Travis B. Bawangi';    
		$job_id = $job_arry['Systems Analyst'];
	    break;	
	case '13' :
		$emp_num = 118;		
		$emp_name =	'James J. Frommer';    
		$job_id = $job_arry['General Support'];
	    break;	

	default:
    break;	
}
	$query = "INSERT INTO employees (emp_num,emp_name,job_id) VALUES ('$emp_num','$emp_name','$job_id')";
	$data = mysqli_query($dbc, $query ); 
	
	if (mysqli_errno($dbc) != 0) {
		showerror($dbc);
		die('Error inserting employees data');
	}
}

require_once ('../assets/include/insert_product_master.inc.php');
} // nodebug


require_once ('../assets/include/insert_product_detail.inc.php');
mysqli_close($dbc);
}
?>
</div>


</body>
</html>

<?php
echo "<mm:dwdrfml documentRoot=" . __FILE__ .">";$included_files = get_included_files();foreach ($included_files as $filename) { echo "<mm:IncludeFile path=" . $filename . " />"; } echo "</mm:dwdrfml>";
?>