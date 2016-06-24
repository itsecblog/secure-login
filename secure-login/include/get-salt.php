<?php

if (isset($_POST['username'])) 
{ 
	/* An dieser Stelle Gültigkeit der übergebenen Strings prüfen */ 

	require("../config.php");

	$stmt = $dbconnect->prepare("DELETE FROM tmp_salts WHERE timestamp < (NOW() - INTERVAL 1 DAY)");
	$stmt->execute();

	$stmt = $dbconnect->prepare("SELECT password FROM user WHERE username=?");
	$stmt->bind_param("s", $_POST['username']);
	$stmt->execute();

	$result = $stmt->get_result();

	if ($result->num_rows == 1) 
	{ 

		$row = mysqli_fetch_assoc($result);
		echo substr($row['password'], 0, 29);
	}
	else
	{

		$stmt = $dbconnect->prepare("SELECT salt FROM tmp_salts WHERE username=?");
		$stmt->bind_param("s", $_POST['username']);
		$stmt->execute();

		$result = $stmt->get_result();

		if ($result->num_rows == 1) 
		{ 

			$row = mysqli_fetch_assoc($result);
			echo $row['salt'];
		}
		else
		{
	   		$options = [
  				'cost' => 13,
			];
			$base = password_hash ('', PASSWORD_BCRYPT, $options);
    			$salt = "$2a$13$" . substr($base, 8, 30);

			$stmt = $dbconnect->prepare("INSERT INTO tmp_salts (username, salt) VALUES (?, ?)");
			$stmt->bind_param("ss", $_POST['username'], $salt);
			$stmt->execute();

			echo $salt;

		}


	}

}

?>
