<?php

// tarkistetaan käyttäjän lomakkeelle syöttämä tieto
// Määritellään cleanArray-funktio, joka käy parametrina annetun taulukon
// alkiot yksi kerrallaan läpi ja tekee niille seuraavat toimenpiteet: 
// trim: poistaa merkkijonon alusta ja lopusta ns. tyhjät merkit, kuten välilyönnit, sarkainmerkit ja rivivaihdot
// stripslashes: poistaa merkkien edestä mahdollisen \-ohjausmerkin. 
// Joidenkin merkkien edessä täytyy käyttää \-ohjausmerkkiä, kun sitä ollaan tulostamassa.

function cleanArrayData($array=[]) {
  $result = array();
  foreach ($array as $key => $value) {
    $cleaned = trim($value);
    $cleaned = stripslashes($cleaned);
    $result[$key] = $cleaned;
  }
  return $result;
}

?>
