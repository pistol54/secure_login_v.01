<?php
ob_start();
session_start();
require_once ('../assets/include/login.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Members Login</title>
<meta charset="utf-8">
<script language="JavaScript" type="text/javascript" src="../assets/js/jquery-1.3.2.min.js"></script>
<script language="JavaScript" type="text/javascript" src="../assets/js/jquery.validate.js"></script>
  <script>
  $(document).ready(function(){
    $("#logForm").validate();
  });
  </script>
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
	<link href="../assets/css/mainsite.css" rel="stylesheet" />
	<link href="../assets/css/index_style.css" rel="stylesheet" />
    <link href="../assets/css/navbar_vert.css" rel="stylesheet" />
	<link href="../assets/css/styles.css" rel="stylesheet" >

</head>

<body>
<?php
	include ("../assets/include/intro.php");
?>
<table width="100%" border="0" cellspacing="0" cellpadding="5" class="main">
  <tr> 
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr> 
    <td width="160" valign="top"><p>&nbsp;</p>
    <?php       
    require_once ("../assets/include/nav_bar.common.inc.php");
?>     

      <p>&nbsp; </p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="732" valign="top"><p>&nbsp;</p>
      <h3 class="titlehdr">Login Users 
      </h3>  
	  <p>
	  <?php
	  /******************** ERROR MESSAGES*************************************************
	  This code is to show error messages 
	  **************************************************************************/
	  if(!empty($err))  {
	   echo "<div class=\"msg\">";
	  foreach ($err as $e) {
	    echo "$e <br>";
	    }
	  echo "</div>";	
	   }
	  /******************************* END ********************************/	  
	  ?></p>
      <form action="login.php" method="post" name="logForm" id="logForm" >
        <table width="65%" border="0" cellpadding="4" cellspacing="4" class="loginform">
          <tr> 
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr> 
            <td width="28%">Username / Email</td>
            <td width="72%"><input name="usr_email" type="text" class="required" id="txtbox" size="25"></td>
          </tr>
          <tr> 
            <td>Password</td>
            <td><input name="pwd" type="password" class="required password" id="txtbox" size="25"></td>
          </tr>
          <tr> 
            <td colspan="2"><div align="center">
                <input name="remember" type="checkbox" id="remember" value="1">
                Remember me</div></td>
          </tr>
          <tr> 
            <td colspan="2"> <div align="center"> 
                <p> 
                  <input name="doLogin" type="submit" id="doLogin3" value="Login">
                </p>
                <p><a href="register.php">Register Free</a><font color="#FF6600"> 
                  |</font> <a href="../common/forgot.php">Forgot Password</a> <font color="#FF6600"> 
                  </font></p>
<!--                <p><span style="font: normal 9px verdana">Powered by <a href="http://php-login-script.com">PHP 
                  Login Script v2.3</a></span></p>
-->              </div></td>
          </tr>
        </table>
        <div align="center"></div>
        <p align="center">&nbsp; </p>
      </form>
      <p>&nbsp;</p>
	   
      </td>
    <td width="196" valign="top">&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="3">&nbsp;</td>
  </tr>
</table>

</body>
</html>
