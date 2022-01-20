<?php
//session start
session_start();

// if Session logged in
if (isset($_SESSION['loggedInAdmin'])) {
    $adminLogin = true;
} else {
    $adminLogin = false;
}

// database include
/** @var mysqli $conn */
require_once "config/db.php";

//if button is pressed
if (isset($_POST['adminSubmit'])) {
    $adminEmail = mysqli_escape_string($conn, $_POST['adminEmail']);
    $adminPassword = mysqli_escape_string($conn, $_POST['adminPassword']);

//error message
    $errors = [];
    if ($adminEmail == '') {
        $errors['adminEmail'] = 'Voer uw emailadres in';
    }
    if ($adminPassword == '') {
        $errors['adminPassword'] = 'Voer uw wachtwoord in';
    }

// if none errors
    if (empty($errors)) {
        // gegevens nemen van de database over de admin
        $query = "SELECT * FROM admin  WHERE adminEmail='$adminEmail'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $admin = mysqli_fetch_assoc($result);

//password verify
            if (password_verify($adminPassword, $admin['adminPassword'])) {
                $adminLogin = true;

                $_SESSION['loggedInAdmin'] = [
                    'adminEmail' => $admin['adminEmail'],
                    'id' => $admin['id']
                ];

            } //Echo error message
            else {
                //Error verkeerde inlog gegevens
                $errors['loginFailed'] = 'De combinatie van email en wachtwoord is bij ons niet bekend';
            }
        } else {
            //Error verkeerde inlog gegevens
            $errors['loginFailed'] = 'De combinatie van email en wachtwoord is bij ons niet bekend';
        }
    }
}

?>

<?php
include_once 'Admin.nav.php';
?>

<div class="forum-heading">
    <?php if (htmlspecialchars ($adminLogin)) { ?>
        <h2>Je bent ingelogd!</h2>
    <?php } else { ?>
</div>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="forum-heading">
            <h2>Admin Page</h2>
        </div>
        <div class="input-parent">
            <label for="adminEmail">Email</label>
            <input
                    id="adminEmail"
                    type="email"
                    name="adminEmail"
                    value="<?= htmlspecialchars ($adminEmail) ?? '' ?>"
            />
        </div>
        <span class="errors"><?= htmlspecialchars ($errors['adminEmail']) ?? '' ?></span>
        <div class="input-parent">
            <label for="adminPassword">Password</label>
            <input
                    id="adminPassword"
                    type="password"
                    name="adminPassword"
            />
        </div>
        <span class="errors"><?= htmlspecialchars ($errors['adminPassword']) ?? '' ?></span>

        <div>
            <p class="errors"><?= htmlspecialchars ($errors['loginFailed']) ?? '' ?></p>
        </div>

        <button class="Login-Button" type="submit" name="adminSubmit" value="Login">Login</button>

    </form>
<?php } ?>