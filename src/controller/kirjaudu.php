<?php

  function tarkistaKirjautuminen($email="", $salasana="") {


    // Luodaan funktio tarkistaKirjautuminen, joka huolehtii käyttäjätunnuksen ja salasanan
    // oikeellisuuden tarkistuksesta. 
    // Käyttäjän tiedot haetaan ensin sähköpostiosoitteella.
    // Jos tiedot löyhtyivät, niin sen jälkeen tarkistetaan, täsmääkö käyttäjän antama salasana tietokannan salasanaan.
    // Tarkistuksessa hyödynnetään PHP:n sisäänrakennettua toiminnallisuutta. 
    // Jos käyttäjätunnus ja salasana täsmäävät, fukntio palauttaa toden, muuten palautetaan epätosi 

    // Haetaan käyttäjän tiedot sen sähköpostiosoitteella. 
    require_once(MODEL_DIR . 'henkilo.php');
    $tiedot = haeHenkiloSahkopostilla($email);
    $tiedot = array_shift($tiedot);

    // Tarkistetaan ensin löytyikö käyttäjä. Jos löytyi, niin
    // tarkistetaan vielä, täsmäävätkö salasanat.
    if ($tiedot && password_verify($salasana, $tiedot['salasana'])) {
      return true;
    }

    // Jos käyttäjää ei löytynyt tai salasana oli väärin. 
    return false;

  }

?>
