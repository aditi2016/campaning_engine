<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 6/18/16
 * Time: 9:58 AM
 */

/*SELECT STATUS , count( * )
FROM `campaning_logs`
WHERE `campaning_id` =10
GROUP BY STATUS */

require_once "../library/sendEmail.php";
require_once "../library/sms.php";
require_once "../config/db_connection.php";


$sql = "SELECT STATUS , count( * )
FROM `campaning_logs`
WHERE `campaning_id` =10
GROUP BY STATUS";
$result = mysqli_query($db, $sql);

for($costsArr = array(); $cost = mysqli_fetch_assoc($result); $costsArr[] = $cost);



sendMail("rahul_lahoria@yahoo.com", "camp report", json_encode($costsArr));