<?php

// Tämä lataa kaikki tarvittavat määritykset ja toiminnallisuudet ennen kuin skriptiä aloitetaan suorittamaan

require_once '../config/config.php';

// Otetaan autoload-skripti käyttöön. 
// Tämä huolehtii, että kaikki sovelluksessa tarvittavat luokat tulevat ladattua ennen käyttöä.

require_once '../vendor/autoload.php';

// Liitetään lisaa_tili- sivulle syötettyjen tietojen tarkastamiseen käytettävä apufunktio osaksi ohjelmaa 

require_once HELPERS_DIR . 'form.php';


require_once HELPERS_DIR . 'DB.php';

?>