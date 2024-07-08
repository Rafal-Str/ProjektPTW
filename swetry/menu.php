<?php
require("session.php");
require("db.php");
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Menu</title>
    <link rel="stylesheet" href="styl.css">
    <link rel="stylesheet" href="menu.css">
</head>
<body>

<nav class="navmenu">
    <div class="navmenu-links-left">
        <a href="index.php" class="navmenu-link">Strona główna</a>
        <a href="favourites.php" class="navmenu-link">Ulubione</a>
        <a href="myReviews.php" class="navmenu-link">Moje recenzje</a>
    </div>
    
    <div class="navmenu-links-right">
        <?php
        $login = $_SESSION["login"];
        $sql = "SELECT profile_picture FROM uzytkownicy WHERE login='$login'";
        $result = $conn->query($sql);
        $user = $result->fetch_object();
        ?>

    <span class="navmenu-welcome-msg">
        <img src="<?= $user->profile_picture ?>" width="30" height="30" class="navmenu-profile-pic">
        Witaj <?= $_SESSION["login"] ?>!
       </span>
        <a href="logout.php" class="navmenu-link navmenu-logout-btn">Wyloguj</a>
    </div>
</nav>


</body>
</html>
