<?php $this->layout('template', ['title' => $kurssi['nimi']])?>

<?php
    $start = new DateTime($kurssi['kur_alkaa']);
    $end = new DateTime($kurssi['kur_loppuu']);
?>

<h1><?=$kurssi['nimi']?></h1>
<div><?=$kurssi['kuvaus']?></div>
<div>Alkaa: <?=$start->format('j.n.Y G:i')?></div>
<div>Loppuu: <?=$end->format('j.n.Y G:i')?></div>
<div>Ilmoittautuneita:<?=$ilmoittautuneita?>/<?=$kurssi['osallistujia']?></div>

<?php


/*if($loggeduser["admin"]) {
  echo "<div class='flexarea'><a href='poista?id=$kurssi[idkurssi]' class='button'>POISTA KURSSI</a></div>";
}
else if ($loggeduser) {
    if (!$ilmoittautuminen) {
      echo "<div class='flexarea'><a href='ilmoittaudu?id=$kurssi[idkurssi]' class='button'>ILMOITTAUDU</a></div>";    
    } else {
      echo "<div class='flexarea'>";
      echo "<div>Olet ilmoittautunut tapahtumaan!</div>";
      echo "<a href='peru?id=$kurssi[idkurssi]' class='button'>PERU ILMOITTAUTUMINEN</a>";
      echo "</div>";
    } 
  } */

if ($loggeduser) {
  // TÄHÄN muutettu /*(!$ilmoittautuminen)*/- kohta
    if ($naytailmoittautuminen)/*(!$ilmoittautuminen)*/ {
      echo "<div class='flexarea'><a href='ilmoittaudu?id=$kurssi[idkurssi]' class='button'>ILMOITTAUDU</a></div>";    
    } else {

      if(!$kurssitaynna) {
      echo "<div class='flexarea'>";
      echo "<div>Olet ilmoittautunut tapahtumaan!</div>";
      echo "<a href='peru?id=$kurssi[idkurssi]' class='button'>PERU ILMOITTAUTUMINEN</a>";
      echo "</div>";
    } else {
      echo "Valitettavasti kurssi on jo täynnä";
    }
  } 
  } 

?>





