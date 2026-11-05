<?php
require_once "classes/Database.php";
require_once "classes/Conferences.php";

// connect to the database
$db = new Database();
$conn = $db->connect();

if (empty($_POST['room']) && empty($_POST['name'])) {
    echo "Did not fill out all formed needed  for submission!";
} else {
    // protecting data going into database
    $conferenceName = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $datetime = mysqli_real_escape_string($conn, $_POST['datetime']);
    $room = mysqli_real_escape_string($conn, $_POST['room']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);

    $sql = "INSERT INTO conferences(Name, Description, Date, idRoom, Price) 
            VALUES ('$conferenceName', '$description', '$datetime', '$room', '$price');";

    // SAVE TO DB AND CHECK
    if (mysqli_query($conn, $sql)) {
        // success
        echo 'Successful entry';
        mysqli_close($conn);
        header("Location: index.php");
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

</body>

</html>