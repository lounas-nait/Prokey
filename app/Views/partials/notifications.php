<?php foreach ($notifications as $notification): ?>
    <div class="alert alert-<?= htmlspecialchars($notification['type']) ?>">
        <?= htmlspecialchars($notification['message']) ?>
    </div>
<?php endforeach; ?>
