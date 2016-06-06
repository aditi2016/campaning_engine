<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 5/31/16
 * Time: 12:21 AM
 */

require_once "../library/sendEmail.php";
require_once "../library/sms.php";
//getting new starting campanings
//SELECT * FROM `campaning` WHERE `id` not in (select distinct campaning_id from campaning_logs where 1)

$sql = "SELECT * FROM `campaning` WHERE `id` not in (select distinct campaning_id from campaning_logs where 1) ";
$result = mysqli_query($db, $sql);

//doing campaigning first time
while($camp = mysqli_fetch_assoc($result)){

    //this should be inside try and catch if campaigning fails dude to of some reason that could be accounted

    //getting emails
    // SELECT * FROM `emails` LIMIT 0 , 30

    $sql = "SELECT * FROM `emails` LIMIT 0 , ".camp['email_count'];
    $result = mysqli_query($db, $sql);

    while($email = mysqli_fetch_assoc($result)){


        sendMail($email['email'], $camp['email_subject'], $camp['email_body']);

    }


        //sending emails
    //getting mobiles
        //sending sms





}