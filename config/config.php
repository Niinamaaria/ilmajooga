<?php

// Tämä esittelee $config-nimisen taulukon ja antaa arvoksi projektissa käytettävät arvot
// TOdellisuudessa se on moniulotteinen taulukko, mutta riittää tietää että sen arvoja kutsutaan alkion nimillä
// kuten esim: $config['urls]['baseUrl]

$config = array(
    "urls" => array(
        "baseUrl" => "/~nkettune/ilmajooga"
    )
);

// Tässä määritellään joukko vakioita, joissa määritellään hakemistopolut sovelluksen eri palikoille
// Sovelluksessa joudutaan viittaamaan useammassa skriptissä projektin eri hakemistoihin, 
// kuten tietokantaa käsitteleviin malleihin tai sivurunkoihin, joista sivut muodostetaan. 
// Jatkossa ylläpidettävyyden kannalta on helpompaa määritellä projektin kansioille vakiot
// joita käytetään jatkossa näihin kansioihin viitattaessa

define("PROJECT_ROOT", dirname(__DIR__) . "/");
define("HELPERS_DIR", PROJECT_ROOT . "src/helpers/");
define("TEMPLATE_DIR", PROJECT_ROOT . "src/view/");
define("MODEL_DIR", PROJECT_ROOT . "src/model/");
define("CONTROLLER_DIR", PROJECT_ROOT . "src/controller/");


?>
