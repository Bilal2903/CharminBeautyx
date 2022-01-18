<?php

session_start();

// if Session logged in
if (isset($_SESSION['loggedInUser'])) {
    $login = true;
} else {
    $login = false;
}

// include data
/** @var mysqli $conn */
require_once 'config/db.php';

//include nav bar
include_once 'nav.php';

$email = mysqli_escape_string($conn, $_GET['email']);
$userName = $_GET['userName'];


$query = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) == $_SESSION) {
    $user = mysqli_fetch_assoc($result);


    $_SESSION['loggedInUser'] = [
        'email' => $user['email'],
        'password' => $user['password']];

    echo $_SESSION['loggedInUser']['userName']['email'];
}

?>

<section>
    <h1>Uw gegevens</h1>
    <ul>
        <li>username: <?= $userName['userName'] ?></li>
        <li>email: <?= $email ?></li>
    </ul>
</section>
<div>
    <a href="Profile.page.php">Go back</a>
</div>
