<?php
require_once "classes/Database.php";
require_once "classes/Conferences.php";

// connect to the database
$db = new Database();
$conn = $db->connect();

$conference = new Conference($conn);

$rooms = $conference->getRooms();
// print_r($rooms[0]['RoomNumber']);
?>
<!DOCTYPE html>
<html>
<?php include('templates/header.php') ?>

<form method="POST" action="ConferenceSubmit.php">
    <label for="submittion">Make Conference Session</label>
    <br>

    <fieldset>
        <Legend>Select Room</Legend>
        <div>
            <?php foreach ($rooms as $room): ?>
                <input type="radio" name="room" value="<?php echo $room['idRooms'] ?>" id="<?php echo $room['idRooms'] ?>" required>
                <label for="room">
                    <?php echo "Room Number: " . htmlspecialchars($room['RoomNumber']) . " Capacity:  " .  htmlspecialchars($room['Capacity']) ?>
                </label><br>
            <?php endforeach; ?>
        </div>
    </fieldset>

    <br>
    <label for="name">Name</label>
    <input name="name" type="text" required>
    <br>
    <label for="description">Description</label>
    <input name="description" type="text">
    <br>
    <label for="datetime">Datetime</label>
    <input name="datetime" type="datetime-local" required>
    <br>
    <label for="price">Price</label>
    <input name="price" type="number">
    <br>
    <input type="submit" value="Submit">
</form>
</body>

</html>