<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 5/31/16
 * Time: 12:23 AM
 */

$CampaningID = $_GET['c'];
$campaningLogId = $_GET['l'];

$db = mysqli_connect("127.0.0.1", "root", "redhat@11111p", "campaning_engine");


$CampaningID = mysqli_real_escape_string($db, $CampaningID);//clear the data
$campaningLogId = mysqli_real_escape_string($db, $campaningLogId);


$sql = "SELECT * FROM campanig WHERE id = '$CampaningID' ";
$result = mysqli_query($db, $sql);

$campDetails = mysqli_fetch_assoc($result);
$forwardURL = $details['forward_url'];


//updating the logs
$sql = "SELECT * FROM campanig WHERE id = '$CampaningID' ";
$result = mysqli_query($db, $sql);



$count = mysqli_num_rows($result); //counting number of rows

// If result matched $myusername and $mypassword, table row must be 1 row

if ($count == 1) {

    header("location: sms_camp.php"); // will relocate to specified location
} else {
    $error = "<center>Your Login Name or Password is invalid</center>";
}


