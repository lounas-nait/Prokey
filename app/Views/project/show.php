<h2><?php echo htmlspecialchars($title) ?></h2>
<p>Description</p>
<p><?php echo htmlspecialchars($project['description']) ?></p>
<p>Created at: <?php echo htmlspecialchars($project['created_at']) ?></p>

<a href="<?php echo url('/projects/edit?id=' . $project['id']) ?>">Modifier le projet</a>

<a href="<?php echo url('/projects') ?>">Retour à la liste des projets</a>