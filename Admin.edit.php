<?php

session_start();

$id = $_SESSION ['loggedInAdmin']['id'];
if (!isset($_SESSION['loggedInAdmin']) || $_SESSION['loggedInAdmin'] === '') {
    header('Location: admin.login.php');
    exit;
}

/** @var mysqli $conn */

//if button is pressed
//Add data
if (isset($_POST['update'])) {
    require_once "config/db.php";

    //session loggedin user
    $id = $_SESSION ['loggedInAdmin']['id'];

    $adminEmail = mysqli_escape_string($conn, $_POST['adminEmail']);
    $adminPassword = mysqli_escape_string($conn, $_POST['adminPassword']);
    $adminName = mysqli_escape_string($conn, $_POST['adminName']);

    //secure password with hash
    $adminPassword = password_hash($adminPassword, PASSWORD_DEFAULT);

    //start query
    $query = "UPDATE admin SET adminName='$adminName', adminEmail='$adminEmail', adminPassword='$adminPassword' WHERE id='$id'";

    $query_run = mysqli_query($conn, $query);

}
?>

<?php
    include_once 'Admin.nav.php';
?>

    <div class="forum-heading">
<?php if ($query_run) { ?>
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
            />
        </div>

        <div class="input-parent">
            <label for="adminEmail">Email</label>
            <input
                id="adminEmail"
                type="email"
                name="adminEmail"
            />
        </div>

        <div class="input-parent">
            <label for="adminPassword">Password</label>
            <input
                id="adminPassword"
                type="password"
                name="adminPassword"
            />
        </div>

        <button type="submit" name="update" value="Opslaan">Opslaan</button>


    </form>
<?php } ?>