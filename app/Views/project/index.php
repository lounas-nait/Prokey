<h2>Liste des projets</h2>


<table>
    <tr>
        <th>ID</th>
        <th>Nom du projet</th>
        <th>Description</th>
        <th>Date de création</th>
    </tr>
    <?php foreach ($projects as $project): ?>
    <tr>
        <td><?= htmlspecialchars($project['id']) ?></td>
        <td><?= htmlspecialchars($project['name']) ?></td>
        <td><?= htmlspecialchars($project['description']) ?></td>
        <td><?= htmlspecialchars($project['created_at']) ?></td>
    </tr>
    <?php endforeach; ?>
</table>