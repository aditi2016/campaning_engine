<?php
$db_handle = mysqli_connect("localhost","root","redhat@11111p","gmail_mailer");

if(isset($_GET['getActive'])){
	$result = mysqli_query($db_handle,"select * from users where status = 'active';");

	
	for($costsArr = array(); $cost = mysqli_fetch_assoc($result); $costsArr[] = $cost);

	$noOfActiveEmails = count($costsArr);
	//echo $noOfActiveEmails;
	if ($noOfActiveEmails == 0 ) return false;
    
    $emailNo = rand(0, $noOfActiveEmails-1);
    $costsArr[$emailNo]['sleep'] = 300/$noOfActiveEmails;
    echo json_encode( $costsArr[$emailNo]);
    exit;
}

if(isset($_GET['changeStatus']) && isset($_GET['id']) ){

	$sql = "update users set status = '".$_GET['changeStatus']."' where id = ".$_GET['id'].";";
	mysqli_query($db_handle,$sql);

}

session_start();
if (!isset($_SESSION['user_id']))
    header("location: login.php");

$userID = $_SESSION['user_id'];



$result = mysqli_query($db_handle,"select * from users where status = 'in-active';");



while($row = mysqli_fetch_assoc($result)){

	echo $row['username']. " status: in-active <a href=\"?changeStatus=active&id=".$row['id']."\">Activate</a><br/>";  


}

mysqli_close($db_handle);
?>