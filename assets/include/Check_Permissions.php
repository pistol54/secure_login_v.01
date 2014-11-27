<?php

	function Check_Permissions() {
			if (isset($_SESSION["isLoggedIn"])) {
				if(!$_SESSION["isLoggedIn"]==1)  {
					// not logged in
					$search = false;
					return (false);
				}
				else if (!isset($_SESSION['user_name']))  {
					$search = false;
					return (false);
				// no username , again not logged in. Reset $_SESSION["isLoggedIn"] to 0
				$_SESSION["isLoggedIn"] = 0;
				} 
				else {
					$search = true;
					return (true);
				}
			}
			else {
				$search = false;
				return (false);
			}
	}
?>
