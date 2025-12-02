<h2>Liste des type de mot de passe</h2>

<a href="<?php echo url('/password-types/create') ?>">Créer un type de mot de passe</a>

<table>
    <tr>
        <th>ID</th>
        <th>Nom du Type</th>
        <th>Couleur</th>
    </tr>
    <?php foreach ($password_types as $password_type): ?>
    <tr>
        <td><?= htmlspecialchars($password_type['id']) ?></td>
        <td><?= htmlspecialchars($password_type['label']) ?></td>
        <td><?= htmlspecialchars($password_type['color']) ?></td>
    </tr>
    <?php endforeach; ?>
</table>