<?php $this->layout('template_admin', ['title' => 'Tulevat kurssit']) ?>

<h1>Tervetuloa pääkäyttäjäsivulle</h1>

<h2>Tulevat kurssit</h2>

<div class='kurssit'>
    <?php

    // Lisätään sivupohjaan PHP-kodilohko, joka käy tapahtumat yksi kerrallaan läpi ja tulostaa 
    // tapahtumasta div-kokonaisuuden sisältöineen

    foreach ($kurssit as $kurssi) {

        $start = new DateTime($kurssi['kur_alkaa']);
        $end = new DateTime($kurssi['kur_loppuu']);

        echo "<div>";
            echo "<div>$kurssi[nimi]</div>";
            echo "<div>" . $start->format('j.n.Y') . "-" . $end->format('j.n.Y') . "</div>";

            // Lisätään linkitys omana div-elementtinään kurssin nimen ja päivämäärien jatkoksi
            // Linkin id-tunnuksen arvoksi tulee kurssitiedon id eli idkurssi-kentän arvo
            // joka on kurssi-tietokantataulun yksilöivä pääavain
            // Linkki on suhteellinen linkki samassa kansiossa olevaan toiseen sivuun 

            echo "<div><a href='kurssi?id=" . $kurssi['idkurssi'] . "'>TIEDOT</a></div>";
        echo "</div>";
    }

    ?>
    </div>