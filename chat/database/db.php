<?php

$host = "localhost";
$username = "root";
$password = "root";
$database = "chat";

$connect = mysqli_connect($host, $username, $password, $db);

if (!$connect) {
    die("Error connect DB");
}
