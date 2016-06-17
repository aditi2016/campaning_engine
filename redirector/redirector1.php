<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 5/31/16
 * Time: 12:23 AM
 */
// example url: http://shatkonlabs.com/d-2
require_once "../library/os_finder.php";

$db = mysqli_connect("127.0.0.1", "root", "redhat@11111p", "campaning_engine");

$header = json_encode($_SERVER);
$url = $_SERVER[REQUEST_URI];
$os = getOS();
$ip = $_SERVER[REMOTE_ADDR];

$fist = explode("?", $_SERVER[REQUEST_URI   ]);
$route = explode("/", $fist[0]);
//var_dump($route);die();

$page = $route[1];
$details = explode("-", $page);

if($details[0] == "d") {
    $campaningLogId = $details[1];
    $campaningLogId = mysqli_real_escape_string($db, $campaningLogId);


//updating the logs
    $sql = "SELECT c.id as cid,c.forward_url,cl.type, cl.mobile_email_id FROM campaning_logs as cl join campaning as c WHERE cl.id = '$campaningLogId' and cl.campaning_id = c.id";

    $result = mysqli_query($db, $sql);

    $campDetails = mysqli_fetch_assoc($result);
    $forwardURL = $campDetails['forward_url'];

//insert in campaning log

    $sql = "UPDATE `campaning_engine`.`campaning_logs` SET `status` = 'clicked', ip = '" . $ip . "', os = '" . $os . "', header = '" . $header . "' WHERE `campaning_logs`.`id` = " . $campaningLogId . ";";
    $result = mysqli_query($db, $sql);


//insert into mobiles or emails
/*
    if ($campDetails['type'] == "sms") {


        $sql = "UPDATE `campaning_engine`.`mobiles` SET `status` = 'open', ip = '" . $ip . "', os = '" . $os . "', header = '" . $header . "' WHERE `mobiles`.`id` = " . $campDetails['mobile_email_id'] . ";";
        $result = mysqli_query($db, $sql);




    } else {

        $sql = "UPDATE `campaning_engine`.`emails` SET `end_time` = '" . $endTime . "' WHERE `emails`.`id` = " . $campDetails['mobile_email_id'] . ";";
        $result = mysqli_query($db, $sql);
    }*/


    header("location: $forwardURL"); // will relocate to specified location

    die();
//get user gps location
/*
 *  <script>
var x = document.getElementById("demo");
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}
function showPosition(position) {
    x.innerHTML = "Latitude: " + position.coords.latitude +
    "<br>Longitude: " + position.coords.longitude;
}
</script>
 *
 *
 * */
} elseif ($details[0] == "i") {

    $campaningLogId = $details[1];
    $campaningLogId = mysqli_real_escape_string($db, $campaningLogId);

//insert in campaning log

    $sql = "UPDATE `campaning_engine`.`campaning_logs` SET `status` = 'open', ip = '" . $ip . "', os = '" . $os . "', header = '" . $header . "' WHERE `campaning_logs`.`id` = " . $campaningLogId . ";";
    $result = mysqli_query($db, $sql);

    die();

}

