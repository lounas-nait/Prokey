<h2>Créer un projet</h2>
<form action="<?php echo url('/projects') ?>" method="POST">
    <label for="name">Nom du projet:</label><br>
    <input type="text" id="name" name="name" required><br><br>

    <label for="description">Description:</label><br>
    <textarea id="description" name="description" required></textarea><br><br>

    <input type="submit" value="Créer le projet">
</form>