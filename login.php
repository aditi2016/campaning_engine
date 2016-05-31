<?php
	$username =  $_POST['username'];
	$password = $_POST['password'];

                        $db = mysqli_connect("127.0.0.1","root","REDHAT","campaning_engine");

	if($_SERVER["REQUEST_METHOD"] == "POST") { //checking that if method is post
	      // username and password sent from form 

	      
	      $username = mysqli_real_escape_string($db,$username);//clear the data
	      $password = mysqli_real_escape_string($db,$password);


	      $sql = "SELECT id FROM users WHERE username = '$username' and password = '$password'";
	      $result = mysqli_query($db,$sql); //user the execute mysql queries
	      $count = mysqli_num_rows($result); //counting number of rows
	      

	      
              // If result matched $myusername and $mypassword, table row must be 1 row
		
	      if($count == 1) {
		          
		 header("location: sms_camp.php"); // will relocate to specified location
	      }else {
		 $error = "<center>Your Login Name or Password is invalid</center>";
	      }


	}

	echo $error ;
?>
<html>
<head>
<title>login page</title>
</head>
<body>
<center>
	 <form method="post" action="#">
	  Username:
	  <input type="text" name="username" /><br/>
	  Password:
  		<input type="password" name="password"><br/>
	<input type="submit" name="login" value="Login"/>
	</form> 
</center>
</body>
</html>
