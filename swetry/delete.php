<?php
require("session.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idSwetra = $_POST["idSwetra"];

    $conn = new mysqli("localhost", "root", "", "swetrydb");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM swetry WHERE id = $idSwetra";
    if ($conn->query($sql) === TRUE) {
        $message = "sweter został usunięty.";
    } else {
        $message = "Błąd podczas usuwania swetra: " . $conn->error;
    }

    $conn->close();
} else {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Usunięcie swetra</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>

<div class="container">
    <?php require("menu.php"); ?>

    <div class="message">
        <?php echo $message; ?>
    </div>

    <a href="index.php" class="back-link">Powrót do listy swetrów</a>
</div>

<footer>
    <?php require("footer.php"); ?>
</footer>

</body>
</html>
