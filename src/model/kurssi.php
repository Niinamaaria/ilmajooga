<?php

require_once HELPERS_DIR . 'DB.php';

// Esitellään haeKurssit-funktio, joka hakee tietokannasta kaikki kurssit kurssin aloitusajan mukaan järjestettynä.
// Funktio palauttaa kurssit taulukkona

function haeKurssit() {
    return DB::run('SELECT * FROM kurssi ORDER BY kur_alkaa;')->fetchAll();
}

// Funktio, joka hakee tietokannasta yksittäisen tapahtuman tiedot
// Tässä sovelluksessa ei tarkisteta, että $id-muuttujan arvo on vaadittua tyyppiä
// eli kokonaisluku.
// Tämä olisi kuotenkin hyvä tehdä ja nostaa tarvittaesa virhe, mikäli annettu arvo ei täytä vaadittuja ehtoja

function haeKurssi($id) {
   // if(is_int($id)) {
    return DB::run('SELECT * FROM kurssi WHERE idkurssi = ?;', [$id])->fetch();
   // }
} 
?>