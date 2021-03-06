<?php

function lisaaTili($formdata, $baseurl='') {

  // $baseurl on parametri, jossa välitetään sivuston osoitteen perusosa.
  // Tämä tieto on config-asetuksissa, mutta se ei välitys suoraan tälle funktiolle,
  // koska se on tallennettu tavalliseen muuttujaan.
  // Oletusarvona sille annetaan tyhjä merkkijono, jolloin sivusto on lähtökohtaisesti palvelimen juuressa.

  // Tuodaan henkilo-mallin funktiot, joilla voidaan lisätä
  // henkilön tiedot tietokantaan.
  require_once(MODEL_DIR . 'henkilo.php');

  // Alustetaan virhetaulukko, joka palautetaan lopuksi joko
  // tyhjänä tai virheillä täytettynä.
  $error = [];

  // Seuraavaksi tehdään lomaketietojen tarkistus. Tarkistusten
  // periaate on jokaisessa kohdassa sama. Jos kentän arvo
  // ei täytä tarkistuksen ehtoja, niin error-taulukkoon
  // lisätään virhekuvaus. Lopussa error-taulukko on tyhjä, jos
  // kaikki kentät menivät tarkistuksesta lävitse.

  // Tarkistetaan onko nimi määritelty ja se täyttää mallin.
  if (!isset($formdata['nimi']) || !$formdata['nimi']) {
    $error['nimi'] = "Anna nimesi.";
  } else {
    if (!preg_match("/^[- '\p{L}]+$/u", $formdata["nimi"])) {
      $error['nimi'] = "Syötä nimesi ilman erikoismerkkejä.";
    }
  }

  // Tarkistetaan, että puhelinnumero on määritelty ja se on
  // muodossa 0401234567489.
  if (!isset($formdata['puhnro']) || !$formdata['puhnro']) {
    $error['puhnro'] = "Anna puhelinnumerosi muodossa 040123456789.";
  } else {
    if (!preg_match("/^[0-9]{1,}/",$formdata['puhnro'])) {
      $error['puhnro'] = "Puhelinnumerosi muoto on virheellinen.";
    } else {
        if (haeHenkiloPuhelinnumerolla($formdata['puhnro'])) {
            $error['puhnro'] = "Puhelinnumero on jo käytössä.";
        }
    }
  }

  // Tarkistetaan, että sähköpostiosoite on määritelty ja se on
  // oikeassa muodossa.
  if (!isset($formdata['email']) || !$formdata['email']) {
    $error['email'] = "Anna sähköpostiosoitteesi.";
  } else {
    if (!filter_var($formdata['email'], FILTER_VALIDATE_EMAIL)) {
      $error['email'] = "Sähköpostiosoite on virheellisessä muodossa.";
    } else {
      if (haeHenkiloSahkopostilla($formdata['email'])) {
        $error['email'] = "Sähköpostiosoite on jo käytössä.";
      }
    }
  }

  // Tarkistetaan, että kummatkin salasanat on annettu ja että
  // ne ovat keskenään samat.
  if (isset($formdata['salasana1']) && $formdata['salasana1'] &&
      isset($formdata['salasana2']) && $formdata['salasana2']) {
    if ($formdata['salasana1'] != $formdata['salasana2']) {
      $error['salasana'] = "Salasanasi eivät olleet samat!";
    }
  } else {
    $error['salasana'] = "Syötä salasanasi kahteen kertaan.";
  }

  // Lisätään tiedot tietokantaan, jos edellä syötettyissä
  // tiedoissa ei ollut virheitä eli error-taulukosta ei
  // löydy virhetekstejä.
  if (!$error) {

    // Haetaan lomakkeen tiedot omiin muuttujiinsa.
    // Salataan salasana myös samalla.
    $nimi = $formdata['nimi'];
    $puhnro = $formdata['puhnro'];
    $email = $formdata['email'];
    $salasana = password_hash($formdata['salasana1'], PASSWORD_DEFAULT);

    // Lisätään henkilö tietokantaan. Jos lisäys onnistui,
    // tulee palautusarvona lisätyn henkilön id-tunniste.
    $idhenkilo = lisaaHenkilo($nimi,$puhnro,$email,$salasana);

    // Palautetaan JSON-tyyppinen taulukko, jossa:
    //  status   = Koodi, joka kertoo lisäyksen onnistumisen.
    //             Hyvin samankaltainen kuin HTTP-protokollan
    //             vastauskoodi.
    //             200 = OK
    //             400 = Bad Request
    //             500 = Internal Server Error
    //  id       = Lisätyn rivin id-tunniste.
    //  formdata = Lisättävän henkilön lomakedata. Sama, mitä
    //             annettiin syötteenä.
    //  error    = Taulukko, jossa on lomaketarkistuksessa
    //             esille tulleet virheet.


    // Tarkistetaan onnistuiko henkilön tietojen lisääminen.
    // Jos idhenkilo-muuttujassa on positiivinen arvo,
    // onnistui rivin lisääminen. Muuten liäämisessä ilmeni
    // ongelma.

    if($idhenkilo) {

      // Luodaan käyttäjälle aktivointiavain ja muodostetaan
      // aktivointilinkki.

      require_once(HELPERS_DIR . "secret.php");
      $avain = generateActivationCode($email);
      $url = 'https://' . $_SERVER['HTTP_HOST'] . $baseurl . "/vahvista?key=$avain";

      // Päivitetään aktivointiavain tietokantaan ja lähetetään
      // käyttäjälle sähköpostia. Jos tämä onnistui, niin palautetaan
      // palautusarvona tieto tilin onnistuneesta luomisesta. Muuten
      // palautetaan virhekoodi, joka ilmoittaa, että jokin
      // lisäyksessä epäonnistui.

      if(paivitaVahvavain($email,$avain) && lahetaVahvavain($email,$url)) {
        return [
          "status"  => 200,
          "id"      => $idhenkilo,
          "data"    => $formdata
        ];
      } else {
        return [
          "status"  => 500,
          "data"    => $formdata
        ];
      }
    }

    /*

    if ($idhenkilo) {
      return [
        "status" => 200,
        "id"     => $idhenkilo,
        "data"   => $formdata
      ];
    } else {
      return [
        "status" => 500,
        "data"   => $formdata
      ];
    }


       */

  } else {


    // Lomaketietojen tarkistuksessa ilmeni virheitä.
    return [
      "status" => 400,
      "data"   => $formdata,
      "error"  => $error
    ];

  } 
}

