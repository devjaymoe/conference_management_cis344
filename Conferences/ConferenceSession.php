<?php
require_once "classes/Database.php";
require_once "classes/Conferences.php";

// connect to the database
$db = new Database();
$conn = $db->connect();

$conference = new Conference($conn);

$sessionSpeakers = $conference->getSessionSpeakers(1);
$sessionAttendees = $conference->getSessionAttendees(3);
print_r($sessionSpeakers);
print_r($sessionAttendees);
?>

<!DOCTYPE html>
<html>
<?php include('templates/header.php') ?>

<?php foreach ($sessionSpeakers as $session): ?>
    <p>
        <strong>
            <?php echo htmlspecialchars($session['Conference_Name']) ?>
        </strong>
    </p>
    <p>
        <?php echo htmlspecialchars($session["Description"]) ?>
    </p>
    <p>
        Date: <?php echo htmlspecialchars($session['Conference_Date']) ?>
    </p>
<?php endforeach; ?>

</body>

</html>