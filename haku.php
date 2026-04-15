<?php
session_start();
if (!isset($_SESSION["rooli"]) || $_SESSION["rooli"] != "user") {
    header("Location: login.php");
    exit();
}
include "yhteys.php";

$viesti = "";

if (isset($_POST["done"])) {
    $name = $yhteys->real_escape_string(trim($_POST["name"]));
    $drinktype = $yhteys->real_escape_string(trim($_POST["drinktype"]));
    $ohjeet = $yhteys->real_escape_string(trim($_POST["ohjeet"]));
    $aines_id = $_POST["aines_id"] ?? [];
    $maara = $_POST["maara"] ?? [];

    if ($name == "") {
        $viesti = "Nimi puuttuu.";
    } else {
        $check = $yhteys->query("SELECT * FROM drinkki WHERE nimi='$name'");
        if ($check->num_rows > 0) {
            $viesti = "Drinkki on jo olemassa.";
        } else {
            $sql = "INSERT INTO drinkki (nimi, juomalaji, valmistusohje, lisannyt_kayttaja, hyvaksytty) VALUES ('$name', '$drinktype', '$ohjeet', " . $_SESSION["kayttaja_id"] . ", 0)";
            if ($yhteys->query($sql) === TRUE) {
                $drinkkiId = $yhteys->insert_id;

                for ($i = 0; $i < count($maara); $i++) {
                    $aid = $yhteys->real_escape_string($aines_id[$i] ?? "");
                    $m = $yhteys->real_escape_string(trim($maara[$i] ?? ""));

                    if ($aid != "" && $m != "") {
                        $yhteys->query("INSERT INTO drinkki_ainesosa (drinkki_id, ainesosa_id, maara) VALUES ('$drinkkiId', '$aid', '$m')");
                    }
                }

                $viesti = "Ehdotus lähetetty.";
            } else {
                $viesti = "Tallennus epäonnistui.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <title>Ehdotus</title>
    <link rel="stylesheet" href="romantyyli.css">
    <script src="romanjavascript.js" defer></script>
</head>
<body>

<?php include "naviUser.php"; ?>

<div class="container">
    <h4>Ehdota drinkki</h4>

    <form method="post">
        <input type="text" name="name" placeholder="Nimi"><br><br>
        <input type="text" name="drinktype" placeholder="Juomalaji"><br><br>

        <div id="ingredients">
            <div class="ingredient-row">
                <select name="aines_id[]">
                    <option value="">Valitse aines</option>
                    <?php
                    $result = $yhteys->query("SELECT * FROM ainesosa ORDER BY nimi");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["ainesosa_id"] . "'>" . $row["nimi"] . "</option>";
                    }
                    ?>
                </select>
                <input type="text" name="maara[]" placeholder="Määrä">
            </div>
        </div>

        <br>

        <textarea name="ohjeet" placeholder="Ohjeet"></textarea><br><br>

        <button type="button" onclick="addRow()">+</button>
        <input type="submit" name="done" value="Lähetä">
    </form>

    <p><?php echo $viesti; ?></p>
</div>

<?php $yhteys->close(); ?>

</body>
</html>