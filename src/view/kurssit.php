
<?php $this->layout('template', ['title' => 'Tulevat kurssit']) ?>

<h1>Tulevat kurssit</h1>

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
        echo "</div>";
    }

    ?>
    </div>
