<h2><?php echo $title ?></h2>

<a href="<?php echo url('/password-types/' . $password_type_id . '/fields/create'); ?>" class="btn btn-primary mb-3">Ajouter un champ</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nom de champs</th>
            <th>Label</th>
            <th>Type</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($fields as $field): ?>
            <tr>
                <td><?php echo htmlspecialchars($field['id']); ?></td>
                <td><?php echo htmlspecialchars($field['field_name']); ?></td>
                <td><?php echo htmlspecialchars($field['field_label']); ?></td>
                <td><?php echo htmlspecialchars($field['field_type']); ?></td>
                <td>
                    <a href="<?php echo url('/password-types/' . $password_type_id . '/fields/' . $field['id'] . '/edit'); ?>" class="btn btn-sm btn-warning">Éditer</a>

                    <form action="<?php echo url('/password-types/' . $password_type_id . '/fields/' . $field['id'] . '/delete'); ?>" method="POST" style="display:inline;">
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce champ ?');">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>