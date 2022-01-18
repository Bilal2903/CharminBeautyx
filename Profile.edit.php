<?php

//include nav bar
include_once 'nav.php';

session_start();

$id = $_SESSION ['loggedInUser']['id'];
if (!isset($_SESSION['loggedInUser']) || $_SESSION['loggedInUser'] === '') {
    header('Location: home.php');
    exit;
}
/** @var mysqli $conn */

//if button is pressed
//Add data
if (isset($_POST['update'])) {
    require_once "config/db.php";

    //session loggedin user
    $id = $_SESSION ['loggedInUser']['id'];

    $email = mysqli_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $userName = $_POST['userName'];

    //secure password with hash
    $password = password_hash($password, PASSWORD_DEFAULT);

    //start query
    $query = "UPDATE users SET userName='$userName', email='$email', password='$password' WHERE id='$id'";

    $query_run = mysqli_query($conn, $query);

}
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
            <label for="userName">User Name</label>
            <input
                    id="userName"
                    type="text"
                    name="userName"
            />
        </div>

        <div class="input-parent">
            <label for="email">Email</label>
            <input
                    id="email"
                    type="email"
                    name="email"
            />
        </div>

        <div class="input-parent">
            <label for="password">Password</label>
            <input
                    id="password"
                    type="password"
                    name="password"
            />
        </div>

        <button type="submit" name="update" value="Opslaan">Opslaan</button>


    </form>
<?php } ?>