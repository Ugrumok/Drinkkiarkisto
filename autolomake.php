<!DOCTYPE html>
<html>
<head>
	<title>Autohaku</title>
</head>
<body>
	<h4>Syötä rekisterinumero:</h4>
	<form action="" method="post">
		<input type="text" name="rekisterinro" /><br><br>
		<input type="submit" name="hae" /><br><br>
	</form>
    <?php
    $palvelin = 'localhost';
    $käyttäjä = 'root';
    $salasana = '';
    $tietokanta = 'autot';

    $yhteys = new mysqli($palvelin, $käyttäjä, $salasana, $tietokanta);
    if ($yhteys -> connect_error) {
        die('Yhteyden mudostaminen epäonnistui; ' . $yhteys -> connect_error);
    };
    $yhteys -> set_charset('utf8');
    
    $rekisterinro = '';
    if (isset($_POST['hae'])) {
        $rekisterinro = $yhteys -> real_escape_string($_POST['rekisterinro']);
    };

    if ($rekisterinro) {
        $hakusql = "SELECT * FROM auto WHERE rekisterinro LIKE '%$rekisterinro%'";
    } else {
        $hakusql = "SELECT * FROM auto";
    };

    $tulokset = $yhteys -> query($hakusql);
    if (!$tulokset) {
        echo "Ошибка запроса: " . $yhteys->error;
    } else if ($tulokset -> num_rows > 0) {
        while($rivi = $tulokset -> fetch_assoc()) {
            echo 'Rekisterinro: ' . $rivi['rekisterinro'] . '<br>';
            echo 'Väri: ' . $rivi['vari'] . '<br>';
            echo 'Vuosimalli: ' . $rivi['vuosimalli'] . '<br>';
            echo 'Omistaja: ' . $rivi['omistaja'] . '<br>';
        };
    } else {
        echo 'Ei tuloksia.';
    };
    $yhteys -> close();

    ?>
	</body>
</html>