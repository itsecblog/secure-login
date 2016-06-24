<html>
 
<meta http-equiv="Content-Type" content="text/html;charset=windows-1252" >
 
<head>
 
    <script src="./include/bCrypt.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="./include/style.css"> 
 
    <script type="text/javascript">
 
    function result(hash){    
        $("#password").val(hash);
        $("#pwdForm").submit();
    }
 
    function crypt()
    {

	document.getElementById("pwdForm").style.display="none";
	document.getElementById("wait").style.display="block";
 
        if($("#password").val().length < 10)
        {
                alert('Password may not be shorter than 10 chars.');
		document.getElementById("pwdForm").style.display="block";
		document.getElementById("wait").style.display="none";
                return;
        }
     
        // Weitere Checks ausführen
     
        var salt;
        try
        {
                salt = gensalt(13);
        }
        catch(err) 
        {
                alert(err);
		document.getElementById("pwdForm").style.display="block";
		document.getElementById("wait").style.display="none";
                return;
        }
     
        try
        {
            hashpw($("#password").val(), salt, result);
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

    	<form id='pwdForm' action='./include/do-register.php' method='post'>
		<center><h2>Create Account</h2></center><br />
        	<label for="username">Username: </label><input size=30 type="text" name="username" id="username"></input>
        	<br />
        	<label for="password">Password: </label><input size=30 type="password" name="password" id="password"></input>
		<br />	<br />	
        	<INPUT TYPE="button" class="button" value="Register" onClick="crypt()"/>
    	</form>
 
	<form style="display: none" id='wait'>
		<br /><br /><center>Please wait...</center><br />
	</form>

</body>
</html>
