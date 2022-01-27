<?php

//include nav bar
include_once 'nav.php';

session_start();

require_once "config/db.php";

$id = $_SESSION ['loggedInUser']['id'];
if (!isset($_SESSION['loggedInUser']) || $_SESSION['loggedInUser'] === '') {
    header('Location: home.php');
    exit;
}
/** @var mysqli $conn */

//session loggedin user
$id = $_SESSION ['loggedInUser']['id'];

//start query
$query = "SELECT * FROM users WHERE id='$id'";

$query_result = mysqli_query($conn, $query);

if (mysqli_num_rows($query_result) == 1) {
    $user = mysqli_fetch_assoc($query_result);

}

//if button is pressed
//Add data
if (isset($_POST['update'])) {

    $email = mysqli_escape_string($conn, $_POST['email']);
    $password = mysqli_escape_string($conn, $_POST['password']);
    $userName = mysqli_escape_string($conn, $_POST['userName']);

    $errors = [];
    if ($password == '') {
        $errors['password'] = 'Voer uw wachtwoord in';
    }

    //secure password with hash
    $password = password_hash($password, PASSWORD_DEFAULT);

    // if none errors
    if (empty($errors)) {

        //start query
        $query = "UPDATE users SET userName='$userName', email='$email', password='$password' WHERE id='$id'";

        $query_run = mysqli_query($conn, $query);

    }else {
        //Error verkeerde inlog gegevens
        $errors['password'] = 'Wachtwoord veld mag niet leeg zijn';
    }
}

?>

    <div class="forum-heading">
    <?php if (htmlspecialchars($query_run)) { ?>
        <h2>Gegevens Succesvol bewerkt!</h2>
    <?php } else { ?>
        </div>


        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="forum-heading">
                <h2>Gegevens bewerken</h2>
            </div>

            <div class="input-parent">
                <label for="userName">User Name</label>
                <input
                        id="userName"
                        type="text"
                        name="userName"
                        value="<?= htmlentities($user['userName']); ?>"
                />
            </div>

            <div class="input-parent">
                <label for="email">Email</label>
                <input
                        id="email"
                        type="email"
                        name="email"
                        value="<?= htmlentities($user['email']); ?>"
                />
            </div>

            <div class="input-parent">
                <label for="password">Password</label>
                <input
                        id="password"
                        type="password"
                        name="password"
                />
                <span class="errors"><?= htmlspecialchars ($errors['password']) ?? '' ?></span>
            </div>

            <button type="submit" name="update" value="Opslaan">Opslaan</button>


        </form>
    <?php } ?>