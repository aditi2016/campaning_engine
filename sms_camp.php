<?php

session_start();
if (!isset($_SESSION['user_id']))
    header("location: login.php");

$userID = $_SESSION['user_id'];

require_once "config/db_connection.php";


function phoneNumbervalidation($mobile)
{
    if (preg_match('/^((\+){0,1}91(\s){0,1}(\-){0,1}(\s){0,1})?([0-9]{10})$/', $mobile, $matches)) {
        print_r($matches);
        return true;
    } else
        return false;
}


$mobiles = $_POST['mobiles'];

$mobilesArray = explode(";", $mobiles);


if ($_SERVER["REQUEST_METHOD"] == "POST") { //checking that if method is post

    foreach ($mobilesArray as $mobile) {
        if (phoneNumbervalidation($mobile)) {
            $sql = "INSERT INTO mobiles (mobile,creation,user_id) VALUES('" . $mobile . "','" . date("Y-m-d H:i:s") . "','" . $userID . "');";
            $result = mysqli_query($db, $sql); //user the execute mysql queries
        } else
            echo "INVALID: " . $mobile . " <br/>";

    }


}


?>
<html>
<head>
    <title>SMS Campaning</title>
</head>
<body>

<?php require_once "includes/header.inc.php"; ?>

<center>
    <h2>
        Insert mobile numbers
    </h2>

    <form method="post">
        Add mobiles:<i>(you can add multiple mobiles ; seperated)</i><br/>
<textarea name="mobiles" cols="100" rows="20">
</textarea><br/>

        <input type="submit" name="post_mobiles" value="Submit it!"/>
    </form>
</center>

</body>
</html>
