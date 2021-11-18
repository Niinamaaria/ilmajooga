<?php $this->layout('template', ['title' => 'Uudne tilin luonti']) 

// sivupohja, joka sisältää lomakekentät käyttäjältä kerättäville tiedoille.
// action-määrite on jätetty tyhjäksi, jolloin lomakkeen tiedot lähetetään samaan osoitteeseen, 
// mistä lomake on avattu. 
// Tiedot lähetetään POST-metodilla, jolloin loamkkeen tiedot lähetetään omana pakettinaan.
?>

<h1>Uuden tilin luonti</h1>

<form action="" method="POST">
    <div>
        <label for="name">Nimi:</label>
        <input type="text" id="name" name="name">
    </div>
    <div>
        <label for="email">Sähköposti:</label>
        <input type="email" id="email" name="email">
    </div>
    <div>
        <label for="phone">Puhelinnumero:</label>
        <input type="tel" id="phone" name="phone">
    </div>
    <div>
        <label for="password1">Salasana:</label>
        <input type="password" id="password1" name="password1">
    </div>
    <div>
        <label for="password2">Salasana uudelleen:</label>
        <input type="password" id="password2" name="password2">
    </div>
    <div>
        <input type="submit" name="send" value="Luo tili">
    </div>
</form>



