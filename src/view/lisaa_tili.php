<?php $this->layout('template', ['title' => 'Uuden tilin luonti']) 

// sivupohja, joka sisältää lomakekentät käyttäjältä kerättäville tiedoille.
// action-määrite on jätetty tyhjäksi, jolloin lomakkeen tiedot lähetetään samaan osoitteeseen, 
// mistä lomake on avattu. 
// Tiedot lähetetään POST-metodilla, jolloin loamkkeen tiedot lähetetään omana pakettinaan.
?>

<h1>Uuden tilin luonti</h1>

<form action="" method="POST">
    <div>
        <label for="nimi">Nimi:</label>
        <input type="text" id="nimi" name="nimi">
        <div class="error"><span><?= getValue($error,'nimi'); ?></span></div>
    </div>
    <div>
        <label for="puhnro">Puhelinnumero:</label>
        <input type="text" id="puhnro" name="puhnro">
        <div class="error"><?= getValue($error,'puhnro'); ?></div>
    </div>
    <div>
        <label for="email">Sähköposti:</label>
        <input type="email" id="email" name="email">
        <div class="error"><?= getValue($error,'email'); ?></div>
    </div>
    <div>
        <label for="salasana1">Salasana:</label>
        <input type="password" id="salasana1" name="salasana1">
        <div class="error"><?= getValue($error,'salasana'); ?></div>
    </div>
    <div>
        <label for="salasana2">Salasana uudelleen:</label>
        <input type="password" id="salasana2" name="salasana2">
    </div>
    <div>
        <input type="submit" name="laheta" value="Luo tili">
    </div>
</form>



