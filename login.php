<?php

session_start();

if (isset($_SESSION['user_id']))
    header("location: sms_camp.php");

require_once "config/db_connection.php";

$username = $_POST['username'];
$password = $_POST['password'];


if ($_SERVER["REQUEST_METHOD"] == "POST") { //checking that if method is post
    // username and password sent from form

    $username = mysqli_real_escape_string($db, $username);//clear the data
    $password = mysqli_real_escape_string($db, $password);


    $sql = "SELECT id FROM users WHERE username = '$username' and password = '$password'";
    $result = mysqli_query($db, $sql); //user the execute mysql queries

    $userDetails = mysqli_fetch_assoc($result);
    $userID = $userDetails['id'];


    $count = mysqli_num_rows($result); //counting number of rows

    // If result matched $myusername and $mypassword, table row must be 1 row

    if ($count == 1) {
        $_SESSION['user_id'] = $userID;
        header("location: sms_camp.php"); // will relocate to specified location
    } else {

        alert("fo");
    }
}


?>

<html>
<head>
    <title>login page</title>
</head>
<body>
<div style="text-align: center;">
    <img class="raleway-logo" src="http://shatkonlabs.com/images/logo.png">
    <h1>Shatkon Labs Pvt. Ltd.</h1>
    <form method="post" action="#">
        Username:
        <input type="text" name="username"/><br/>
        Password:
        <input type="password" name="password"><br/>
        <input type="submit" name="login" value="Login"/ >
        <br/>
    </form>
    <h4><i> if you have any problem contact at rahul@shatkonlabs.com or Call at 9599075955 </i></h4>
</div>
</body>
</html>