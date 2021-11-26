<?php

  require_once HELPERS_DIR . 'DB.php';

    // esitellään lisaaHenkilo-funktio, joka lisää henkilön tietokantaan, kun henkilöstä annetaan 
    // parametreina nimi, puhelinnnumero, sähköpostiosoite ja salattu salasana. 
    // funktio palauttaa lisätyn henkilön id-henkilo-tunnisteen

  function lisaaHenkilo($nimi,$puhnro,$email,$salasana) {
    DB::run('INSERT INTO henkilot (nimi, puhnro, email, salasana) VALUE  (?,?,?,?);',[$nimi,$puhnro,$email,$salasana]);
    return DB::lastInsertId();
  }

  // esitellään haeHenkiloSahkopostilla- funktio, joka hakee tietokannasta kaikki ne henkilöt, joilla on 
  // parametrina annettu sähköposti ja palauttaa niista taulukon

  function haeHenkiloSahkopostilla($email) {
      return DB::run('SELECT * FROM henkilot WHERE email = ?;', [$email])->fetchAll();
  }

   // esitellään haeHenkiloPuhelinnumerolla- funktio, joka hakee tietokannasta kaikki ne henkilöt, joilla on 
  // parametrina annettu puhelinnumero ja palauttaa niista taulukon

  function haeHenkiloPuhelinnumerolla($puhnro) {
    return DB::run('SELECT * FROM henkilot WHERE puhnro = ?;', [$puhnro])->fetchAll();
  }

?>







