<?php $this->layout('template', ['title' => 'Tili luotu']) ?>

<h1>Sinulle on luotu uusi tili!</h1>

<p>Sinun tulee vahvistaa sähköpostiosoitteesi ennen, kuin voit käyttää
tiliäsi. Olet saanut sähköpostiisi (<?= getValue($formdata,'email') ?>)
vahvistusviestin. Ole hyvä ja käy vahvistamassa sähköpostiosoitteesi klikkaamalla
viestissä olevaa linkkiä.</p>
