<?php
require("session.php");
require("db.php");

if (isset($_GET["fraza"])) {
    $fraza = $_GET["fraza"];
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Lista swetrów</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>

<header>
    <h1>Lista swetrów</h1>
</header>

<div class="container">
    <?php require("menu.php"); ?>

    <form method="GET" action="index.php" class="search-form">
        <input type="text" name="fraza" placeholder="Wyszukaj swetry..." class="search-input" value="<?php echo isset($fraza) ? htmlspecialchars($fraza) : ''; ?>">
        <input type="submit" value="Wyszukaj" class="btn">
    </form>
    
    <h2 class="categories-title">Kategorie</h2>
    <?php
    $sql = "SELECT id, nazwa FROM kategorie";
    $result = $conn->query($sql);
    echo "<nav class='categories-nav'><a href='index.php' class='nav-link btn'>Wszystkie</a>";
    while($row = $result->fetch_object()) {
        echo " <a href='index.php?idKat={$row->id}' class='nav-link btn'>{$row->nazwa}</a>";
    }
    echo "</nav>";
    ?>

    <a href="insertForm.php" class="btn add-btn">Dodaj sweter</a>

    <div class="categories">
        <?php
        $sql = "SELECT id, nazwa, obrazek FROM swetry";
        if (isset($_GET["idKat"])) {
            $idKat = $_GET["idKat"];
            $sql .= " WHERE idKategorii = $idKat";
        } elseif (isset($fraza)) {
            $sql .= " WHERE nazwa LIKE '%$fraza%'";
        }

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><img src='obrazki/{$row['obrazek']}' class='swetrów-img'></td>";
                echo "<td><a href='details.php?id={$row['id']}'>{$row['nazwa']}</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Brak swetrów do wyświetlenia</p>";
        }

        $conn->close();
        ?>
    </div>
</div>

<?php require("footer.php"); ?>

</body>
</html>
