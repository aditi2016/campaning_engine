<?php 
function phoneNumbervalidation($mobile)
{
 if(preg_match('/^((\+){0,1}91(\s){0,1}(\-){0,1}(\s){0,1})?([0-9]{10})$/', $mobile,$matches)){
 print_r($matches);
 return true;
 }
 else
 return false;
}
  

	$mobiles =  $_POST['mobiles'];
	
	$mobilesArray = explode(";", $mobiles);
	
	$db = mysqli_connect("127.0.0.1","root","redhat@11111p","campaning_engine");

	if($_SERVER["REQUEST_METHOD"] == "POST") { //checking that if method is post
	      
	      foreach ($mobilesArray as $mobile){
			if (phoneNumbervalidation($mobile)) {
			  	$sql = "INSERT INTO mobiles (mobile,creation) VALUES('".$mobile."','".date("Y-m-d H:i:s")."');";
				$result = mysqli_query($db,$sql); //user the execute mysql queries
			}
			else 
				echo "INVALID: ".$mobile. " <br/>";
	      
	  	}
	      


	}

	


?>
<html>
<head>
<title>SMS Campaning</title>
</head>
<body>

<?php require_once "includes/header.inc.php"; ?>

<center>
<h2>
Insert Emails
</h2>

<form method="post">
Add mobiles:<i>(you can add multiple mobiles ; seperated)</i><br/>
<textarea name="mobiles" cols="100" rows="20">
</textarea><br/>

<input type="submit" name="post_mobiles" value="Submit it!" />
</form>
</center>

</body>
</html>
