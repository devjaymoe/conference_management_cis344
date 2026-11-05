<?php

require_once "classes/Database.php";

// connect to the database
$db = new Database();
$conn = $db->connect();


if (empty($_POST['id']) && empty($_POST['payment']) && empty($_POST['idConference'])) {
    echo "Must put in Attendee ID and payment and Conference ID";
} else {
    // echo htmlspecialchars($_POST['id']) . "<br/>";
    // echo htmlspecialchars($_POST['payment']) . "<br/>";
    // echo htmlspecialchars($_POST['idConference']);

    // protecting data going into database
    $idAttendee = mysqli_real_escape_string($conn, $_POST['id']);
    $payment = mysqli_real_escape_string($conn, $_POST['payment']);
    $idConference = mysqli_real_escape_string($conn, $_POST['idConference']);

    $sql = "INSERT INTO attendeeregistration(idAttendee, idConference) 
            VALUES ('$idAttendee', '$idConference');";

    // SAVE TO DB AND CHECK
    if (mysqli_query($conn, $sql)) {
        // success

        // get id of last entry into attendeeregistration table
        $idAttendeeRegistration = mysqli_insert_id($conn);
        // print_r($idAttendeeRegistration);

        $sql = "INSERT INTO payments(AmountPaid, idRegistration)
                VALUES ('$payment', '$idAttendeeRegistration');";

        if (mysqli_query($conn, $sql)) {

            $sql = "INSERT INTO sessionattendees(idAttendee, idSessionAttendee)
                    VALUES ('$idAttendee', '$idConference');";
            if (mysqli_query($conn, $sql)) {
                echo "Records inserted successfully";
            } else {
                // failure
                echo 'query error sessionattendees: ' . mysqli_error($conn);
            }
        } else {
            // failure
            echo 'query error payments: ' . mysqli_error($conn);
        }
    } else {
        // failure
        echo 'query error attendeeregistration: ' . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php') ?>

<h3>Registration Submit Attendee</h3>
</body>

</html>