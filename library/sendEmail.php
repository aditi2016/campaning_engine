<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 6/6/16
 * Time: 8:17 AM
 */

function sendMail($to, $subject, $message)
{

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    $md5To = md5($to);
    // More headers
    $headers .= 'From: <'.$md5To.'@bounces.blueteam.in>' . "\r\n";
    //$headers .= 'Cc: myboss@example.com' . "\r\n";



    mail($to, $subject, $message, $headers, '-f '.$md5To.'@bounces.blueteam.in');
}