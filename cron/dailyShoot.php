<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 5/31/16
 * Time: 12:21 AM
 */

require_once "../library/sendEmail.php";
require_once "../library/sms.php";
require_once "../config/db_connection.php";


//getting new starting campanings
//SELECT * FROM `campaning` WHERE `id` not in (select distinct campaning_id from campaning_logs where 1)


//replace url
function putUrl($text, $url){
    return str_replace("URL", $url, $text);
}

//geting url
function getUrl($id){
    return "http://shatkonlabs.com/d-" . $id;
}

//get text with url
function getText($id, $planText){
    return putUrl($planText, getUrl($id));
}


$sql = "SELECT cl.id as id, cl.type, cl.mobile_email_id, c.email_subject, c.email_body, c.sms_text
            FROM campaning_logs as cl
              join campaning as c
            WHERE  cl.campaning_id = c.id and cl.status = 'sent'";

$result = mysqli_query($db, $sql);

//doing campaigning first time
while ($log = mysqli_fetch_assoc($result)) {

    $sql = "UPDATE `campaning_engine`.`campaning_logs` SET `last_update` = '" . date("Y-m-d H:i:s") . "' WHERE `campaning_logs`.`id` = " . $log['id'] . ";";
    $r = mysqli_query($db, $sql);

    if ($log['type'] == "sms") {

        $sql = "SELECT * FROM `mobiles` WHERE id = ".$log['mobile_email_id'];
        $mobileR = mysqli_query($db, $sql);
        $mobile = mysqli_fetch_assoc($emailR);

        sendSMS($mobile['mobile'], getText($log['id'], $log['sms_text']));

    } else {

        $sql = "SELECT * FROM `emails` WHERE id = ".$log['mobile_email_id'];
        $emailR = mysqli_query($db, $sql);
        $email = mysqli_fetch_assoc($emailR);

        sendMail($email['email'], $log['email_subject'], getText($log['id'], $log['email_body']));

    }

}