<header>

    <nav class="navbar">
        <div class="navbar-left">
            <a href="/prokey/public/" class="navbar-brand">ProKey</a>
        </div>
        <div class="navbar-right">
            <?php if (isset($user)): ?>
                <span class="navbar-user">Hello, <?= htmlspecialchars($user['name']) ?></span>
                <a href="<?php echo url('/logout') ?>" class="navbar-link">Logout</a>
            <?php else: ?>
                <a href="<?php echo url('/login') ?>" class="navbar-link">Login</a>
            <?php endif; ?>
        </div>
    </nav>  
</header