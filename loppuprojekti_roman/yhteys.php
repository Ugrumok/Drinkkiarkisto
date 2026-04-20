<?php
$yhteys = new mysqli("localhost", "root", "", "drinkitroman");
if ($yhteys->connect_error) {
    die("Yhteys epäonnistui");
}
$yhteys->set_charset("utf8");
?>