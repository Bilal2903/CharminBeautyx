<?php

//Require data
require_once "config/db.php";

session_start();

/** @var mysqli $conn */
//session logged in user
$id = $_SESSION ['loggedInAdmin']['id'];
if (!isset($_SESSION['loggedInAdmin']) || $_SESSION['loggedInAdmin'] === '') {
    header('Location: admin.login.php');
    exit;
}

// Get the record from the database result
$adminId = mysqli_escape_string($conn, $_POST['id']);
$query = "SELECT * FROM admin WHERE id = '$id'";
$result = mysqli_query($conn, $query) or die ('Error: ' . mysqli_error($conn) . ' With query ' . $query);


$admin = mysqli_fetch_assoc($result);
//If the button is pressed
if (isset($_POST['submit'])) {


    // DELETE DATA
    // Delete user id form data
    $query = "DELETE FROM admin WHERE id = '$id'";
    mysqli_query($conn, $query) or die ('Error: ' . mysqli_error($conn));

    //Close connection
    mysqli_close($conn);
    session_destroy();
    //Redirect to homepage after deleting user
    header("Location: admin.login.php");
    exit;

} else if (isset($_GET['id']) || $_GET['id'] != '') {
    //Retrieve the GET parameter
    $adminId = mysqli_escape_string($conn, $_GET['id']);

    //Get the record from the database result
    $query = "SELECT * FROM admin WHERE id = '$adminId'";
    $result = mysqli_query($conn, $query) or die ('Error: ' . $query);

    if (mysqli_num_rows($result) == $_GET["id"]) {
        $admin = mysqli_fetch_assoc($result);
    } else {
        // redirect when db returns no result
        header('Location: admin.login.php');
        exit;
    }

}

?>

<?php
include_once 'Admin.nav.php';
?>
<div class="forum-heading">
    <h2>We gaan je missen Admin! 💅 </h2>
</div>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="forum-heading">
        <h2>Delete Admin</h2>
    </div>
    <p>
        Weet u zeker dat u uw profiel "<?= $admin['adminName'] ?>" wilt verwijderen?
    </p>

    <button type="submit" name="submit" value="Verwijderen">Verwijderen</button>
</form>