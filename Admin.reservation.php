<?php

//session start
session_start();

$id = $_SESSION ['loggedInAdmin']['id'];
if (!isset($_SESSION['loggedInAdmin']) || $_SESSION['loggedInAdmin'] === '') {
    header('Location: admin.login.php');
    exit;
}

/** @var mysqli $admin */
//include data
require_once "config/db.php";

if(!isset($_GET['admin']))


$sql = "SELECT * FROM reservations";

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result)> 0){
    $reservations = mysqli_fetch_assoc($result);
    foreach ($reservations as $reservation) {
        print $reservation['email'];
    }
    print_r($reservations);
}
?>
<h1></h1>
<hr/>
<a href="Admin.add.reservation.php">New reservation</a>
<table>
    <thead>
    <tr>
        <th>#</th>
        <th>First Name</th>
        <th>Number</th>
        <th>Email</th>
        <th>Diensten</th>
        <th>Meeting Time</th>
        <th>Message</th>
        <th></th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <td colspan="6">&copy; CharmingBeautyx</td>
    </tr>
    </tfoot>
    <tbody>
    <?php foreach ( as $index => $reservation) {?>
        <tr>
            <td><?= $index + 1 ?></td>
            <td><?= $reservation['artist'] ?></td>
            <td><?= $reservation['album'] ?></td>
            <td><?= $reservation['genre'] ?></td>
            <td><?= $reservation['year'] ?></td>
            <td><?= $reservation['tracks'] ?></td>
            <td><a href="Admin.details.php?index=<?= $index ?>">Details</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>

