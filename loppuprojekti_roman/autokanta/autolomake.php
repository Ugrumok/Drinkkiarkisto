<!DOCTYPE html>
<html>
<head>
	<title>Autolomake</title>
</head>
<body>
	<h4>Syötä auton tiedot:</h4>
	<form action="autolomake.php" method="post">
		<input type="text" name="rekisteri" placeholder="Rekisterinro"/><br><br>
		<input type="text" name="vari" placeholder="Väri"/><br><br>
		<input type="text" name="vuosimalli" placeholder="Vuosimalli"/><br><br>
		<select name="omistaja" >
		<?php 
		$palvelin = 'localhost';
		$käyttäjä = 'root';
		$salasana = '';
		$tietokanta = 'autot';
	
		$yhteys = new mysqli($palvelin, $käyttäjä, $salasana, $tietokanta);
		if ($yhteys->connect_error) {
			die('Yhteyden muodostaminen epäonnistui; ' . $yhteys->connect_error);
		}
		$yhteys->set_charset('utf8');

		$hakusql = "SELECT hetu, nimi FROM henkilo";
		$tulokset = $yhteys->query($hakusql);
		
		if ($tulokset->num_rows > 0) {
			while ($rivi = $tulokset->fetch_assoc()) {
				echo "<option value='" . $rivi['hetu'] . "'>" . $rivi['nimi'] . "</option>";
			}
		} else {
			echo "<option value=''>Ei omistajia löytynyt</option>";
		}
		$yhteys->close();
		?>
		</select><br><br>
		<input type="submit" name="lisays" value="Lisää auto"><br><br>

		<?php
		if (isset($_POST['lisays'])) {
			$yhteys = new mysqli($palvelin, $käyttäjä, $salasana, $tietokanta);
			if ($yhteys->connect_error) {
				die('Yhteyden muodostaminen epäonnistui; ' . $yhteys->connect_error);
			}
			$yhteys->set_charset('utf8');

			$rekisteri = $yhteys->real_escape_string($_POST['rekisteri']);
			$vari = $yhteys->real_escape_string($_POST['vari']);
			$vuosimalli = $yhteys->real_escape_string($_POST['vuosimalli']);
			$omistaja = $yhteys->real_escape_string($_POST['omistaja']);

			if (empty($rekisteri)) {
				echo 'Rekisterinumero ei voi olla tyhjä.';
				return;
			};
			$check_sql = "SELECT rekisterinro FROM auto WHERE rekisterinro = '$rekisteri'";
			$result = $yhteys->query($check_sql);
			if ($result->num_rows > 0) {
				echo 'Rekisterinumero käytössä!';
			} else {
				$hakusql = "INSERT INTO auto (rekisterinro, vari, vuosimalli, omistaja)
						VALUE ('$rekisteri', '$vari', '$vuosimalli', '$omistaja')";
				if ($yhteys->query($hakusql) === TRUE) {
					echo 'Auto lisätty taulukkoon.';
				} else {
					echo 'Tapahtui virhe: ' . $yhteys->error;
				}
			}
			$yhteys->close();
		}
		?>
	</form>
</body>
</html>