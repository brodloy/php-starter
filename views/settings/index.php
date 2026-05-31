<?php /** @var array $user */ ?>
<h1 class="mb-4">Account settings</h1>

<div class="row g-4" style="max-width:760px;">
    <!-- Profile -->
    <div class="col-12">
        <div class="card"><div class="card-body">
            <h3 class="mb-3" style="font-size:1.15rem;">Profile</h3>
            <form method="post" action="<?= e(url('/settings/profile')) ?>">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input class="form-control<?= invalid_class('name') ?>" type="text" name="name"
                           value="<?= e(old('name', $user['Name'])) ?>">
                    <?= field_error('name') ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input class="form-control<?= invalid_class('email') ?>" type="email" name="email"
                           value="<?= e(old('email', $user['Email'])) ?>">
                    <?= field_error('email') ?>
                </div>
                <button class="btn btn-primary" type="submit">Save profile</button>
            </form>
        </div></div>
    </div>

    <!-- Password -->
    <div class="col-12">
        <div class="card"><div class="card-body">
            <h3 class="mb-3" style="font-size:1.15rem;">Password</h3>
            <form method="post" action="<?= e(url('/settings/password')) ?>">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label class="form-label">Current password</label>
                    <input class="form-control<?= invalid_class('current_password') ?>" type="password" name="current_password">
                    <?= field_error('current_password') ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">New password</label>
                    <input class="form-control<?= invalid_class('new_password') ?>" type="password" name="new_password">
                    <div class="form-text">At least 8 characters.</div>
                    <?= field_error('new_password') ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Confirm new password</label>
                    <input class="form-control<?= invalid_class('new_password_confirm') ?>" type="password" name="new_password_confirm">
                    <?= field_error('new_password_confirm') ?>
                </div>
                <button class="btn btn-primary" type="submit">Change password</button>
            </form>
        </div></div>
    </div>
</div>
<?php clear_old(); ?>
