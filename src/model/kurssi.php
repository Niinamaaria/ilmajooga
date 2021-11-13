<?php

require_once HELPERS_DIR . 'DB.php';

// Esitellään haeKurssit-funktio, joka hakee tietokannasta kaikki kurssit kurssin aloitusajan mukaan järjestettynä.
// Funktio palauttaa kurssit taulukkona

function haeKurssit() {
    return DB::run('SELECT * FROM kurssi ORDER BY kur_alkaa;')->fetchAll();
}

?>