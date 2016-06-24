<?php

if ((isset($_POST['username'])) && (isset($_POST['password'])))
{ 

	session_start();

	/* An dieser Stelle Gültigkeit der übergebenen Strings prüfen */ 

	if (trim($_POST['username']) == '') 
	{
		echo "Login fehlgeschlagen, Sie werden weitergeleitet..!";
		session_destroy();
		echo '<meta http-equiv="refresh" content="2; url=./login.html">';
		exit;

	}

	$dbconnect = new mysqli('host', 'username', 'password', 'database');

	$stmt = $dbconnect->prepare("SELECT id FROM user WHERE username=? AND password=?");
	$stmt->bind_param("ss", $_POST['username'], $_POST['password']);
	$stmt->execute();

	$result = $stmt->get_result();

	if ($result->num_rows == 1) 
	{ 

		echo "Login erfolgreich,  Sie werden weitergeleitet...!";
		$_SESSION['username'] = $_POST['username'];
		echo '<meta http-equiv="refresh" content="2; url=./index.php">';

	}
	else
	{

		echo "Login fehlgeschlagen, Sie werden weitergeleitet...!";
		session_destroy();
		echo '<meta http-equiv="refresh" content="2; url=./login.html">';

	}

}
else
{
	echo "Login fehlgeschlagen, Sie werden weitergeleitet...!";
	session_destroy();
	echo '<meta http-equiv="refresh" content="2; url=./login.html">';
}

?>
