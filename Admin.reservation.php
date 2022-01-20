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
$query = "SELECT * FROM reservations";
$result = mysqli_query($conn, $query);

//Loop through the result to create a custom array
$reservations = [];
while ($row = mysqli_fetch_assoc($result)) {
    $reservations[] = $row;
}

//Close connection
mysqli_close($conn);

?>

<?php
include_once 'Admin.nav.php';
?>

<button onclick="window.location.href= 'Prijslijst.php';"> Nieuwe Reservering</button>

<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Number</th>
        <th>Email</th>
        <th>Dienst</th>
        <th>Appointment</th>
        <th>Message</th>
        <th></th>
    </tr>
    </thead>

    <tbody>
    <?php foreach ($reservations as $reservation) { ?>
        <tr>
            <td><?= htmlspecialchars ($reservation['id']) ?></td>
            <td><?= htmlspecialchars ($reservation['firstName']) ?></td>
            <td><?= htmlspecialchars ($reservation['number']) ?></td>
            <td><?= htmlspecialchars ($reservation['email']) ?></td>
            <td><?= htmlspecialchars ($reservation['diensten']) ?></td>
            <td><?= htmlspecialchars ($reservation['meetingtime']) ?></td>
            <td><?= htmlspecialchars ($reservation['message']) ?></td>
            <td><button onclick="window.location.href= 'Prijslijst.php';"> Details</button></td>
            <td><button onclick="window.location.href= 'Prijslijst.php';"> Edit</button></td>
            <td><button onclick="window.location.href= 'Prijslijst.php';"> Delete</button></td>

        </tr>
    <?php } ?>
    </tbody>
</table>

