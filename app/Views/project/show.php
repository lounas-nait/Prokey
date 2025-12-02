<h2><?php echo htmlspecialchars($title) ?></h2>
<p>Description</p>
<p><?php echo htmlspecialchars($project['description']) ?></p>
<p>Created at: <?php echo htmlspecialchars($project['created_at']) ?></p>

<a href="<?php echo url('/projects/' . $project['id'] . '/edit') ?>">Modifier le projet</a>

<form action="<?php echo url('/projects/' . $project['id'] . '/delete') ?>" method="POST" style="display:inline;">
    <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce projet ?')">Supprimer le projet</button>
</form>

<a href="<?php echo url('/projects') ?>">Retour à la liste des projets</a>