<?php

  require_once HELPERS_DIR . 'DB.php';

    // esitellään lisaaHenkilo-funktio, joka lisää henkilön tietokantaan, kun henkilöstä annetaan 
    // parametreina nimi, puhelinnnumero, sähköpostiosoite ja salattu salasana. 
    // funktio palauttaa lisätyn henkilön id-henkilo-tunnisteen

  function lisaaHenkilo($nimi,$puhnro,$email,$salasana) {
    DB::run('INSERT INTO henkilot (nimi, puhnro, email, salasana) VALUE  (?,?,?,?);',[$nimi,$puhnro,$email,$salasana]);
    return DB::lastInsertId();
  }


  // Esitellään haeHenkilo- funktio, joka hakee tietokannasta henkilöt, joilla on parametrina annettu sähköposti
  // ja palauttaa niistä kaikkien rivien sijaan ensimmäisen rivin. 
  // Tämä riittää, koska tietokannassa ei saa olla kahta tai usemapaa käyttäjää, joilla on sama shäköpostiosoite

  function haeHenkilo($email) {
      return DB::run('SELECT * FROM henkilot WHERE email = ?;', [$email])->fetch();
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

  // paivitaVahvavain-funktio päivittää vahvistusavaimen tietokantaan käyttäjän sähköpostiosoitteen perusteella.
  // Tätä käytetään generoidun vahvistusavaimen tallentamiseen silloin kun tiliä luodaan
  // tai käyttäjä pyytää uutta vahvistusavainta.


  function paivitaVahvavain($email,$avain) {
    return DB::run('UPDATE henkilot SET vahvavain = ? WHERE email = ?', [$avain,$email])->rowCount();
  }

  // vahvistaTili-funktio vahvistaa käyttäjän tilin määrittelemällä vahvistettu-arvon todeksi.
  // Muutosrivi etsitään vahvistusavaimella, koska vahvistuslinkissä ei saa tietoturvasyistä
  // ilmetä käyttäjän sähköpostiosoite.

  function vahvistaTili($avain) {
    return DB::run('UPDATE henkilot SET vahvistettu = TRUE WHERE vahvavain = ?', [$avain])->rowCount();
  }


?>







