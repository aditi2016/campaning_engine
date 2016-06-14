<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 6/14/16
 * Time: 11:19 AM
 */

require_once "config/db_connection.php";


$sql = "SELECT distinct name,email,mobile from mobac.contacts where 1 ";
$result = mysqli_query($db, $sql);

//doing campaigning first time
while($email = mysqli_fetch_assoc($result)){

    mysqli_query($db, "INSERT INTO `campaning_engine`.`emails`
                (`id`, `email`, `name`, `area`, `creation`, `user_id`)
                VALUES
                (NULL, '".$email['email']."', '".$email['name']."', '', '" . date("Y-m-d H:i:s") . "',  '0');");

    mysqli_query($db, "INSERT INTO `campaning_engine`.`mobiles`
                (`id`, `mobile`, `name`, `area`, `creation`, `user_id`)
                VALUES
                (NULL, '".$email['mobile']."', '".$email['name']."', '', '" . date("Y-m-d H:i:s") . "',  '0');");

}