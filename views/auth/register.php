<div class="auth-wrap"><div class="auth-card">
    <h1>Create your account</h1>
    <p class="auth-sub">Start using <?= e(config('app_name')) ?></p>
    <div class="card"><div class="card-body">
        <form method="post" action="<?= e(url('/register')) ?>">
            <?= csrf_field() ?>
            <div class="mb-3"><label class="form-label">Name</label>
                <input class="form-control<?= invalid_class('name') ?>" type="text" name="name" value="<?= e(old('name')) ?>">
                <?= field_error('name') ?></div>
            <div class="mb-3"><label class="form-label">Email</label>
                <input class="form-control<?= invalid_class('email') ?>" type="email" name="email" value="<?= e(old('email')) ?>">
                <?= field_error('email') ?></div>
            <div class="mb-3"><label class="form-label">Password</label>
                <input class="form-control<?= invalid_class('password') ?>" type="password" name="password">
                <div class="form-text">At least 8 characters.</div>
                <?= field_error('password') ?></div>
            <div class="mb-3"><label class="form-label">Confirm password</label>
                <input class="form-control<?= invalid_class('password_confirm') ?>" type="password" name="password_confirm">
                <?= field_error('password_confirm') ?></div>
            <button class="btn btn-primary w-100" type="submit">Create account</button>
        </form>
    </div></div>
    <p class="text-center text-muted-2 mt-3 mb-0" style="font-size:.92rem;">
        Already have an account? <a href="<?= e(url('/login')) ?>">Sign in</a>
    </p>
</div></div>
<?php clear_old(); ?>
