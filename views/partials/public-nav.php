<?php /** Public top nav. Links depend on whether someone is logged in. */ ?>
<nav class="site-nav">
    <div class="container d-flex align-items-center justify-content-between py-3" style="max-width: 960px;">
        <a class="brand" href="<?= e(url('/')) ?>"><?= e(config('app_name')) ?></a>
        <div class="d-flex align-items-center gap-3">
            <?php if (current_user() !== null): ?>
                <a class="nav-link d-inline" href="<?= e(url('/dashboard')) ?>">Dashboard</a>
            <?php else: ?>
                <a class="nav-link d-inline" href="<?= e(url('/login')) ?>">Sign in</a>
                <a class="btn btn-primary btn-sm" href="<?= e(url('/register')) ?>">Get started</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
