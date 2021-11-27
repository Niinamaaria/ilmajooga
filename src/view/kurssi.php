<?php $this->layout('template', ['title' => $kurssi['nimi']])?>

<?php
    $start = new DateTime($kurssi['kur_alkaa']);
    $end = new DateTime($kurssi['kur_loppuu']);
?>

<h1><?=$kurssi['nimi']?></h1>
<div><?=$kurssi['kuvaus']?></div>
<div>Alkaa: <?=$start->format('j.n.Y G:i')?></div>
<div>Loppuu: <?=$end->format('j.n.Y G:i')?></div>

<?php
if ($loggeduser) {
    if (!$ilmoittautuminen) {
      echo "<div class='flexarea'><a href='ilmoittaudu?id=$kurssi[idkurssi]' class='button'>ILMOITTAUDU</a></div>";    
    } else {
      echo "<div class='flexarea'>";
      echo "<div>Olet ilmoittautunut tapahtumaan!</div>";
      echo "<a href='peru?id=$kurssi[idkurssi]' class='button'>PERU ILMOITTAUTUMINEN</a>";
      echo "</div>";
    }
  }
?>



