<?php
session_start();
if (!isset($_SESSION["rooli"]) || $_SESSION["rooli"] != "admin") {
    header("Location: login.php");
    exit();
}
include "yhteys.php";

$viesti = "";

if (isset($_POST["poista"])) {
    $id = $yhteys->real_escape_string($_POST["kayttaja_id"]);
    $yhteys->query("DELETE FROM kayttaja WHERE kayttaja_id = '$id'");
    $viesti = "Käyttäjä poistettu.";
}
?>
<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <title>Käyttäjän poisto</title>
    <link rel="stylesheet" href="romantyyli.css">
</head>
<body>

<?php include "naviAdmin.php"; ?>

<div class="container">
    <h2>Poista käyttäjä</h2>
    <p><?php echo $viesti; ?></p>

    <?php
    $result = $yhteys->query("SELECT * FROM kayttaja ORDER BY kayttajatunnus");
    if ($result->num_rows == 0) {
        echo "Käyttäjiä ei löytynyt.";
    } else {
        while ($rivi = $result->fetch_assoc()) {
            echo "<div class='box'>";
            echo "<b>Käyttäjä:</b> " . $rivi["kayttajatunnus"] . "<br>";
            echo "<b>Rooli:</b> " . $rivi["rooli"] . "<br>";

            echo "<form method='post'>";
            echo "<input type='hidden' name='kayttaja_id' value='" . $rivi["kayttaja_id"] . "'>";
            echo "<button type='submit' name='poista'>Poista</button>";
            echo "</form>";

            echo "</div>";
        }
    }

    $yhteys->close();
    ?>
</div>

</body>
</html>