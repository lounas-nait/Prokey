<h2>Modifier le type de mot de passe : <?php htmlspecialchars($title) ?></h2>
<form method="POST" action="<?php echo url('/password-types/' . $password_type['id'] . '/update') ?>">
    <label for="label">Nom du type :</label>
    <input type="text" id="label" name="label" value="<?php echo htmlspecialchars($password_type['label']) ?>" required>

    <label for="color">Couleur :</label>
    <input type="text" id="color" name="color" value="<?php echo htmlspecialchars($password_type['color']) ?>" required>

    <button type="submit">Mettre à jour</button>
</form>