<?php

session_start();

if ((isset($_POST['username'])) && (isset($_POST['password'])))
{ 

	/* An dieser Stelle Gültigkeit der übergebenen Strings prüfen */ 

	if ((trim($_POST['username']) == '') || (trim($_POST['password']) == '')) 
	{
		echo "Authentication failed, redirecting...";
		session_destroy();
		echo '<meta http-equiv="refresh" content="2; url=../login.php">';
		exit;

	}

	require("../config.php");

	$stmt = $dbconnect->prepare("SELECT id, password FROM user WHERE username=?");
	$stmt->bind_param("s", $_POST['username']);
	$stmt->execute();

	$result = $stmt->get_result();

	if ($result->num_rows == 1)
	{ 

		$row = mysqli_fetch_assoc($result);

		if (password_verify($_POST['password'], $row['password']))
		{
			echo "Authentication successfully, redirecting...";
			$_SESSION['username'] = $_POST['username'];
			echo '<meta http-equiv="refresh" content="2; url=../../index.php">';	
		}
		else
		{

			echo "Authentication failed, redirecting...";
			session_destroy();
			echo '<meta http-equiv="refresh" content="2; url=../login.php">';

		}


	}
	else
	{

		echo "Authentication failed, redirecting...";
		session_destroy();
		echo '<meta http-equiv="refresh" content="2; url=../login.php">';

	}

}
else
{
	echo "Authentication failed, redirecting...";
	session_destroy();
	echo '<meta http-equiv="refresh" content="2; url=../login.php">';
}

?>
