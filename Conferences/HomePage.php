<?php
session_start();

?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php') ?>

<h2>
    Home Page
</h2>

<form action="HomePage.php" method="POST">
    <input type="submit" name="logout" value="logout">
</form>

</body>

</html>

<?php
echo $_SESSION["username"] . "<br>";
echo $_SESSION["password"] . "<br>";

if (isset($_POST["logout"])) {
    session_destroy();
    header("Location: LoginPage.php");
}
?>