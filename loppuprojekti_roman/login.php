<?php
session_start();
include "yhteys.php";

$virhe = "";

if (isset($_SESSION["rooli"])) {
    header("Location: haku.php");
    exit();
}

if (isset($_POST["login"])) {
    $u = $yhteys->real_escape_string(trim($_POST["username"]));
    $p = $yhteys->real_escape_string(trim($_POST["password"]));

    $sql = "SELECT * FROM kayttaja WHERE kayttajatunnus='$u' AND salasana='$p'";
    $res = $yhteys->query($sql);

    if ($res->num_rows == 1) {
        $r = $res->fetch_assoc();
        $_SESSION["rooli"] = $r["rooli"];
        $_SESSION["kayttaja_id"] = $r["kayttaja_id"];
        $_SESSION["username"] = $r["kayttajatunnus"];
        header("Location: haku.php");
        exit();
    } else {
        $virhe = "Väärä käyttäjätunnus tai salasana.";
    }
}
?>
<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <title>Kirjautuminen</title>
    <link rel="stylesheet" href="romantyyli.css">
</head>
<body>

<?php include "naviGuest.php"; ?>

<div class="container">
    <h2>Kirjautuminen</h2>
    <form method="post">
        <input type="text" name="username" placeholder="Käyttäjätunnus"><br><br>
        <input type="password" name="password" placeholder="Salasana"><br><br>
        <input type="submit" name="login" value="Kirjaudu">
    </form>
    <p><?php echo $virhe; ?></p>
</div>

</body>
</html>