// Vahvistussähköpostin lähetyksen hoitava funktio.
// Tämä funktio lähettää esimääritellyn tekstin annettuun sähköpostiosoitteeseen.
// Funktio sisällyttää tekstin keskelle annetun url-osoitteen, joka on käyttäjälle muodostettu aktivointilinkki.
// Funktio palauttaa totuusarvon tosi, jos sähköposti hyväksyttiin lähettäväksi.

function lahetaVahvavain($email,$url) {
  $message = "Hei!\n\n" . 
             "Olet rekisteröitynyt Joogastudio Nisayan-palveluun tällä\n" . 
             "sähköpostiosoitteella. Klikkaamalla alla olevaa\n" . 
             "linkkiä, vahvistat käyttämäsi sähköpostiosoitteen\n" .
             "ja pääset käyttämään Nisayan palvelua.\n\n" . 
             "$url\n\n" .
             "Jos et ole rekisteröitynyt Joogastudio Nisayan palveluun, niin\n" . 
             "silloin tämä sähköposti on tullut sinulle\n" .
             "vahingossa. Siinä tapauksessa ole hyvä ja\n" .
             "poista tämä viesti.\n\n".
             "Terveisin, Joogastudio Nisaya";
  return mail($email,'Joogastudio Nisayan-tilin aktivointilinkki',$message);
}


?>
