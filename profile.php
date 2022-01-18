<?php

//session start
session_start();

$id = $_SESSION ['loggedInUser']['id'];
if (!isset($_SESSION['loggedInUser']) || $_SESSION['loggedInUser'] === '') {
    header('Location: home.php');
    exit;
}

//include nav bar
include_once 'nav.php';

/** @var mysqli $conn */

//include database
require_once "config/db.php";

//session loggedin user
$id = $_SESSION ['loggedInUser']['id'];

//start query
$query = "SELECT * FROM users WHERE id='$id'";

$query_run = mysqli_query($conn, $query);

if (mysqli_num_rows($query_run) == 1) {
    $user = mysqli_fetch_assoc($query_run);

}
//include nav
include_once 'nav.php';

?>

<body>
<h2> Uw profiel gegevens zijn</h2>


<p>User Name: <?= $user['userName'] ?></p>
<p>User Email: <?= $user['email'] ?></p>


<button onclick="window.location.href= 'Profile.edit.php';">Go Back</button>


</body>












