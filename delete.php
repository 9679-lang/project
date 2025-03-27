<?php
if (isset($_GET[membership_id])){
    $membership_id=$GET["membership_id"];

$servername = "localhost";
$username = "root";
$password ="";
$database = "project";

$connection = new mysqli ($servername, $username, $password, $database);

$sql ="DELETE FROM workers WHERE membership_id=$membership_id";
$connection->query($sql);
}

header("location:/project/index.php");
exit;

?>
