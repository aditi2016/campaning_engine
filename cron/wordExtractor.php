<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 6/24/16
 * Time: 12:31 PM
 */

require_once "../config/db_connection.php";


$sql = "SELECT * FROM `addresses` WHERE 1" ;
$result = mysqli_query($db, $sql);

while ($address = mysqli_fetch_assoc($result)){

    $words = explode(" ",$address['address']);

    foreach($words as $word){

        $sql = "INSERT INTO `campaning_engine`.`words` (`id`, `word`, `type`, `creation`) VALUES (NULL, '".$word."', 'new', CURRENT_TIMESTAMP);";
        mysqli_query($db, $sql);

    }


}

