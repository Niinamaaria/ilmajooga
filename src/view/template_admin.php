<!DOCTYPE html>
<html lang="fi">
<head>
  <link rel="stylesheet" href="https://neutroni.hayo.fi/~nkettune/ilmajooga/public/styles/styles.css">
</head>
    <head>
        <title>Ilmajoogatapahtuma Ilmalento - <?$this->e($title)?></title>
        <meta charset="UTF-8">
    </head>
<body>
<header>
      <h1><a href="<?=BASEURL?>">Ilmajoogatapahtuma Ilma</a></h1>
      <div class="profile">
        <?php
          if (isset($_SESSION['user'])) {
            echo "<div>$_SESSION[user]</div>";
            echo "<div><a href='logout'>Kirjaudu ulos</a></div>";
          } else {
            echo "<div><a href='kirjaudu'>Kirjaudu</a></div>";
          }
        ?>
      </div>
    </header>

    <div class="adminbutton">
    <button onclick="goBack()">Takaisin</button>

    <script>
    function goBack() {
     window.history.back();
    }
    </script>
    </div>
    <section>
        <?=$this->section('content')?>
    </section>
    <footer>
        <hr>
        <div>Ilmajoogatapahtuma Ilma by Joogastudio Nisaya</div>
        
        <image class="admin" src="https://neutroni.hayo.fi/~nkettune/ilmajooga/public/images/yoga_admin.jpg" alt="Yoga">
        
        <p>Photo by <a href="https://unsplash.com/@raimondklavins?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Raimond Klavins</a> on <a href="https://unsplash.com/s/photos/yoga?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a>
  
    </footer>
</body>
</html>