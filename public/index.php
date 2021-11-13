<?php

// Suoritetaan projektin aloitusskripti
// Tämä lataa kaikki tarvittavat määritykset, tällä hetkellä ainoastaan config.php-tiedoston 
// mutta myöhemmin myös muuta tarpeellista 

require_once '../src/init.php';

// Siistitään polku urlin alusta ja mahdolliset parametrit urlin lopusta.
// Nyt osoitteen alusta poistettava teksti on määritelty config-asetuksissa. 
// Jatkossa sovellus on helpompi ottaa käyttöön toisessa sijainnissa. Riittää, että muutetaan config-asetukset oikeiksi

$request = str_replace($config['urls']['baseUrl'],'', $_SERVER['REQUEST URI']);
$request = strtok($request, '?');

// Selvitetään mitä sivua on kutsuttu ja suoritetaan sivua vastaava käsittelijä

if ($request === '/' || $request === '/tapahtumat') {
    echo '<h1>Kaikki tapahtumat</h1>';
} else if ($request === '/tapahtuma') {
    echo '<h1>Yksittäisen tapahtuman tiedot</h1>';
} else {
    echo'<h1>Pyydettyä sivua ei löytynyt :(</h1>';
}

?>