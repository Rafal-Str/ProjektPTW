<?php
require("session.php");
require("db.php");
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Ulubione swetry</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>

<header>
    <h1>Ulubione swetry</h1>
</header>

<div class="container">
    <?php require("menu.php"); ?>

    <?php
    $idUzytkownika = $_SESSION["id"];

    $sql = "SELECT d.id, d.nazwa, d.obrazek FROM swetry d, ulubione u WHERE u.idSwetra = d.id AND u.idUzytkownika = $idUzytkownika";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td><img src='obrazki/{$row['obrazek']}' class='sweter-img'></td>";
            echo "<td><a href='details.php?id={$row['id']}'>{$row['nazwa']}</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Nie masz jeszcze żadnych ulubionych swetrów.</p>";
    }

    $conn->close();
    ?>
    <a href="index.php" class="back-link">Powrót do listy swetrów</a>
</div>


</body>
</html>
<?php require("footer.php"); ?>
