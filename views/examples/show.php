<?php /** @var array $example */ ?>
<div class="mb-3"><a class="text-muted-2" href="<?= e(url('/examples')) ?>">&larr; Back to examples</a></div>
<div class="d-flex align-items-start justify-content-between mb-3">
    <h1 class="mb-0"><?= e($example['Title']) ?></h1>
    <span class="badge-soft is-<?= e($example['Status']) ?>"><?= e(ucfirst($example['Status'])) ?></span>
</div>
<div class="card mb-3"><div class="card-body">
    <p class="mb-0" style="white-space:pre-wrap;"><?= e($example['Body'] ?? '') ?></p>
</div></div>
<div class="text-faint mb-4" style="font-size:.85rem;">Created <?= e(format_date($example['CreatedAt'])) ?></div>
<div class="d-flex gap-2">
    <a class="btn btn-outline-secondary" href="<?= e(url('/examples/' . $example['PK_ExampleID'] . '/edit')) ?>">Edit</a>
    <form method="post" action="<?= e(url('/examples/' . $example['PK_ExampleID'] . '/delete')) ?>"
          data-confirm="Delete this example?">
        <?= csrf_field() ?>
        <button type="submit" class="btn btn-outline-secondary text-danger">Delete</button>
    </form>
</div>
