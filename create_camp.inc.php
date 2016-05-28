<?php 

	$emails =  $_POST['email'];
$name = $_POST ['name'];
$name = $_POST ['area'];
$name = $_POST ['type'];
$name = $_POST ['days'];

	
	
	
	$db = mysqli_connect("127.0.0.1","root","REDHAT","campaning_engine");

	if($_SERVER["REQUEST_METHOD"] == "POST") { //checking that if method is post
	      
	      foreach ($emails as $email){
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
<title> create Campaning</title>
</head>
<body>

<?php require_once "includes/header.inc.php"; ?>

<centre>
<h2>
CREATE CAMPANIN
</h2>

<form method="post">

                        first name <textarea name="enter name" cols="50" rows="1">
</textarea><br/>

                     last name :   <textarea name="last name" cols="50" rows="1">
</textarea><br/>

                     email        <textarea name="email" cols="50" rows="1">
</textarea><br/>

                     area         <textarea name="enter city" cols="50" rows="1">
</textarea><br/>

                     type         <textarea name="emails" cols="50" rows="1">
</textarea><br/>



<input type="submit" name="post_emails" value="Submit it!"  />

</form>

</centre>

</body>
</html>

</body>
</html>
