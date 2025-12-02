<h2><?php echo $title ?></h2>
<form action="<?php echo url('/password-types') ?>" method="POST">
    <label for="label">Nom du type de mot de passe:</label><br>
    <input type="text" id="label" name="label" required><br><br>

    <label for="color">Couleur:</label><br>
    <input type="text" id="color" name="color" required><br><br>

    <input type="submit" value="Créer le projet">
</form>