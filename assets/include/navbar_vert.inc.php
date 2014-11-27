
<nav class="navbar navbar-default" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" >
    <ul class="nav nav-stacked">
      <li class="active"><a href="../index.php">Home</a></li>
<!--      <li><a href="#">Link</a></li>
-->      <li class="dropdown">
        <?php
        if (isset($_SESSION['human_page'])) {
        	if ($_SESSION['human_page']) {
        ?>
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Human Resources<b class="caret"></b></a>
        <ul class="dropdown-menu">
        	<li><a href="../Human_Resources/displayqueryemployees.php">Display Employees</a></li>
          	<li><a href="#">Add Employee</a></li>
          	<li><a href="#">Edit Employee</a></li>
          	<li><a href="#">Delete Employee</a></li>
          	<li class="divider"></li>
          	<li><a href="#">Separated link</a></li>
          	<li class="divider"></li>
          	<li><a href="#">One more separated link</a></li>
           <?php
			}
		
           else {
        	if (isset($_SESSION['project_page'])) {
        		if ($_SESSION['project_page']) {
        ?>
           <a href="#" class="dropdown-toggle" data-toggle="dropdown">Project_Management<b class="caret"></b></a>
           <ul class="dropdown-menu">
        	<li><a href="../Project_Management/displayprojects.php">Display Active Projects</a></li>
          	<li><a href="../Project_Management/Add_Project.php">Add Projects</a></li>
          	<li><a href="#">Edit Projects</a></li>
          	<li><a href="#">Delete Projects</a></li>
          	<li class="divider"></li>
          	<li><a href="#">Separated link</a></li>
          	<li class="divider"></li>
          	<li><a href="#">One more separated link</a></li>
 <?php 
 }
            }
            }
            }
?>
         
        </ul>
      </li>
    </ul>

  </div><!-- /.navbar-collapse -->
</nav>


