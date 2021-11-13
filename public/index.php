<?php

// Suoritetaan projektin aloitusskripti
// Tämä lataa kaikki tarvittavat määritykset, tällä hetkellä ainoastaan config.php-tiedoston 
// mutta myöhemmin myös muuta tarpeellista 

require_once '../src/init.php';

// Siistitään polku urlin alusta ja mahdolliset parametrit urlin lopusta.
// Nyt osoitteen alusta poistettava teksti on määritelty config-asetuksissa. 
// Jatkossa sovellus on helpompi ottaa käyttöön toisessa sijainnissa. Riittää, että muutetaan config-asetukset oikeiksi

$request = str_replace($config['urls']['baseUrl'],'',$_SERVER['REQUEST_URI']);
$request = strtok($request, '?');

//Luodaan uusi Plates-olio ja kytketään se sovelluksen sivupohjiin

$templates = new League\Plates\Engine('../src/view');

// Selvitetään mitä sivua on kutsuttu ja suoritetaan sivua vastaava käsittelijä

if ($request === '/' || $request === '/kurssit') {
    echo $templates->render('kurssit');
  } else if ($request === '/kurssi') {
    echo $templates->render('kurssi');
  }  else {
    echo $templates->render('notfound');
  }

?>