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
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

//Loop through the result to create a custom array
$users = [];
while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}

//Close connection
mysqli_close($conn);

?>

<?php
include_once 'Admin.nav.php';
?>

<table>
    <thead>
    <tr>
        <th>#</th>
        <th>User Name</th>
        <th>Email</th>
        <th>Created At</th>
    </tr>
    </thead>

    <tbody>
    <?php foreach ($users as $user) { ?>
        <tr>
            <td><?= htmlspecialchars ($user['id']) ?></td>
            <td><?= htmlspecialchars ($user['userName']) ?></td>
            <td><?= htmlspecialchars ($user['email']) ?></td>
            <td><?= htmlspecialchars ($user['created_at']) ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>

