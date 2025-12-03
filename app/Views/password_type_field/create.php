<h2><?php echo $title ?></h2>

<form action="<?php echo url('/password-types/' . $password_type_id . '/fields/store'); ?>" method="POST">

    <div class="mb-3">
        <label for="field_name" class="form-label">Nom du champ</label>
        <input type="text" class="form-control" id="field_name" name="field_name" required>
    </div>
    
    <div class="mb-3">
        <label for="field_label" class="form-label">Label du champ</label>
        <input type="text" class="form-control" id="field_label" name="field_label" required>
    </div>
    <div class="mb-3">
        <label for="field_type" class="form-label">Type de champ</label>
        <select class="form-select" id="field_type" name="field_type" required>
            <option value="text">Texte</option>
            <option value="textarea">Texte long</option>
            <option value="number">Nombre</option>
            <option value="password">Mot de passe</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Ajouter le champ</button>
</form>