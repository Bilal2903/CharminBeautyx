<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="image/Schermafbeelding 2022-01-15 om 17.50.22.png">
    <title>CharmingBeautyx</title>
    <link rel="stylesheet" type="text/css" href="home.css"/>
</head>

<body>
<header>
    <nav>
        <div class="navigation-bar">
            <div id="navigation-container">
                <ul>

                    <?php
                    if (isset($_SESSION["loggedInUser"])) { ?>

                        <li><a href="Users.php">Users</a></li>
                        <li><a href="Reservation.php">Reservation</a></li>
                        <li><a href="Admin.add.php">Add Admin</a></li>
                        <li class="dropdown">
                            <a href="javascript:void(0)" class="dropbtn">Settings</a>
                            <div class="dropdown-content">
                                <a href="Admin.edit.php">Profiel bewerken</a>
                                <a href="Admin.logout.php">Log Uit</a>
                                <a href="Admin.delete.php">Delete user</a>
                            </div>
                        </li>
                    <?php } ?>

                </ul>

            </div>
        </div>
    </nav>
</header>
