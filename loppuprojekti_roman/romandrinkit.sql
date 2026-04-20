DROP TABLE IF EXISTS drinkki_ainesosa;
DROP TABLE IF EXISTS drinkki;
DROP TABLE IF EXISTS ainesosa;
DROP TABLE IF EXISTS kayttaja;

CREATE TABLE kayttaja (
    kayttaja_id INT AUTO_INCREMENT PRIMARY KEY,
    kayttajatunnus VARCHAR(50) NOT NULL UNIQUE,
    salasana VARCHAR(255) NOT NULL,
    sahkoposti VARCHAR(100) NOT NULL,
    rooli VARCHAR(20) NOT NULL
);

CREATE TABLE drinkki (
    drinkki_id INT AUTO_INCREMENT PRIMARY KEY,
    nimi VARCHAR(100) NOT NULL,
    juomalaji VARCHAR(50) NOT NULL,
    valmistusohje TEXT NOT NULL,
    lisannyt_kayttaja INT NULL,
    hyvaksytty TINYINT(1) NOT NULL DEFAULT 1,
    FOREIGN KEY (lisannyt_kayttaja) REFERENCES kayttaja(kayttaja_id) ON DELETE SET NULL
);

CREATE TABLE ainesosa (
    ainesosa_id INT AUTO_INCREMENT PRIMARY KEY,
    nimi VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE drinkki_ainesosa (
    drinkki_id INT NOT NULL,
    ainesosa_id INT NOT NULL,
    maara VARCHAR(50) NOT NULL,
    PRIMARY KEY (drinkki_id, ainesosa_id),
    FOREIGN KEY (drinkki_id) REFERENCES drinkki(drinkki_id) ON DELETE CASCADE,
    FOREIGN KEY (ainesosa_id) REFERENCES ainesosa(ainesosa_id) ON DELETE CASCADE
);

INSERT INTO kayttaja (kayttajatunnus, salasana, sahkoposti, rooli) VALUES
('romanadmin', '1234', 'roman.matveev2@edu.omnia.fi', 'admin'),
('romanuser', '1234', 'roman.matveev2@edu.omnia.fi', 'user');

INSERT INTO ainesosa (nimi) VALUES
('Vodka'),
('Cola'),
('Kahvi'),
('Appelsiinimehu');