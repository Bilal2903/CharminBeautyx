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
        <?php
        if (isset($_SESSION["loggedInAdmin"])) { ?>
        <div class="navigation-bar">
            <a href="Admin.users.php"><img class="logo" src="image/Charming%20Beauty.PNG" alt="CharmingBeautyx"></a>
            <div id="navigation-container">
                <ul>
                    <li><a href="Admin.users.php">Users</a></li>
                    <li><a href="Admin.reservation.php">Reservations</a></li>
                    <li><a href="Admin.add.php">Add Admin</a></li>
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropbtn">Settings</a>
                        <div class="dropdown-content">
                            <a href="Admin.profile.php">profiel</a>
                            <a href="Admin.edit.php">Profiel bewerken</a>
                            <a href="Admin.logout.php">Log Uit</a>
                            <a href="Admin.delete.php">Delete user</a>
                        </div>
                    </li>
                    <a class="social-icon"
                       href="https://www.snapchat.com/add/charmingbty?share_id=N0I0ODk5&locale=nl_NL" target="_blank">
                        <ion-icon name="logo-snapchat"></ion-icon>
                    </a>

                    <a class="social-icon" href="https://www.instagram.com/charmingbeautyx/" target="_blank">
                        <ion-icon name="logo-instagram"></ion-icon>
                    </a>

                    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
                    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
                    <?php } ?>

                </ul>

            </div>
        </div>
    </nav>
</header>
