<?php
session_start();

// if Session logged in
if (isset($_SESSION['loggedInUser'])) {
    $login = true;
} else {
    $login = false;
}

// database include
/** @var mysqli $conn */
require_once "config/db.php";

//if button is pressed
if (isset($_POST['submit'])) {
    $email = mysqli_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

//error message
    $errors = [];
    if ($email == '') {
        $errors['email'] = 'Voer uw emailadres in';
    }
    if ($password == '') {
        $errors['password'] = 'Voer uw wachtwoord in';
    }

// if none errors
    if (empty($errors)) {
        // gegevens nemen van de database over de userName
        $query = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);

//password verify
            if (password_verify($password, $user['password'])) {
                $login = true;

                $_SESSION['loggedInUser'] = [
                    'email' => $user['email'],
                    'id' => $user['id']
                ];

//Echo error message
            } else {
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
include_once 'nav.php';
?>


<div class="forum-heading">
    <?php if ($login) { ?>
        <h2>Je bent ingelogd!</h2>
    <?php } else { ?>
</div>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="forum-heading">
            <h2>Sign In here</h2>
        </div>
        <div class="input-parent">
            <label for="email">Email</label>
            <input
                    id="email"
                    type="email"
                    name="email"
                    value="<?= $email ?? '' ?>"
            />
        </div>
        <span class="errors"><?= $errors['email'] ?? '' ?></span>
        <div class="input-parent">
            <label for="password">Password</label>
            <input
                    id="password"
                    type="password"
                    name="password"
            />
        </div>
        <span class="errors"><?= $errors['password'] ?? '' ?></span>

        <div>
            <p class="errors"><?= $errors['loginFailed'] ?? '' ?></p>
        </div>

        <button class="Login-Button" type="submit" name="submit" value="Login">Login</button>

    </form>
<?php } ?>

