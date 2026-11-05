<?php

require_once "classes/Database.php";

// connect to the database
$db = new Database();
$conn = $db->connect();


if (empty($_POST['id']) && empty($_POST['idConference'])) {
    echo htmlspecialchars($_POST['id']);
    echo htmlspecialchars($_POST['idConference']);
    echo "Must put in Speaker ID and Conference ID";
} else {
    // protecting data going into database
    $idSpeaker = mysqli_real_escape_string($conn, $_POST['id']);
    $idConference = mysqli_real_escape_string($conn, $_POST['idConference']);

    $sql = "INSERT INTO speakersubmission(idSpeaker, idConference) 
            VALUES ('$idSpeaker', '$idConference');";

    // SAVE TO DB AND CHECK
    if (mysqli_query($conn, $sql)) {
        // success

        // get id of last entry into attendeeregistration table
        $idSpeakerRegistration = mysqli_insert_id($conn);
        // print_r($idAttendeeRegistration);

        $sql = "INSERT INTO sessionspeaker(idSessionSpeaker, idSpeaker)
                VALUES ('$idSpeakerRegistration', '$idSpeaker');";

        if (mysqli_query($conn, $sql)) {
            //success
            echo "Records inserted successfully";
        } else {
            // failure
            echo 'query error sessionspeaker: ' . mysqli_error($conn);
        }
    } else {
        // failure
        echo 'query error speakersubmission: ' . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php') ?>

<h3>Registration Submit Speaker</h3>
</body>

</html>