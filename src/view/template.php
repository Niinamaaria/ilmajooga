<!DOCTYPE html>
<html lang="fi">
    <head>
        <link href="styles/styles.css" rel="stylesheet">
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

    <section>
        <?=$this->section('content')?>
    </section>
    <footer>
        <hr>
        <div>Ilmajoogatapahtuma Ilma by Joogastudio Nisaya</div>
        <image src="../ilmajooga/public/images/yoga1.jpg" alt="Yoga">
        <image src="../ilmajooga/public/images/yoga2.jpg" alt="Yoga">
        <image src="../ilmajooga/public/images/yoga3.jpg" alt="Yoga">
            <p>Photo by <a href="https://unsplash.com/@wesleyphotography?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Wesley Tingey</a> on <a href="https://unsplash.com/s/photos/yoga?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a>
            <p>Photo by <a href="https://unsplash.com/@jareddrice?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Jared Rice</a> on <a href="https://unsplash.com/s/photos/yoga?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a>
            <p>Photo by <a href="https://unsplash.com/@kikekiks?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">kike vega</a> on <a href="https://unsplash.com/s/photos/yoga?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a>
    </footer>
</body>
</html>