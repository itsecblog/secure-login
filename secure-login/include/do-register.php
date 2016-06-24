<?php

if(isset($_POST['username']) && isset($_POST['password'])) 
{ 
	/* An dieser Stelle Gültigkeit der übergebenen Strings prüfen */ 

	require("../config.php");

	$stmt = $dbconnect->prepare("SELECT id FROM user WHERE username=?");
	$stmt->bind_param("s", $_POST['username']);
	$stmt->execute();

	$result = $stmt->get_result();

	if ($result->num_rows > 0) 
	{ 

		echo "User konnte nicht angelegt werden, Sie werden weitergeleitet...";

		echo '<meta http-equiv="refresh" content="2; url=../register.php">';

	}
	else
	{
		if (trim($_POST['username']) != '') 
		{
			$stmt = $dbconnect->prepare("INSERT INTO user (username, password) VALUES (?, ?)");
			$stmt->bind_param("ss", $_POST['username'], $_POST['password']);
			$stmt->execute();

			echo "User erfolgreich angelegt, Sie werden weitergeleitet...";
	
			echo '<meta http-equiv="refresh" content="2; url=../login.php">';
		}
		else
		{

			echo "User konnte nicht angelegt werden, Sie werden weitergeleitet...";

			echo '<meta http-equiv="refresh" content="2; url=../register.php">';

		}

	}

}

?>
