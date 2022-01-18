<?php

//if button is pressed
if (isset($_POST['submit'])) {
    //require data
    require_once "config/db.php";

    /** @var mysqli $conn */

    $email = mysqli_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $userName = $_POST['userName'];

    //Errors
    $errors = [];
    if ($userName == '') {
        $errors['userName'] = 'Voer uw gebruikersnaam in.';
    }
    if ($email == '') {
        $errors['email'] = 'Voer uw emailadres in.';
    }
    if ($password == '') {
        $errors['password'] = 'Voer uw wachtwoord in.';
    }

    //If empty Errors
    if (empty($errors)) {

        //password hash (beveiligen)
        $password = password_hash($password, PASSWORD_DEFAULT);

        //gegevens in de database zetten
        $query = "INSERT INTO users (userName, email, password) values('$userName', '$email', '$password')";

        $result = mysqli_query($conn, $query)
        or die ('Db Error: ' . mysqli_error($conn) . ' with query: ' . $query);

    }
}
?>

<?php
include_once 'nav.php';
?>

<div class="forum-heading">
    <?php if ($result) { ?>
        <h2>Welcome <?php echo $userName ?> u bent Succesvol Geregistreerd!</h2>
    <?php } else { ?>
</div>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="forum-heading">
            <h2>Sign Up Here</h2>
        </div>
        <div class="input-parent">
            <label for="userName">User Name</label>
            <input
                    id="userName"
                    type="text"
                    name="userName"
                    value="<?= $userName ?? '' ?>"
            />
        </div>
        <span class="errors"><?= $errors['userName'] ?? '' ?></span>
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
                    value="<?= $password ?? '' ?>"
            />
        </div>
        <span class="errors"><?= $errors['password'] ?? '' ?></span>

        <button type="submit" name="submit" value="registreren">Registreren</button>

    </form>
<?php } ?>
