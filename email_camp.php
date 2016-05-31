<?php

require_once "config/db_connection.php";

	$emails =  $_POST['emails'];
	
	$emailsArray = explode(";", $emails);


	if($_SERVER["REQUEST_METHOD"] == "POST") { //checking that if method is post
	      
	      foreach ($emailsArray as $email){
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			  	$sql = "INSERT INTO emails (email,creation) VALUES('".$email."','".date("Y-m-d H:i:s")."');";
				$result = mysqli_query($db,$sql); //user the execute mysql queries
			}
			else 
				echo "INVALID: ".$email. " <br/>";
	      
	  	}
	      


	}

	


?>
<html>
<head>
<title>Email Campaning</title>
</head>
<body>

<?php require_once "includes/header.inc.php"; ?>

<center>
<h2>
Insert Emails
</h2>

<form method="post">
Add emails:<i>(you can add multiple emails ; seperated)</i><br/>
<textarea name="emails" cols="100" rows="20">
</textarea><br/>

<input type="submit" name="post_emails" value="Submit it!" />
</form>
</center>

</body>
</html>
