
<html>
<head><h1>
<b>CAMPANING ENGINE</b></h1>
<style>
.inputgroup{
max-width:200px;
margin:50px;
}
.inputfield{
float:right;
margin-right:40em;
width:150px;
}
</style>
</head>
<body>  

<?php



 {
if($_SERVER["REQUEST_METHOD"] == "POST") {
	
  $name =  $_POST['name'];
   $type = $_POST['type'];
 $area = $_POST['city'];
  $days = $_POST['number'];
  $sms_count = $_POST['number'];
 $sms_body = $_POST['text'];
$email_subject = $_POST['text'];
 $email_count = $_POST['number'];
 $email_body = $_POST['text'];
  $creation_dateime = $_POST['date'];
  $message_count = $_POST['number'];
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
}
$db = mysqli_connect("127.0.0.1","root","REDHAT","campaning_engine");
?>

<I><h2>CREATE CAMPANING</h2></I>
<form method="post" > 
  <div><span class="inputgroup"> Name: </span><input type="text" class="inputfield" name="name">
  </div><br><br>

 <div><span class= "inputgroup" >   TYPE:</span>
  <input type="radio" name="campain type" value="sms">sms
  <input type="radio" name="campain type" value="email">email
 <input type="radio" name="campain type" value="email">both
 </div> <br><br>
  

 <div ><span class= "inputgroup" > AREA:</span>
  <input type="radio" name="area" value="in record">known
  <input type="radio" name="area" value="not in record">unknown


<textarea name="area" rows="1" cols="10"></textarea>
 </div>   <br><br>
<div ><span class= "inputgroup" >days: <input type="text"  class="inputfield" name="number">
 <div><span class= "inputgroup" > sms count: <input type="text"  class="inputfield" name="count">
  </span></div><br><br>
  </span></div><br><br>
 <div><span class= "inputgroup" > sms text:</span> <textarea name="comment" rows="5" cols="40"></textarea>
 </div><br><br>
<div><span class= "inputgroup" >creation date: <input type="text"  class="inputfield" name="date">
 </span> </div><br><br>
<div><span class= "inputgroup" >message count: <input type="text"  class="inputfield" name="count">
  </span></div><br><br>
 <div><span class= "inputgroup" > email count: <input type="text"  class="inputfield" name="count">
  </span></div><br><br>
 <div><span class= "inputgroup" > email subject: <input type="text"  class="inputfield" name="count">
  </span></div><br><br>
 <div><span class= "inputgroup" > email body:</span> <textarea name="comment" rows="5" cols="40"></textarea>
 </div><br><br>
<center>
  <input type="submit" name="submit" value="Submit">  
</center>
</form>



</body>
</html>
