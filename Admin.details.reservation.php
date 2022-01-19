<?php

session_start();

// database include
/** @var mysqli $conn */
require_once "config/db.php";

$id = $_SESSION ['loggedInAdmin']['id'];
if (!isset($_SESSION['loggedInAdmin']) || $_SESSION['loggedInAdmin'] === '') {
    header('Location: admin.login.php');
    exit;
}

//Get the result set from the database with a SQL query
$query = "SELECT * FROM reservations WHERE reservation_id='reservation_id'";
$result = mysqli_query($conn, $query);

//Loop through the result to create a custom array
$reservations = [];
while ($row = mysqli_fetch_assoc($result)) {
    $reservations[] = $row;
}

//Close connection
mysqli_close($conn);

?>



<button onclick="window.location.href= 'Admin.edit.php';">Go Back</button>