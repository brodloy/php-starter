<?php
/**
 * Generic "action" email body — a heading, a line of text, and one button.
 * Inline styles only. @var string $heading @var string $intro
 * @var string $ctaUrl @var string $ctaText @var string $note
 */
?>
<div style="font-size:20px;font-weight:600;color:#0f172a;margin:0 0 12px;"><?= e($heading) ?></div>
<p style="color:#475569;font-size:14px;line-height:1.65;margin:0 0 22px;"><?= e($intro) ?></p>
<a href="<?= e($ctaUrl) ?>" style="display:inline-block;background:#4f46e5;color:#ffffff;text-decoration:none;font-weight:600;font-size:14px;padding:11px 22px;border-radius:10px;">
    <?= e($ctaText) ?>
</a>
<?php if (!empty($note)): ?>
    <p style="color:#94a3b8;font-size:12px;line-height:1.6;margin:22px 0 0;"><?= e($note) ?></p>
<?php endif; ?>
<p style="color:#94a3b8;font-size:12px;line-height:1.6;margin:18px 0 0;word-break:break-all;">
    Or paste this link into your browser:<br><?= e($ctaUrl) ?>
</p>
