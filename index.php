<?php

session_start();
 
if (isset($_SESSION['username'])) 
{
   	echo "Herzlich Willkommen " . $_SESSION['username'];
	echo "<br /><br />";
   	echo "<a href=\"./logout.php\">Abmelden</a>";
} 
else 
{
	echo "Bitte erst einloggen";
  	echo '<meta http-equiv="refresh" content="2; url=./login.html">';
}

?>
