<html>

<meta http-equiv="Content-Type" content="text/html;charset=windows-1252" >

<head>

	<script src="./include/bCrypt.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="./include/style.css"> 

	<script type="text/javascript">

	var salt = "";

	function result(hash){	  
		$("#password").val(hash);
	  	$("#pwdForm").submit();
	}

	function prepareLogin()
	{

		$salt = "";

		document.getElementById("pwdForm").style.display="none";
		document.getElementById("wait").style.display="block";

		ajax = new XMLHttpRequest();
    		if(ajax!=null)
		{
			ajax.open("POST","./include/get-salt.php",true);
			ajax.onreadystatechange = function()
			{
				if(this.readyState == 4)
				{
					if(this.status == 200)
					{
						if(this.responseText != '')
						{
							$salt = this.responseText;	
							login();
						}
					}
				}
			
			}
			var postdata= 'username='+$("#username").val();

			ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			ajax.setRequestHeader("Content-length", postdata.length);

			ajax.send(postdata);
		}
    		else
		{
			alert("Your browser does not support Ajax.");
			document.getElementById("pwdForm").style.display="block";
			document.getElementById("wait").style.display="none";
    		}
	}

	function login()
	{
	
		try
		{
			hashpw($("#password").val(), $salt, result);
		} 
		catch(err) 
		{
	    		alert(err);
			document.getElementById("pwdForm").style.display="block";
			document.getElementById("wait").style.display="none";
	    		return;
		}

	}

	</script>

</head>
<body>
	
	<form id='pwdForm' action='./include/do-login.php' method='post'>
		<center><h2>Please Login</h2></center><br />
		<label for="username">Username: </label><input size=30 type="text" name="username" id="username"></input>
		<br />
		<label for="password">Password: </label><input size=30 type="password" name="password" id="password"></input>
		<br />	<br />		
		<INPUT TYPE="button" id="button" class="button" value="Login" onClick="prepareLogin()"/><br />
		<center><a href="./register.php">Create Account</a></center>
	</form>

	<form style="display: none" id='wait'>
		<br /><br /><center>Please wait...</center><br />
	</form>


</body>
</html>
