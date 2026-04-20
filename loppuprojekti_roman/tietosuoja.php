<?php
session_start();
$rooli = $_SESSION["rooli"] ?? "";
?>
<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <title>Tietosuojaseloste</title>
    <link rel="stylesheet" href="romantyyli.css">
</head>
<body>

<?php
if ($rooli == "admin") {
    include "naviAdmin.php";
} elseif ($rooli == "user") {
    include "naviUser.php";
} else {
    include "naviGuest.php";
}
?>

<div class="container">
    <h2>Tietosuojaseloste</h2>

    <h3>Rekisterinpitäjä</h3>
    <p>Drinkkiarkisto</p>
    <p>Ylläpitäjä: Roman</p>
    <p>Sähköposti: roman.matveev2@edu.omnia.fi</p>

    <h3>Rekisterin nimi</h3>
    <p>Drinkkiarkiston käyttäjärekisteri</p>

    <h3>Tarkoitus</h3>
    <p>Tietoja käytetään rekisteröitymiseen, kirjautumiseen ja palvelun käyttöön.</p>

    <h3>Tallennettavat tiedot</h3>
    <ul>
        <li>Käyttäjätunnus</li>
        <li>Sähköposti</li>
        <li>Salasana</li>
        <li>Rooli</li>
    </ul>

    <h3>Luovutus</h3>
    <p>Tietoja ei luovuteta ulkopuolisille.</p>

    <h3>Säilytys</h3>
    <p>Tiedot säilytetään niin kauan kuin käyttäjätili on olemassa.</p>
</div>

</body>
</html>