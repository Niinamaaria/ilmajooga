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
            
    </header>
    <section>
        <?=$this->section('content')?>
    </section>
    <footer>
        <hr>
        <div>Ilmajoogatapahtuma Ilma by Joogastudio Nisaya</div>
        <image src="../ilmajooga/public/images/yoga5.jpg" alt="Yoga">
            <p>image by: Oksana Taran
    </footer>
</body>
</html>