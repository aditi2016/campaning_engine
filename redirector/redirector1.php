<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 5/31/16
 * Time: 12:23 AM
 */

$CampaningID = $_GET['c'];
$campaningLogId = $_GET['l'];




$CampaningID = mysqli_real_escape_string($db, $CampaningID);//clear the data
$campaningLogId = mysqli_real_escape_string($db, $campaningLogId);


$sql = "SELECT * FROM campaning WHERE id = '$CampaningID' ";
$result = mysqli_query($db, $sql);

$campDetails = mysqli_fetch_assoc($result);
$forwardURL = $details['forward_url'];


//updating the logs
$sql = "SELECT * FROM campaning WHERE id = '$CampaningID' ";
$result = mysqli_query($db, $sql);



$count = mysqli_num_rows($result); //counting number of rows

// If result matched $myusername and $mypassword, table row must be 1 row


header("location: $forwardURL"); // will relocate to specified location



