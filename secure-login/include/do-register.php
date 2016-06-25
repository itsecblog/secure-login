<?php

if(isset($_POST['username']) && isset($_POST['password'])) 
{ 
	/* An dieser Stelle Gültigkeit der übergebenen Strings prüfen */ 

	require("../config.php");

	$stmt = $dbconnect->prepare("SELECT id FROM sl_user WHERE username=?");
	$stmt->bind_param("s", $_POST['username']);
	$stmt->execute();

	$result = $stmt->get_result();

	if ($result->num_rows > 0) 
	{ 

		echo "Could not create user, redirecting...";

		echo '<meta http-equiv="refresh" content="2; url=../register.php">';

	}
	else
	{
		if ((trim($_POST['username']) != '') && (trim($_POST['password']) != ''))
		{

			$salt = substr($_POST['password'], 7, 28); 

			$options = [
    				'cost' => 13,
			];
 			$hash = password_hash($_POST['password'], PASSWORD_BCRYPT, $options);

			$stmt = $dbconnect->prepare("INSERT INTO sl_user (username, password, salt) VALUES (?, ?, ?)");
			$stmt->bind_param("sss", $_POST['username'], $hash, $salt);
			$stmt->execute();

			echo "Sucessfully created user, redirecting...";
	
			echo '<meta http-equiv="refresh" content="2; url=../login.php">';
		}
		else
		{

			echo "Could not create user, redirecting...";

			echo '<meta http-equiv="refresh" content="2; url=../register.php">';

		}

	}

}

?>
