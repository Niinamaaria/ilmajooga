<?php

    // Esitellään generateActivationCode- funktio, joka hoitaa vahvistusavaimen generoinnin.
    // Funktio saa ensin saamansa tekstin perään satunnaisluvun ja laskee sen jälkeen niiden yhdistelmästä 
    // SHA1-hajautusluvun, joka on 40 heksanumeroa pitkä numerosarja. 
    // Kutsun yhteydessä tekstinä annetaan sähköpostiosoite. 
    // Satunnaisluku pitää huolen siitä, että laskettavaa hajautusarvoa ei ole helppo arvata. 

  function generateActivationCode($text='') {
    return hash('sha1', $text . rand());
  }

?>
