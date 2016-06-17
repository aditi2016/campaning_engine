<?php
session_start();
if (!isset($_SESSION['user_id']))
    header("location: login.php");

$userID = $_SESSION['user_id'];


require_once "config/db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $type = $_POST['campain_type'];
    $area = $_POST['area'];
    $forwardUrl = $_POST['forward_url'];
    $days = $_POST['days'];
    $smsCount = $_POST['sms_count'];
    $smsBody = $_POST['sms_text'];
    $emailSubject = $_POST['email_subject'];
    $emailCount = $_POST['email_count'];
    $emailBody = base64_encode($_POST['email_body']);


    $sql = "INSERT INTO campaning
			(
			name,
			creation,
			type,
			area,
			days,
			sms_count,
			sms_text,
			email_subject,
			email_count,
			email_body,
			forward_url,
			user_id
			)
		VALUES(
			'" . $name . "',
			'" . date("Y-m-d H:i:s") . "' ,
			'" . $type . "',
			'" . $area . "',
			'" . $days . "',
			'" . $smsCount . "',
			'" . $smsBody . "',
			'" . $emailSubject . "',
			'" . $emailCount . "' ,
			'" . $emailBody . "',
			'" . $forwardUrl . "',
			'" . $userID . "'
			);";
//echo $sql;
    $result = mysqli_query($db, $sql);

    $id = mysqli_insert_id($db);

    if($id == 0 ){
        echo  "Alert! Error occurred<br/>";
        echo("Error description: " . mysqli_error($db));
        die();
    }
}

?>

<html>
<head>
</head>
<body style="background-color:lightgrey;">


<center>
    <h1>
        <b>CAMPANING ENGINE</b></h1>
    <I>

        <h2 style="color:blue;"> CREATE CAMPANING </h2></I>

    <table width="10">

        <form method="post">

            <tr>
                <td> Name:
                <td/>
                <td><input type="text" name="name" required/>
                <td/>


            <tr>

                <td> Type:
                <td/>
                <td><input type="radio" name="campain_type" value="sms" required>sms
                    <input type="radio" name="campain_type" value="email">email
                    <input type="radio" name="campain_type" value="email">both
                <td/>
            <tr/>


            <tr>

                <td> Area:
                <td/>
                <td><input type="text" name="area" required/>
                <td/>
            <tr/>

            <tr>

                <td> Forward URL:
                <td/>
                <td><input type="text" name="forward_url" required/>
                <td/>
            <tr/>


            <tr>
                <td>Days:
                <td/>
                <td><input type="number" name="days" max="90" min="5" align="right" required>
                <td/>
            <tr/>


            <tr>

                <td> Sms Count:
                <td/>
                <td><input type="number" name="sms_count" required>
                <td/>
            <tr/>


            <tr>
                <td>Sms Text:
                <td/>
                <td><textarea name="sms_text" rows="5" cols="40" required></textarea>
                <td/>
            <tr/>
            <br/>

            <tr>
                <td>Email Count:
                <td/>
                <td><input type="number" name="email_count" required>
                <td/>
            <tr/>


            <tr>
                <td>Email Subject:
                <td/>
                <td><input type="text" name="email_subject" required>
                <td/>
            <tr/>
            <br/>

            <tr>


                <td>Email Body:
                <td/>
                <td><textarea name="email_body" rows="5" cols="40" required></textarea>
                <td/>
            <tr/>
            <br/>


            <td><input type="submit" name="submit" value="Submit">
            <td/>

            <form/>
            <table/>

            <center/>
</body>
<footer>
    <p>shatkonslabs</p>
    <p>sector-31,gurgaon.india <a href="blueteam.in">
        </a>.</p>
</footer>
</html>
