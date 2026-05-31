<?php
/** @var array $user @var int $exampleCount */
?>
<div class="mb-4">
    <h1>Good to see you, <?= e($user['Name']) ?></h1>
    <p class="text-muted-2">Here's a quick look at your workspace.</p>
</div>
<div class="row g-3 mb-4">
    <div class="col-sm-6"><div class="card h-100"><div class="card-body">
        <div class="text-faint" style="font-size:.85rem;">Your examples</div>
        <div style="font-size:2rem;font-weight:700;"><?= e((string) $exampleCount) ?></div>
        <a href="<?= e(url('/examples')) ?>">View all &rarr;</a>
    </div></div></div>
    <div class="col-sm-6"><div class="card h-100"><div class="card-body">
        <div class="text-faint" style="font-size:.85rem;">Account</div>
        <div class="fw-medium mt-1"><?= e($user['Email']) ?></div>
        <div class="text-muted-2" style="font-size:.9rem;">Role: <?= e($user['Role']) ?></div>
    </div></div></div>
</div>
<div class="card"><div class="card-body">
    <h3>Next steps</h3>
    <p class="text-muted-2 mb-2">To build your own section, copy the Example set:</p>
    <ul class="text-muted-2 mb-0">
        <li>add routes in <code>routes.php</code></li>
        <li>copy <code>app/Controllers/ExampleController.php</code></li>
        <li>copy the views in <code>views/examples/</code></li>
    </ul>
</div></div>
