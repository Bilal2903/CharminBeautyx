<?php

//if button is pressed
if (isset($_POST['submit'])) {
    //require data
    require_once "config/db.php";

    /** @var mysqli $conn */

    $firstName = mysqli_escape_string($conn, $_POST['firstName']);
    $number = mysqli_escape_string($conn, $_POST['number']);
    $email = mysqli_escape_string($conn, $_POST['email']);
    $diensten = mysqli_escape_string($conn, $_POST['diensten']);
    $meetingtime = mysqli_escape_string($conn, $_POST['meetingtime']);
    $message = mysqli_escape_string($conn, $_POST['message']);


    //Errors
    $errors = [];
    if ($firstName == '') {
        $errors['firstName'] = 'Voer uw Voor en Achternaam in.';
    }
    if ($number == '') {
        $errors['number'] = 'Voer uw telefoonnummer in.';
    }
    if ($email == '') {
        $errors['email'] = 'Voer uw email adres in.';
    }
    if ($diensten == '') {
        $errors['diensten'] = 'Kies een behandeling.';
    }
    if ($meetingtime == '') {
        $errors['meetingtime'] = 'Geef datum en tijdstip op.';
    }


    //If empty Errors
    if (empty($errors)) {

        //gegevens in de database zetten
        $query = "INSERT INTO reservations (firstName, number ,email, diensten, meetingtime, message) values('$firstName', '$number', '$email', '$diensten', '$meetingtime', '$message')";

        $result = mysqli_query($conn, $query)
        or die ('Db Error: ' . mysqli_error($conn) . ' with query: ' . $query);

    }
}
?>

<?php
include_once 'nav.php';
?>
<body>
<img class="winter-nails" src="image/winter-nails.jpg" alt="Biab nails">

<div class="forum-heading">
    <?php if (htmlspecialchars ($result)) { ?>
        <h2>Successful Gereserveerd</h2>
    <?php } else { ?>
</div>

    <div class="top-off-colum">
        <div class="colums-Service-Port">
            <div class="colum">
                <h2 class="forum-heading">AFSPRAAK MAKEN</h2>
                <H3 class="onze-service">ONZE SERVICE</H3>
            </div>
            <div class="colum-2">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="input-parent">
                        <label for="firstName">Voor en Achternaam*</label>
                        <input
                                id="firstName"
                                type="text"
                                name="firstName"
                                value="<?= htmlspecialchars ($firstName) ?? '' ?>"
                        />
                    </div>
                    <span class="errors"><?= htmlspecialchars ($errors['firstName']) ?? '' ?></span>
                    <div class="input-parent">
                        <label for="number">Telefoonnummer*</label>
                        <input
                                id="number"
                                type="text"
                                name="number"
                                value="<?= htmlspecialchars ($number) ?? '' ?>"
                        />
                    </div>

                    <span class="errors"><?= htmlspecialchars ($errors['number']) ?? '' ?></span>

                    <div class="input-parent">
                        <label for="email">Email adres*</label>
                        <input
                                id="email"
                                type="email"
                                name="email"
                                value="<?= htmlspecialchars ($email) ?? '' ?>"
                        />
                    </div>

                    <span class="errors"><?= htmlspecialchars ($errors['email']) ?? '' ?></span>

                    <div class="input-parent">
                        <select id="diensten" name="diensten">
                            <option value="-">Kies behandeling*</>
                            <option value="BIAB TREATMENT">BIAB TREATMENT</option>
                            <option value="AFZONDERLIJKE MANICURE">AFZONDERLIJKE MANICURE</option>
                            <option value="THIN FRENCH">THIN FRENCH</option>
                            <option value="VERWIJDEREN">VERWIJDEREN</option>
                        </select>
                    </div>

                    <span class="errors"><?= htmlspecialchars ($errors['diensten']) ?? '' ?></span>

                    <div class="input-parent">
                        <label for="meetingtime">Kies een datum en tijd*</label>
                        <input

                                id="meetingtime"
                                type="datetime-local"
                                name="meetingtime"
                                value="2022-01-01T01:01"
                                min="2022-01-01T00:00"
                                max="2027-01-01T00:00"
                        />
                    </div>

                    <div class="input-parent">
                        <label for="message">Opmerking</label>
                        <input
                                id="message"
                                type="text"
                                name="message"
                                value="Opmerking"
                        />
                    </div>

                    <button class="forum-btn" type="submit" name="submit" value="aanvragen">AANVRAGEN</button>
                </form>
            </div>
        </div>
    </div>


<?php } ?>
</body>




