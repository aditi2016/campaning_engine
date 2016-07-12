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
$ignore = mysqli_query($db, "SELECT id FROM `words` WHERE type = 'ignore'");
$ignorecount = mysqli_num_rows($ignore);

$business = mysqli_query($db, "SELECT id FROM `words` WHERE type = 'business'");
$businesscount = mysqli_num_rows($business);

$economic = mysqli_query($db, "SELECT id FROM `words` WHERE type = 'economic'");
$economiccount = mysqli_num_rows($economic);

echo "Economic :".$economiccount."<br/>Business :".$businesscount."<br/>Ignore :".$ignorecount."<br/>";


if(isset($_GET['id'])){

    $sql = "update words set type = '".$_GET['type']."' WHERE id = '".$_GET['id']."'" ;

    mysqli_query($db, $sql);
    header("Location:address_class.php");
}
else {
	$sql = "SELECT * FROM `words` WHERE type = 'new' limit 0,100" ;
	$result = mysqli_query($db, $sql);
//$data=mysql_fetch_assoc($result);
//echo $data['total'];

	while ($word = mysqli_fetch_assoc($result)){

	    echo $word['word']
	        . "&nbsp &nbsp &nbsp <a href='address_class.php?id=".$word['id']."&type=economic' >economic</a> &nbsp &nbsp &nbsp"
	        . "<a href='address_class.php?id=".$word['id']."&type=business' >business</a>&nbsp &nbsp &nbsp "
	        . "<a href='address_class.php?id=".$word['id']."&type=ignore' >Ignore</a><br/> ";
	}
}