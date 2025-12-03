<h2><?php echo htmlspecialchars($title) ?></h2>
<p>Description</p>
<p><?php echo htmlspecialchars($project['description']) ?></p>
<p>Created at: <?php echo htmlspecialchars($project['created_at']) ?></p>

<h3>Mot de passe du projet</h3>
<a href="<?php echo url('/projects/' . $project_id . '/passwords/create') ?>">Ajouter un nouveau mot de passe</a>
<?php if (empty($passwords)): ?>
    <p>Aucun mot de passe associé à ce projet.</p>
<?php else: ?>
    <table>
        <tr>
            <th>Types</th>
            <th>Label</th>
            <th>Champs</th>
            <th>Action</th>
        </tr>
        <?php foreach ($passwords as $password): ?>
            <tr style="background: <?php echo $password['type_color'] ?>">
                <td ><?php echo htmlspecialchars($password['type_label']) ?></td>
                <td><?php echo htmlspecialchars($password['label']) ?></td>
                <td>
                    <?php 
                        $extra = json_decode($password['extra'], true);
                        foreach ($extra as $key => $value) {
                            echo '<strong>' . htmlspecialchars($key) . ':</strong> ' . htmlspecialchars($value) . '<br>';
                        }
                    ?>
                </td>
                <td>
                    <a href="<?php echo url('/projects/'. $project_id . '/passwords/' . $password['id'] . '/edit') ?>">Modifier</a>
                    <form action="<?php echo url('/projects/'. $project_id . '/passwords/' . $password['id'] . '/delete') ?>" method="POST" style="display:inline;">
                        <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce mot de passe ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

<a href="<?php echo url('/projects/' . $project['id'] . '/edit') ?>">Modifier le projet</a>

<form action="<?php echo url('/projects/' . $project['id'] . '/delete') ?>" method="POST" style="display:inline;">
    <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce projet ?')">Supprimer le projet</button>
</form>

<a href="<?php echo url('/projects') ?>">Retour à la liste des projets</a>