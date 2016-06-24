<?php

	session_start();
	echo "Logout erfolgreich, Sie werden weitergeleitet...!";
	session_destroy();
	echo '<meta http-equiv="refresh" content="2; url=./login.php">';


?>
