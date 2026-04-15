<?php
session_start();
if (!isset($_SESSION["rooli"]) || $_SESSION["rooli"] != "admin") {
    header("Location: login.php");
    exit();
}
include "yhteys.php";

$viesti = "";

if (isset($_POST["poista"])) {
    $id = $yhteys->real_escape_string($_POST["resepti_id"]);
    $yhteys->query("DELETE FROM drinkki WHERE drinkki_id = '$id'");
    $viesti = "Resepti poistettu.";
}
?>
<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <title>Poisto</title>
    <link rel="stylesheet" href="romantyyli.css">
</head>
<body>

<?php include "naviAdmin.php"; ?>

<div class="container">
    <h4>Poista drinkki</h4>
    <p><?php echo $viesti; ?></p>

    <?php
    $result = $yhteys->query("SELECT * FROM drinkki ORDER BY nimi");
    if ($result->num_rows == 0) {
        echo "Reseptejä ei löytynyt.";
    } else {
        while ($rivi = $result->fetch_assoc()) {
            echo "<div class='box'>";
            echo "<b>Nimi:</b> " . $rivi["nimi"] . "<br>";
            echo "<b>Juomalaji:</b> " . $rivi["juomalaji"] . "<br>";

            echo "<form method='post'>";
            echo "<input type='hidden' name='resepti_id' value='" . $rivi["drinkki_id"] . "'>";
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