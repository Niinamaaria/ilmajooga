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

  function logout() {

    // Esitellään uloskirjautumiseen käytettävä funktio logout. 
    // Tyhjennetään ensin mahdolliset istuntomuuttujat sekä eväste, johon istuntotieto on tallennettu.
    // Lopuksi poistetaan kaikki istuntoon liittyvä tieto tuhoamalla istunto.

    // Tyhjennetään istuntomuuttujat.
    $_SESSION = array();

    // Poistetaan istunnon eväste.
    if (ini_get("session.use_cookies")) {
      $params = session_get_cookie_params();
      setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
      );
    }

    // Tuhotaan vielä lopuksi istunto.
    session_destroy();

  }


?>
