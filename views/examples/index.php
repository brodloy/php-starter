<?php /** @var array $result  (from db()->paginate) */
$rows = $result['rows']; ?>
<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="mb-0">Examples</h1>
    <a class="btn btn-primary" href="<?= e(url('/examples/create')) ?>">New example</a>
</div>

<?php if ($rows === []): ?>
    <div class="card"><div class="card-body text-center py-5">
        <p class="text-muted-2 mb-3">You don't have any examples yet.</p>
        <a class="btn btn-primary" href="<?= e(url('/examples/create')) ?>">Create your first one</a>
    </div></div>
<?php else: ?>
    <?php foreach ($rows as $row): ?>
        <div class="list-row">
            <div>
                <a class="title" href="<?= e(url('/examples/' . $row['PK_ExampleID'])) ?>"><?= e($row['Title']) ?></a>
                <div class="text-faint" style="font-size:.82rem;">Updated <?= e(format_date($row['UpdatedAt'])) ?></div>
            </div>
            <span class="badge-soft is-<?= e($row['Status']) ?>"><?= e(ucfirst($row['Status'])) ?></span>
        </div>
    <?php endforeach; ?>
    <?= pagination_links($result, '/examples') ?>
<?php endif; ?>
