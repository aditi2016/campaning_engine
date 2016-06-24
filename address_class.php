<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 6/24/16
 * Time: 12:19 PM
 */

session_start();
if (!isset($_SESSION['user_id']))
    header("location: login.php");

$userID = $_SESSION['user_id'];


require_once "config/db_connection.php";

$sql = "SELECT * FROM `words` WHERE type = 'new'" ;
$result = mysqli_query($db, $sql);

while ($word = mysqli_fetch_assoc($result)){



}