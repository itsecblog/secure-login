<?php

if (isset($_POST['username'])) 
{ 
	/* An dieser Stelle Gültigkeit der übergebenen Strings prüfen */ 

	require("../config.php");

	$stmt = $dbconnect->prepare("DELETE FROM sl_cache WHERE timestamp < (NOW() - INTERVAL 1 DAY)");
	$stmt->execute();

	$stmt = $dbconnect->prepare("SELECT salt FROM sl_user WHERE username=?");
	$stmt->bind_param("s", $_POST['username']);
	$stmt->execute();

	$result = $stmt->get_result();

	if ($result->num_rows == 1) 
	{ 

		$row = mysqli_fetch_assoc($result);
		echo "$2a$13$" . $row['salt'];


	}
	else
	{

		$stmt = $dbconnect->prepare("SELECT salt FROM sl_cache WHERE username=?");
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
			$base = password_hash ('not-random', PASSWORD_BCRYPT, $options);
    			$salt = "$2a$13$" . substr($base, 7, 22);

			$stmt = $dbconnect->prepare("INSERT INTO sl_cache (username, salt) VALUES (?, ?)");
			$stmt->bind_param("ss", $_POST['username'], $salt);
			$stmt->execute();

			echo $salt;

		}


	}

}

?>
