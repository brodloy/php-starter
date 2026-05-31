<?php /** Landing page content (wrapped by the public layout). */ ?>
<section class="hero dot-grid">
    <div class="container" style="max-width: 760px;">
        <span class="eyebrow">PHP 8 · no framework</span>
        <h1>The calm starting point<br>for your next PHP app.</h1>
        <p class="lead">
            A slim, readable, hand-assembled PHP 8 starter — authentication,
            a clean database layer, and a tidy structure, with no framework
            magic to fight.
        </p>
        <div class="d-flex gap-2 justify-content-center">
            <a class="btn btn-primary px-4" href="<?= e(url('/register')) ?>">Get started</a>
            <a class="btn btn-outline-secondary px-4" href="<?= e(url('/login')) ?>">Sign in</a>
        </div>
    </div>
</section>

<section class="container pb-5" style="max-width: 880px;">
    <div class="row g-4">
        <div class="col-md-4"><div class="card feature-card h-100"><div class="card-body">
            <h3>Readable</h3>
            <p class="text-muted-2 mb-0">One small router, one entry point. You can read the whole thing in an afternoon.</p>
        </div></div></div>
        <div class="col-md-4"><div class="card feature-card h-100"><div class="card-body">
            <h3>Secure by default</h3>
            <p class="text-muted-2 mb-0">CSRF, argon2id, prepared statements, rate limiting and security headers from the start.</p>
        </div></div></div>
        <div class="col-md-4"><div class="card feature-card h-100"><div class="card-body">
            <h3>Yours to grow</h3>
            <p class="text-muted-2 mb-0">Copy the Example section to build your own. A new page is a route plus a method.</p>
        </div></div></div>
    </div>
</section>
