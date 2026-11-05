<?php
require_once "classes/Database.php";
require_once "classes/Conferences.php";
// connect to the database
$db = new Database();
$conn = $db->connect();

$conference = new Conference($conn);

$conferences = $conference->getConferences();
?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php') ?>

<h1>Welcome to Conference Management PHP</h1>
<hr>
<h2>Upcoming Conferences</h2>

<?php foreach ($conferences as $row): ?>
    <p>
        <strong>
            <?php echo htmlspecialchars($row['Conference_Name']) ?>
        </strong>
    </p>
    <p>
        <?php echo htmlspecialchars($row["Description"]) ?>
    </p>
    <p>
        Price: $<?php echo htmlspecialchars($row["Price"]) ?>
    </p>
    <p>
        Date: <?php echo htmlspecialchars($row['Conference_Date']) ?>
    </p>
    <a type='submit' href="/conferences/registration.php?id=<?php echo $row['idConferences'] ?>" name='selected'>Select</a>
<?php endforeach; ?>

</body>

</html>