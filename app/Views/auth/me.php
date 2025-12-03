<h2><?php echo $title ?></h2>

<p><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
<p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
<p><a href="<?php echo url('/projects'); ?>">Go to Projects</a></p>