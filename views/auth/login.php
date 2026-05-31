<div class="auth-wrap"><div class="auth-card">
    <h1>Welcome back</h1>
    <p class="auth-sub">Sign in to your <?= e(config('app_name')) ?> account</p>
    <div class="card"><div class="card-body">
        <form method="post" action="<?= e(url('/login')) ?>">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input class="form-control" type="email" name="email" value="<?= e(old('email')) ?>" autofocus>
            </div>
            <div class="mb-3">
                <div class="d-flex justify-content-between">
                    <label class="form-label">Password</label>
                    <a class="small" href="<?= e(url('/forgot')) ?>">Forgot?</a>
                </div>
                <input class="form-control" type="password" name="password">
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="remember" value="1" id="remember">
                <label class="form-check-label" for="remember" style="font-size:.9rem;">Remember me</label>
            </div>
            <button class="btn btn-primary w-100" type="submit">Sign in</button>
        </form>

        <?php if (config('google_enabled')): ?>
            <div class="divider">or</div>
            <a class="btn btn-google" href="<?= e(url('/auth/google')) ?>">
                <svg width="16" height="16" viewBox="0 0 18 18" aria-hidden="true"><path fill="#4285F4" d="M17.6 9.2c0-.6-.1-1.2-.2-1.8H9v3.5h4.8a4.1 4.1 0 0 1-1.8 2.7v2.2h2.9c1.7-1.6 2.7-3.9 2.7-6.6z"/><path fill="#34A853" d="M9 18c2.4 0 4.5-.8 6-2.2l-2.9-2.2c-.8.5-1.8.9-3.1.9-2.4 0-4.4-1.6-5.1-3.8H.8v2.3A9 9 0 0 0 9 18z"/><path fill="#FBBC05" d="M3.9 10.7a5.4 5.4 0 0 1 0-3.4V5H.8a9 9 0 0 0 0 8z"/><path fill="#EA4335" d="M9 3.6c1.3 0 2.5.5 3.4 1.3l2.6-2.6A9 9 0 0 0 .8 5l3.1 2.3C4.6 5.2 6.6 3.6 9 3.6z"/></svg>
                Continue with Google
            </a>
        <?php endif; ?>
    </div></div>
    <p class="text-center text-muted-2 mt-3 mb-0" style="font-size:.92rem;">
        New here? <a href="<?= e(url('/register')) ?>">Create an account</a>
    </p>
</div></div>
<?php clear_old(); ?>
