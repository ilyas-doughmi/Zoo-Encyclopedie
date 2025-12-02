<?php
$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "zoo_encycloedie";
$isConnected = false;

try {
    $conn = mysqli_connect($server_name, $user_name, $password, $db_name);
    $isConnected = true;
} catch (mysqli_sql_exception) {
    $isConnected = false;
}



?>