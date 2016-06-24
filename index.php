<?php

session_start();

if (isset($_SESSION['username'])) 
{
   	echo "Welcome, " . $_SESSION['username'];
	echo "<br /><br />";
   	echo "<a href=\"./secure-login/logout.php\">Abmelden</a>";
} 
else 
{
	echo "Authentication missing, redirecting...";
  	echo "<meta http-equiv=\"refresh\" content=\"1; url=./secure-login/login.php\">";
}

?>
