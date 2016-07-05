<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 6/20/16
 * Time: 8:17 PM
 */

require_once "../config/db_connection.php";

function verifyEmail($toemail, $fromemail, $getdetails = false){
    $details = "";
    $email_arr = explode("@", $toemail);
    $domain = array_slice($email_arr, -1);
    $domain = $domain[0];
    // Trim [ and ] from beginning and end of domain string, respectively
    $domain = ltrim($domain, "[");
    $domain = rtrim($domain, "]");
    if( "IPv6:" == substr($domain, 0, strlen("IPv6:")) ) {
        $domain = substr($domain, strlen("IPv6") + 1);
    }
    $mxhosts = array();
    if( filter_var($domain, FILTER_VALIDATE_IP) )
        $mx_ip = $domain;
    else
        getmxrr($domain, $mxhosts, $mxweight);
    if(!empty($mxhosts) )
        $mx_ip = $mxhosts[array_search(min($mxweight), $mxhosts)];
    else {
        if( filter_var($domain, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) ) {
            $record_a = dns_get_record($domain, DNS_A);
        }
        elseif( filter_var($domain, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) ) {
            $record_a = dns_get_record($domain, DNS_AAAA);
        }
        if( !empty($record_a) )
            $mx_ip = $record_a[0]['ip'];
        else {
            $result   = "invalid";
            $details .= "No suitable MX records found.";
            return ( (true == $getdetails) ? array($result, $details) : $result );
        }
    }


    $connect = @fsockopen($mx_ip, 25);
    if($connect){
        if(preg_match("/^220/i", $out = fgets($connect, 1024))){
            fputs ($connect , "HELO $mx_ip\r\n");

            $out = fgets ($connect, 1024);
            $details .= $out."\n";

            fputs ($connect , "MAIL FROM: <$fromemail>\r\n");
            $from = fgets ($connect, 1024);
            $details .= $from."\n";
            fputs ($connect , "RCPT TO: <$toemail>\r\n");
            $to = fgets ($connect, 1024);
            $details .= $to."\n";
            fputs ($connect , "QUIT");
            fclose($connect);
            if(!preg_match("/^250/i", $from) || !preg_match("/^250/i", $to)){
                $result = "invalid";
            }
            else{
                $result = "valid";
            }
        }
    }
    else{
        $result = "invalid";
        $details .= "Could not connect to server";
    }
    if($getdetails){
        return array($result, $details);
    }
    else{
        return $result;
    }
}

$sql = "SELECT * FROM `emails` WHERE status = 'new'" ;
$result = mysqli_query($db, $sql);

while ($email = mysqli_fetch_assoc($result)){

    $newStatus = verifyEmail($email['email'], "info@blueteam.in");

    echo $email['email'] . " is ". $newStatus ."\n";

    $sql = "UPDATE `campaning_engine`.`emails` SET `status` = '".$newStatus."' WHERE `emails`.`id` = " . $email['id'] . ";";
    $r = mysqli_query($db, $sql);


}