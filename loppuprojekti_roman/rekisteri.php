<?php
include "yhteys.php";

$viesti = "";

if (isset($_POST["rekisteroi"])) {
    $tunnus = $yhteys->real_escape_string(trim($_POST["tunnus"]));
    $salasana = $yhteys->real_escape_string(trim($_POST["salasana"]));
    $sposti = $yhteys->real_escape_string(trim($_POST["sposti"]));

    if ($tunnus == "") {
        $viesti = "Käyttäjätunnus ei saa olla tyhjä.";
    } else {
        $check = $yhteys->query("SELECT * FROM kayttaja WHERE kayttajatunnus='$tunnus'");
        if ($check->num_rows > 0) {
            $viesti = "Käyttäjätunnus on jo käytössä.";
        } else {
            $sql = "INSERT INTO kayttaja (kayttajatunnus, salasana, sahkoposti, rooli) VALUES ('$tunnus', '$salasana', '$sposti', 'user')";
            if ($yhteys->query($sql) === TRUE) {
                $viesti = "Rekisteröinti onnistui.";
            } else {
                $viesti = "Rekisteröinti epäonnistui.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Rekisteröinti</title>
    <link rel="stylesheet" href="romantyyli.css">
</head>
<body>

<?php include "naviGuest.php"; ?>

<div class="box">
    <h2>Rekisteröidy drinkkiarkiston käyttäjäksi</h2>
    <form method="post">
        <input type="text" name="tunnus" placeholder="Käyttäjätunnus"><br><br>
        <input type="password" name="salasana" placeholder="Salasana"><br><br>
        <input type="text" name="sposti" placeholder="Sähköposti"><br><br>
        <input type="submit" name="rekisteroi" value="Rekisteröidy">
    </form>
    <p><?php echo $viesti; ?></p>
</div>

</body>
</html>