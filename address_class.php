<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 6/24/16
 * Time: 12:19 PM
 */

require_once "config/db_connection.php";

if(isset($_GET['id'])){

    $sql = "update words set type = '".$_GET['type']."' WHERE id = '".$_GET['id']."'" ;

    mysqli_query($db, $sql);

}

session_start();
if (!isset($_SESSION['user_id']))
    header("location: login.php");

$userID = $_SESSION['user_id'];




$sql = "SELECT * FROM `words` WHERE type = 'new'" ;
$result = mysqli_query($db, $sql);

while ($word = mysqli_fetch_assoc($result)){

    echo $word['word']
        . "<a href='address_class.php?id=".$word['id']."&type=economic' >economic</a>"
        . "<a href='address_class.php?id=".$word['id']."&type=business' >business</a><br/>";



}