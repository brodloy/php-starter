<?php
/**
 * Shared form for BOTH create and edit. If $example is null we're creating;
 * otherwise we're editing that row. One view, two jobs — fewer files.
 * @var array|null $example
 */
$editing = $example !== null;
$action  = $editing ? url('/examples/' . $example['PK_ExampleID']) : url('/examples');
$title   = $editing ? $example['Title'] : old('title');
$body    = $editing ? ($example['Body'] ?? '') : old('body');
?>
<div class="mb-3"><a class="text-muted-2" href="<?= e(url('/examples')) ?>">&larr; Back to examples</a></div>
<h1 class="mb-4"><?= $editing ? 'Edit example' : 'New example' ?></h1>

<div class="card" style="max-width:640px;"><div class="card-body">
    <form method="post" action="<?= e($action) ?>">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input class="form-control<?= invalid_class('title') ?>" type="text" name="title" value="<?= e($title) ?>" autofocus>
            <?= field_error('title') ?>
        </div>
        <div class="mb-3">
            <label class="form-label">Body <span class="text-faint">(optional)</span></label>
            <textarea class="form-control" name="body" rows="5"><?= e($body) ?></textarea>
        </div>
        <?php if ($editing): ?>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select class="form-select" name="status">
                    <option value="active"   <?= $example['Status'] === 'active' ? 'selected' : '' ?>>Active</option>
                    <option value="archived" <?= $example['Status'] === 'archived' ? 'selected' : '' ?>>Archived</option>
                </select>
            </div>
        <?php endif; ?>
        <div class="d-flex gap-2">
            <button class="btn btn-primary" type="submit"><?= $editing ? 'Save changes' : 'Create' ?></button>
            <a class="btn btn-outline-secondary" href="<?= e(url('/examples')) ?>">Cancel</a>
        </div>
    </form>
</div></div>
<?php clear_old(); ?>
