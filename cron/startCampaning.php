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
function putIMGUrl($text, $url){
    return str_replace("IMGSRC", $url, $text);
}

//geting url
function getIMGUrl($id){
    return "http://shatkonlabs.com/i-" . $id;
}

//get text with url
function getIMGText($id, $planText){
    return putIMGUrl($planText, getIMGUrl($id));
}


//replace url
function putUrl($text, $url){
    return str_replace("URL", $url, $text);
}

//geting url
function getUrl($id){
    return "http://shatkonlabs.com/d-" . $id;
}

//get text with url
function getText1($id, $planText){
    return getIMGText($id,putUrl($planText, getUrl($id)));
}


$sql = "SELECT * FROM `campaning` WHERE `id` not in (select distinct campaning_id from campaning_logs where 1) ";
$result = mysqli_query($db, $sql);

//doing campaigning first time
while ($camp = mysqli_fetch_assoc($result)) {

    //this should be inside try and catch if campaigning fails dude to of some reason that could be accounted
    //getting emails
    // SELECT * FROM `emails` LIMIT 0 , 30

    $sql = "SELECT * FROM `emails` LIMIT 0 , " . $camp['email_count'];
    $result = mysqli_query($db, $sql);

    while ($email = mysqli_fetch_assoc($result)) {

        //insert campaning_log

        $sql = "INSERT
                    INTO `campaning_engine`.`campaning_logs`
                    (`id`, `campaning_id`, `mobile_email_id`, `type`, `creation`, `status`)
                    VALUES (NULL, '" . $camp['id'] . "', '" . $email['id'] . "', 'email', '" . date("Y-m-d H:i:s") . "' , 'sent');";

        //echo $sql;
        $inserted = mysqli_query($db, $sql);
        $campLogId = mysqli_insert_id($db);

        sendMail($email['email'], $camp['email_subject'], getText1($campLogId, base64_decode($camp['email_body'])));
    }


    //sending emails= '.$camp['area']." '  //getting mobiles
    //sending sms sendSMS($to, $message)

    $sql = "SELECT * FROM `mobiles` where area = '" . $camp['area'] . "' LIMIT 0 , " . $camp['sms_count'];
    $result = mysqli_query($db, $sql);

    while ($mobile = mysqli_fetch_assoc($result)) {

        //generate url
        //generate sms_text

        //insert campaning_log
        $sql = "INSERT
                    INTO `campaning_engine`.`campaning_logs`
                    (`id`, `campaning_id`, `mobile_email_id`, `type`, `creation`, `status`)
                    VALUES (NULL, '" . $camp['id'] . "', '" . $mobile['id'] . "', 'sms', '" . date("Y-m-d H:i:s") . "' , 'sent');";

        $inserted = mysqli_query($db, $sql);
        $campLogId = mysqli_insert_id($db);

        sendSMS($mobile['mobile'], getText1($campLogId, $camp['sms_text']));

    }


    sendMail("rahul_lahoria@yahoo.com", "camp got over", json_encode($camp));

}