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
    <link rel="icon" href="image/Schermafbeelding%202022-01-15%20om%2017.50.22.png">
    <title>CharmingBeautyx</title>
    <link rel="stylesheet" type="text/css" href="home.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <script defer src="script.js"></script>
</head>

<body>
<header>
    <nav class="navigation-bar">
            <div class="icons">
                <div class="fas fa-bars" id="menu-btn"></div>
            </div>

        <a href="home.php"><img class="logo" src="image/Charming%20Beauty.PNG" alt="CharmingBeautyx"></a>
        <div id="navigation-container">
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="Boeken.php">Boeken</a></li>
                <li><a href="Prijslijst.php">Prijslijst</a></li>
                <li><a href="Gallerij.php">Gallerij</a></li>
                <li><a href="Overmij.php">Over mij</a></li>
                <li><a href="Contact.php">Contact</a></li>
                <?php
                if (isset($_SESSION["loggedInUser"])) { ?>

                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropbtn">Settings</a>
                        <div class="dropdown-content">
                            <li><a href="profile.php">profiel</a></li>
                            <li><a href="Profile.edit.php">Profiel bewerken</a></li>
                            <li><a href="logout.php">Log Uit</a></li>
                            <li><a href="Delete.php">Delete user</a></li>
                        </div>
                    </li>
                    <?php
                } else {
                    echo "<li><a href='Register.php'>Sign Up</a></li>";
                    echo "<li><a href='Login.php'>Log In</a></li>";
                }
                ?>

                <a class="social-icon"
                   href="https://www.snapchat.com/add/charmingbty?share_id=N0I0ODk5&locale=nl_NL" target="_blank">
                    <ion-icon name="logo-snapchat"></ion-icon>
                </a>

                <a class="social-icon" href="https://www.instagram.com/charmingbeautyx/" target="_blank">
                    <ion-icon name="logo-instagram"></ion-icon>
                </a>
            </ul>

            <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        </div>
    </nav>
</header>

</body>
</html>
