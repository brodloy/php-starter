<?php /** @var array $rows */ ?>
<h1 class="mb-4">Files</h1>

<div class="card mb-4" style="max-width:640px;"><div class="card-body">
    <form method="post" action="<?= e(url('/uploads')) ?>" enctype="multipart/form-data" class="d-flex gap-2 align-items-end">
        <?= csrf_field() ?>
        <div class="flex-grow-1">
            <label class="form-label">Choose a file</label>
            <input class="form-control" type="file" name="file">
        </div>
        <button class="btn btn-primary" type="submit">Upload</button>
    </form>
</div></div>

<?php if ($rows === []): ?>
    <p class="text-muted-2">No files yet.</p>
<?php else: ?>
    <?php foreach ($rows as $f): ?>
        <div class="list-row">
            <div>
                <a class="title" href="<?= e(url('/uploads/' . $f['PK_UploadID'])) ?>"><?= e($f['OriginalName']) ?></a>
                <div class="text-faint" style="font-size:.82rem;">
                    <?= e(human_size((int) $f['Size'])) ?> · <?= e(format_date($f['CreatedAt'])) ?>
                </div>
            </div>
            <form method="post" action="<?= e(url('/uploads/' . $f['PK_UploadID'] . '/delete')) ?>"
                  data-confirm="Delete this file?">
                <?= csrf_field() ?>
                <button class="btn btn-sm btn-outline-secondary text-danger" type="submit">Delete</button>
            </form>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
