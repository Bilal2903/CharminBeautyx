<?php

session_start();

// if Session logged in
if (isset($_SESSION['loggedInAdmin'])) {
    $login = true;
} else {
    $login = false;
}

$id = $_SESSION ['loggedInAdmin']['id'];
if (!isset($_SESSION['loggedInAdmin']) || $_SESSION['loggedInAdmin'] === '') {
    header('Location: admin.login.php');
    exit;
}

// include data
/** @var mysqli $conn */
require_once 'config/db.php';

//include nav bar
include_once 'nav.php';

$adminEmail = mysqli_escape_string($conn, $_GET['adminEmail']);
$adminName = $_GET['aadminName'];


$query = "SELECT * FROM admin WHERE adminEmail='$adminEmail'";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) == $_SESSION) {
    $admin = mysqli_fetch_assoc($result);


    $_SESSION['loggedInAdmin'] = [
        'adminEmail' => $admin['adminEmail'],
        'adminPassword' => $admin['adminPassword']];

    echo $_SESSION['loggedInAdmin']['adminName']['adminEmail'];
}

?>

<section>
    <h1>Uw gegevens</h1>
    <ul>
        <li>username: <?= $adminName['adminName'] ?></li>
        <li>email: <?= $adminEmail ?></li>
    </ul>
</section>
<div>
    <a href="Admin.edit.php">Go back</a>
</div>