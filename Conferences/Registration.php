<?php
require_once "classes/Database.php";

// connect to the database
$db = new Database();
$conn = $db->connect();

// check get request id param

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // make sql query
    $sql = "SELECT
                c.idConferences,
                c.Name AS Conference_Name,
                c.Description,
                c.Date AS Conference_Date,
                c.Price,
                r.RoomNumber AS Room_Number,
                r.Capacity
            FROM conferences c
            JOIN rooms r
            ON c.idroom = r.idrooms
            WHERE idConferences = $id;";

    // get the query result
    $result = mysqli_query($conn, $sql);

    // fetch result in array format
    $conference = mysqli_fetch_assoc($result);

    // free up result
    mysqli_free_result($result);
    mysqli_close($conn);

    // print_r($conference);
}
?>

<!DOCTYPE html>
<html>
<?php include('templates/header.php') ?>

<h1>Register for Conference</h1>
<?php if ($conference): ?>
    <h4><?php echo htmlspecialchars($conference['Conference_Name']); ?></h4>
    <p>Conference ID: <?php echo htmlspecialchars($conference['idConferences']); ?></p>
    <p>Description: <?php echo htmlspecialchars($conference['Description']); ?></p>
    <p>Date: <?php echo date($conference['Conference_Date']); ?></p>
    <p>Room: <?php echo htmlspecialchars($conference['Room_Number']); ?></p>
    <p>Price: <?php echo htmlspecialchars($conference['Price']); ?></p>
    <p>Capacity: <?php echo htmlspecialchars($conference['Capacity']); ?></p>
<?php else: ?>
    <h5>No such conference exists!</h5>
<?php endif; ?>

<form method="POST" action="SubmissionCheck.php">
    <label for="submittion">Submit for attendance</label>
    <br>

    <fieldset>
        <Legend>Attendee or Speaker</Legend>
        <div>
            <input type="radio" name="role" value="Attendee" id="Attendee">
            <label for="Attendee">Attendee</label><br>
            <input type="radio" name="role" value="Speaker" id="Speaker">
            <label for="Speaker">Speaker</label><br>
        </div>
    </fieldset>

    <br>
    <label for="id">ID</label>
    <input name="id" type="number">
    <br>
    <label for="payment">Payment</label>
    <input name="payment" type="number">
    <br>
    <label for="idConference">Conference ID</label>
    <input name="idConference" type="number" value="<?php echo htmlspecialchars($conference['idConferences']) ?>">
    <br>
    <input type="submit" value="Submit">
</form>
</body>

</html>