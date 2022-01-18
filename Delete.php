<?php

//Require data
require_once "config/db.php";

session_start();

/** @var mysqli $conn */
//session logged in user
$id = $_SESSION ['loggedInUser']['id'];

// Get the record from the database result
$userId = mysqli_escape_string($conn, $_POST['id']);
$query = "SELECT * FROM users WHERE id = '$id'";
$result = mysqli_query($conn, $query) or die ('Error: ' . mysqli_error($conn) . ' With query ' . $query);


$user = mysqli_fetch_assoc($result);
//If the button is pressed
if (isset($_POST['submit'])) {


    // DELETE DATA
    // Delete user id form data
    $query = "DELETE FROM users WHERE id = '$id'";
    mysqli_query($conn, $query) or die ('Error: ' . mysqli_error($conn));

    //Close connection
    mysqli_close($conn);
    session_destroy();
    //Redirect to homepage after deleting user
    header("Location: home.php");
    exit;

} else if (isset($_GET['id']) || $_GET['id'] != '') {
    //Retrieve the GET parameter
    $userId = mysqli_escape_string($conn, $_GET['id']);

    //Get the record from the database result
    $query = "SELECT * FROM users WHERE id = '$userId'";
    $result = mysqli_query($conn, $query) or die ('Error: ' . $query);

    if (mysqli_num_rows($result) == $_GET["id"]) {
        $user = mysqli_fetch_assoc($result);
    } else {
        // redirect when db returns no result
        header('Location: home.php');
        exit;
    }

}

?>

<?php
include_once 'nav.php';
?>
<div class="forum-heading">
    <h2>We gaan je missen! 💅🏼 </h2>
</div>

<form action="" method="post">
    <div class="forum-heading">
        <h2>Delete User</h2>
    </div>
    <p>
        Weet u zeker dat u uw profiel "<?= $user['userName'] ?>" wilt verwijderen?
    </p>

    <button type="submit" name="submit" value="Verwijderen">Verwijderen</button>
</form>
</body>