<?php

  require_once HELPERS_DIR . 'DB.php';

    // esitellään lisaaHenkilo-funktio, joka lisää henkilön tietokantaan, kun henkilöstä annetaan 
    // parametreina nimi, puhelinnnumero, sähköpostiosoite ja salattu salasana. 
    // funktio palauttaa lisätyn henkilön id-henkilo-tunnisteen

  function lisaaHenkilo($nimi,$puhnro,$email,$salasana) {
    DB::run('INSERT INTO henkilot (nimi, puhnro, email, salasana) VALUE  (?,?,?,?);',[$nimi,$puhnro,$email,$salasana]);
    return DB::lastInsertId();
  }

?>







