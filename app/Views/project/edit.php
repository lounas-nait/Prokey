<h2>Modifier le projet : <?php htmlspecialchars($title) ?></h2>
<form method="POST" action="<?php echo url('/projects/update?id=' . $project['id']) ?>">
    <label for="name">Nom du projet :</label>
    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($project['name']) ?>" required>

    <label for="description">Description :</label>
    <textarea id="description" name="description" required><?php echo htmlspecialchars($project['description']) ?></textarea>

    <button type="submit">Mettre à jour le projet</button>
</form>