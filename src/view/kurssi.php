<?php $this->layout('template', ['title' => $kurssi['nimi']])?>

<?php
    $start = new DateTime($kurssi['kur_alkaa']);
    $end = new DateTime($kurssi['kur_loppuu']);
?>

<h1><?=$kurssi['nimi']?></h1>
<div><?=$kurssi['kuvaus']?></div>
<div>Alkaa: <?=$start->format('j.n.Y G:i')?></div>
<div>Loppuu: <?=$end->format('j.n.Y G:i')?></div>
