<?php

//session start
session_start();

$id = $_SESSION ['loggedInAdmin']['id'];
if (!isset($_SESSION['loggedInAdmin']) || $_SESSION['loggedInAdmin'] === '') {
    header('Location: admin.login.php');
    exit;
}

/** @var mysqli $conn */

//include database
require_once "config/db.php";

//session loggedin user
$id = $_SESSION ['loggedInAdmin']['id'];

//start query
$query = "SELECT * FROM admin WHERE id='$id'";

$query_run = mysqli_query($conn, $query);

if (mysqli_num_rows($query_run) == 1) {
    $admin = mysqli_fetch_assoc($query_run);

}
//include nav
include_once 'Admin.nav.php';

?>

<body>
<h2> Uw Admin gegevens zijn</h2>


<p>Admin Name: <?= $admin['adminName'] ?></p>
<p>Admin Email: <?= $admin['adminEmail'] ?></p>


<button onclick="window.location.href= 'Admin.edit.php';">Go Back</button>

</body>