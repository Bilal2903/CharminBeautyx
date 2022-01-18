<?php

session_start();

$id = $_SESSION ['loggedInAdmin']['id'];
if (!isset($_SESSION['loggedInAdmin']) || $_SESSION['loggedInAdmin'] === '') {
    header('Location: admin.login.php');
    exit;
}

//if button is pressed
if (isset($_POST['submit'])) {
    //require data
    require_once "config/db.php";

    /** @var mysqli $conn */

    $adminEmail = mysqli_escape_string($conn, $_POST['adminEmail']);
    $adminPassword = $_POST['adminPassword'];
    $adminName = $_POST['adminName'];

    //Errors
    $errors = [];
    if ($adminName == '') {
        $errors['adminName'] = 'Voer uw gebruikersnaam in.';
    }
    if ($adminEmail == '') {
        $errors['adminEmail'] = 'Voer uw emailadres in.';
    }
    if ($adminPassword == '') {
        $errors['adminPassword'] = 'Voer uw wachtwoord in.';
    }

    //If empty Errors
    if (empty($errors)) {

        //password hash (beveiligen)
        $adminPassword = password_hash($adminPassword, PASSWORD_DEFAULT);

        //gegevens in de database zetten
        $query = "INSERT INTO admin (adminName, adminEmail, adminPassword) values('$adminName', '$adminEmail', '$adminPassword')";

        $result = mysqli_query($conn, $query)
        or die ('Db Error: ' . mysqli_error($conn) . ' with query: ' . $query);

    }
}
?>

<?php
include_once 'Admin.nav.php';
?>

<div class="forum-heading">
    <?php if ($result) { ?>
        <h2>Welcome admin <?php echo $adminName ?> Admin Succesvol Geregistreerd!</h2>
    <?php } else { ?>
</div>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="forum-heading">
            <h2>Add admin</h2>
        </div>
        <div class="input-parent">
            <label for="adminName">User Name</label>
            <input
                id="adminName"
                type="text"
                name="adminName"
                value="<?= $adminName ?? '' ?>"
            />
        </div>
        <span class="errors"><?= $errors['adminName'] ?? '' ?></span>
        <div class="input-parent">
            <label for="adminEmail">Email</label>
            <input
                id="adminEmail"
                type="email"
                name="adminEmail"
                value="<?= $adminEmail ?? '' ?>"
            />
        </div>
        <span class="errors"><?= $errors['adminEmail'] ?? '' ?></span>
        <div class="input-parent">
            <label for="adminPassword">Password</label>
            <input
                id="adminPassword"
                type="password"
                name="adminPassword"
                value="<?= $adminPassword ?? '' ?>"
            />
        </div>
        <span class="errors"><?= $errors['adminPassword'] ?? '' ?></span>

        <button type="submit" name="submit" value="registreren">Toevoegen</button>

    </form>
<?php } ?>
