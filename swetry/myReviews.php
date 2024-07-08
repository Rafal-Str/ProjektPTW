<?php
require("session.php");
require("db.php");
$login = $_SESSION["login"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Moje recenzje</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="styl.css">
</head>
<body>

<header>
    <h1>Moje recenzje</h1>
</header>

<div class="container">
    <?php require("menu.php"); ?>

    <?php
    $sql = "SELECT ocena, tresc, data, d.id AS idSwetra, nazwa FROM recenzje r, swetry d WHERE d.id = idSwetra AND nick = '$login'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='review'>";
            echo "<p>Data: " . htmlspecialchars($row['data']) . "</p>";
            echo "<p>Nazwa swetra: <a href='details.php?id=" . htmlspecialchars($row['idSwetra']) . "'>" . htmlspecialchars($row['nazwa']) . "</a></p>";
            echo "<p>Ocena: " . htmlspecialchars($row['ocena']) . "</p>";
            echo "<p>Treść: " . htmlspecialchars($row['tresc']) . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>Brak recenzji.</p>";
    }
    $conn->close();
    ?>

    <a href="index.php" class="back-link">Powrót do listy swetrów</a>
</div>

<?php require("footer.php"); ?>

</body>
</html>

