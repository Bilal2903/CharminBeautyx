<?php

session_start();

require_once "config/db.php";

$id = $_SESSION ['loggedInAdmin']['id'];
if (!isset($_SESSION['loggedInAdmin']) || $_SESSION['loggedInAdmin'] === '') {
    header('Location: admin.login.php');
    exit;
}

/** @var mysqli $conn */
//session loggedin user
$id = $_SESSION ['loggedInAdmin']['id'];

//start query
$query = "SELECT * FROM admin WHERE id='$id'";

$query_result = mysqli_query($conn, $query);

if (mysqli_num_rows($query_result) == 1) {
    $admin = mysqli_fetch_assoc($query_result);

}

//if button is pressed
//Add data
if (isset($_POST['update'])) {

    $adminEmail = mysqli_escape_string($conn, $_POST['adminEmail']);
    $adminPassword = mysqli_escape_string($conn, $_POST['adminPassword']);
    $adminName = mysqli_escape_string($conn, $_POST['adminName']);

    $errors = [];
    if ($adminPassword == '') {
        $errors['adminPassword'] = 'Voer uw wachtwoord in';
    }

    //secure password with hash
    $adminPassword = password_hash($adminPassword, PASSWORD_DEFAULT);

    // if none errors
    if (empty($errors)) {

        //start query
        $query = "UPDATE admin SET adminName='$adminName', adminEmail='$adminEmail', adminPassword='$adminPassword' WHERE id='$id'";

        $query_run = mysqli_query($conn, $query);

    }else {
        //Error verkeerde inlog gegevens
        $errors['adminPassword'] = 'Wachtwoord veld mag niet leeg zijn';
    }

}
?>

<?php
    include_once 'Admin.nav.php';
?>

    <div class="forum-heading">
<?php if (htmlspecialchars ($query_run)) { ?>
    <h2>Gegevens Succesvol bewerkt!</h2>
<?php } else { ?>
    </div>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="forum-heading">
            <h2>Gegevens bewerken</h2>
        </div>

        <div class="input-parent">
            <label for="adminName">User Name</label>
            <input
                id="adminName"
                type="text"
                name="adminName"
                value="<?= htmlentities($admin['adminName']); ?>"
            />
        </div>

        <div class="input-parent">
            <label for="adminEmail">Email</label>
            <input
                id="adminEmail"
                type="email"
                name="adminEmail"
                value="<?= htmlentities($admin['adminEmail']); ?>"
            />
        </div>

        <div class="input-parent">
            <label for="adminPassword">Password</label>
            <input
                id="adminPassword"
                type="password"
                name="adminPassword"
            />
            <span class="errors"><?= htmlspecialchars ($errors['adminPassword']) ?? '' ?></span>
        </div>

        <button type="submit" name="update" value="Opslaan">Opslaan</button>


    </form>
<?php } ?>