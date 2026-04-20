<?php
session_start();
if (!isset($_SESSION["rooli"])) {
    header("Location: login.php");
    exit();
}
include "yhteys.php";

function naytaDrinkit($yhteys, $sql) {
    $res = $yhteys->query($sql);

    if ($res->num_rows == 0) {
        echo "<div class='container'><p>Reseptiä ei löytynyt.</p></div>";
        return;
    }

    while ($d = $res->fetch_assoc()) {
        echo "<div class='box'>";
        echo "<h3>" . $d["nimi"] . "</h3>";
        echo "<p><b>Juomalaji:</b> " . $d["juomalaji"] . "</p>";

        $id = $d["drinkki_id"];
        $a = $yhteys->query("
            SELECT a.nimi, da.maara
            FROM drinkki_ainesosa da
            JOIN ainesosa a ON da.ainesosa_id = a.ainesosa_id
            WHERE da.drinkki_id = '$id'
        ");

        echo "<p><b>Ainekset:</b><br>";
        while ($r = $a->fetch_assoc()) {
            echo $r["nimi"] . " (" . $r["maara"] . ")<br>";
        }
        echo "</p>";

        echo "<p><b>Ohje:</b> " . $d["valmistusohje"] . "</p>";
        echo "</div>";
    }
}

$haku = "";
$choice = "";

if (isset($_POST["laheta"])) {
    $haku = $yhteys->real_escape_string(trim($_POST["haku"]));
    $choice = $_POST["choice"] ?? "";
}
?>
<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <title>Haku</title>
    <link rel="stylesheet" href="romantyyli.css">
</head>
<body>

<?php
if ($_SESSION["rooli"] == "admin") {
    include "naviAdmin.php";
} else {
    include "naviUser.php";
}
?>

<div class="container">
    <h2>Hae drinkki</h2>

    <form method="post">
        <input type="text" name="haku" placeholder="Haku"><br><br>

        <label><input type="radio" name="choice" value="Nimi"> Nimi</label><br>
        <label><input type="radio" name="choice" value="Ainesosa"> Ainesosa</label><br><br>

        <input type="submit" name="laheta" value="Hae">
    </form>
</div>

<?php
if ($haku == "") {
    if ($_SESSION["rooli"] == "admin") {
        naytaDrinkit($yhteys, "SELECT * FROM drinkki ORDER BY nimi");
    } else {
        naytaDrinkit($yhteys, "SELECT * FROM drinkki ORDER BY nimi");
    }
} else {
    if ($choice == "Ainesosa") {
        if ($_SESSION["rooli"] == "admin") {
            $sql = "
                SELECT DISTINCT d.*
                FROM drinkki d
                JOIN drinkki_ainesosa da ON d.drinkki_id = da.drinkki_id
                JOIN ainesosa a ON da.ainesosa_id = a.ainesosa_id
                WHERE a.nimi LIKE '%$haku%'
                ORDER BY d.nimi
            ";
        } else {
            $sql = "
                SELECT DISTINCT d.*
                FROM drinkki d
                JOIN drinkki_ainesosa da ON d.drinkki_id = da.drinkki_id
                JOIN ainesosa a ON da.ainesosa_id = a.ainesosa_id
                WHERE a.nimi LIKE '%$haku%'
                ORDER BY d.nimi
            ";
        }
        naytaDrinkit($yhteys, $sql);
    } else {
        if ($_SESSION["rooli"] == "admin") {
            naytaDrinkit($yhteys, "SELECT * FROM drinkki WHERE nimi LIKE '%$haku%' ORDER BY nimi");
        } else {
            naytaDrinkit($yhteys, "SELECT * FROM drinkki WHERE nimi LIKE '%$haku%' ORDER BY nimi");
        }
    }
}

$yhteys->close();
?>

</body>
</html>