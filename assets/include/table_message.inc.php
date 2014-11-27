<?php
//function create_tables() {
require_once ('debugConst.php');
require_once ('appvars.php');
require_once ('connectvars.php');
require_once ('open_file.php');
require_once ('db.php');
$useresults = mysqli_query($link, $connect_table );

// if (!NODEBUG) {
$query = "CREATE TABLE users (".
  "id bigint(20) NOT NULL auto_increment,".
  "md5_id varchar(200) collate latin1_general_ci NOT NULL default '',".
  "full_name tinytext collate latin1_general_ci NOT NULL,".
  "user_name varchar(200) collate latin1_general_ci NOT NULL default '',".
  "user_email varchar(220) collate latin1_general_ci NOT NULL default '',".
  "user_level tinyint(4) NOT NULL default '1',".
  "pwd varchar(220) collate latin1_general_ci NOT NULL default '',".
  "zipcode varchar(5) COLLATE latin1_general_ci NOT NULL,".
  "country varchar(200) collate latin1_general_ci NOT NULL default '',".
  "tel varchar(200) collate latin1_general_ci NOT NULL default '',".
  "fax varchar(200) collate latin1_general_ci NOT NULL default '',".
  "website text collate latin1_general_ci NOT NULL,".
  "date date NOT NULL default '0000-00-00',".
  "users_ip varchar(200) collate latin1_general_ci NOT NULL default '',".
  "approved int(1) NOT NULL default '0',".
  "activation_code int(10) NOT NULL default '0',".
  "banned int(1) NOT NULL default '0',".
  "ckey varchar(220) collate latin1_general_ci NOT NULL default '',".
  "ctime varchar(220) collate latin1_general_ci NOT NULL default '',".
  "PRIMARY KEY  (id),".
  "UNIQUE KEY user_email (user_email),".
  "FULLTEXT KEY idx_search (full_name,zipcode,user_email,user_name)".
	") ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=55" ;
	
	//echo 'this is my query _ ' . $query . 'the end <br />';
	$data = mysqli_query($link, $query ); //or die(printf("Error: %s\n", $mysqli->error));'Error querying database. user table');

	if (mysqli_errno($link) != 0) {
		showerror($link);
		die('Error querying database. user table');
	}
	
	echo "<h4>USER TABLE created successfully\n \n</h4>";

	mysqli_close($link);

?>