<?php

  require_once HELPERS_DIR . 'DB.php';

    // haeIlmoittautuminen- funktio hakee käyttäjän ilmoittautumisen yksittäiselle kurssille
    // Kurssin tiedot palautetaan funktion palautusarvona

  function haeIlmoittautuminen($idhenkilo,$idkurssi) {
    return DB::run('SELECT * FROM ilmoittautumiset WHERE idhenkilo = ? AND idkurssi = ?',
                   [$idhenkilo, $idkurssi])->fetchAll();
  }

  // lisaaIlmoittautuminen- funktio ilmoittaa käyttäjän kurssin lisäämällä ilmoittautumiset- tauluun
  // yhteyden käyttäjän ja tapahtuman välille.
  // Tietokantamalli sallii periaatteessa käyttäjän ilmoittautuvan useamman kerran samaan tapahtumaan,
  // mutta ilmoittautuminen käsitellään ainoastaan yksittäisenä riippumatta rivien määrästä.
  // Funktio lisätyn rivin idilmoittautuminen-kentän arvon, joka on generoitu lisäyksen yhteydessä.

  function lisaaIlmoittautuminen($idhenkilo,$idkurssi) {
    DB::run('INSERT INTO ilmoittautumiset (idhenkilo, idkurssi) VALUE (?,?)',
            [$idhenkilo, $idkurssi]);
    return DB::lastInsertId();
  }

  // poistaIlmoittautuminen-funktio poistaa käyttäjän ilmoittautumisen tapahtumasta. 
  // Jos käyttäjällä on useampi ilmoittautumisrivi tapahtumaan, niin ne kaikki poistetaan.
  // Funktio palauttaa poistettujen rivien lukumäärän.

  function poistaIlmoittautuminen($idhenkilo, $idkurssi) {
    return DB::run('DELETE FROM ilmoittautumiset  WHERE idhenkilo = ? AND idkurssi = ?',
                   [$idhenkilo, $idkurssi])->rowCount();
  }

?>
