<?php
	require_once ('Check_Permissions.php');
//require_once ('assets/include/checktimming.php');
?>
	<nav class="navbar navbar-default main" role="navigation">

<!--    <div class="dropdown">
-->      <ul class="menu" role="menu" >
      	<li class="active"><a href="../index.php">Home</a></li>
<?php
/* 		if ((!$_SESSION["isLoggedIn"] == 1) || (!isset($_SESSION["user_name"]))) { */ 
		if (isset($_SESSION["isLoggedIn"])) {
// 		if (!$_SESSION["isLoggedIn"] == 1)  {  
?>     
        <li><a href="../login/login.php">Login</a> </li>
<?php
		$search = false;
?>
<?php
		if (isset($_SESSION['user_level'])) {
		if ($results = Check_Permissions() && ($_SESSION['user_level'] == ADMIN_LEVEL)) {
			$search = true;
			echo'<script src="../assets/js/ajax_v0.01.js"></script>';
?>
        <li ><a href="../admin/admin.php">Admin</a></li>
        <li ><a href="../common/mysettings.php">Setting</a></li>
<!--       <a class="dropdown-toggle" id="dropdownMenu1" href="#">Admin</a><br />
      <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
       <li class="active"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
        <li role="presentation" class="divider"></li>
        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
     </ul>
--> 		
<?php
		} else
	if ($results = Check_Permissions()) {
			$search = true;
			echo'<script src="../assets/js/ajax_v0.01.js"></script>';
?>
        <li ><a href="common/mysettings.php">Setting</a></li>
<!--      <a class="dropdown-toggle" id="dropdownMenu1" href="#">droppdown-triggar</a>
      <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
        <li role="presentation" class="divider"></li>
        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
      </ul>
-->
 <?php
	}		
		}
		else {
		?>
        <li><a href="../login/register.php">Register</a></li> 
<!--        <li><a href="install/install.php">Install Tables</a></li>
        <li><a href="GeoLocation/index.php">GeoLocate</a></li>
-->        <?php
		}
		}
		else {
		?>
        <li><a href="login/login.php">Login</a> </li>
        <li><a href="login/register.php">Register</a></li> 
        <?php
		}
		?>
        </ul>
<!--    </div>
-->    </nav>				
