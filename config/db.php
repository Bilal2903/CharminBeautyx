<?php
$host       = "localhost";
$database   = "loginSystem";
$user      = "root";
$password   = "";

$conn = mysqli_connect($host, $user, $password, $database)
    or die("Error: " .mysqli_connect_error());

