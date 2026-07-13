<?php
helper(['vite', 'seo']);
$layoutSite = $site ?? (new \App\Services\SettingService())->getSite();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= seo_meta($seo ?? ['title' => $title ?? 'PGA']) ?>
    <?php if (! empty($layoutSite['logo'])): ?>
        <link rel="icon" type="image/webp" href="<?= base_url($layoutSite['logo']) ?>">
    <?php else: ?>
        <link rel="icon" href="<?= base_url('favicon.ico') ?>">
    <?php endif; ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?= vite_assets(['site-css', 'site-js']) ?>
    <?php foreach ($schemas ?? [] as $schema): ?>
        <?= $schema ?>
    <?php endforeach; ?>
    <?= $this->renderSection('head') ?>
</head>
<body class="bg-white font-body text-accent-black antialiased">
    <div id="page-loader" class="page-loader" aria-hidden="true">
        <div class="page-loader-inner">
            <span class="page-loader-ring page-loader-ring-1"></span>
            <span class="page-loader-ring page-loader-ring-2"></span>
            <?php if (! empty($layoutSite['logo'])): ?>
                <img src="<?= base_url($layoutSite['logo']) ?>" alt="<?= esc($layoutSite['companyName'] ?? 'PGA') ?>" class="page-loader-logo">
            <?php else: ?>
                <span class="page-loader-logo page-loader-logo-text">PGA</span>
            <?php endif; ?>
        </div>
    </div>

    <?= $this->include('site/partials/header') ?>

    <main class="pt-[76px] sm:pt-[96px] [&:has([data-hero-flush])]:pt-0"><?= $this->renderSection('content') ?></main>

    <?= $this->include('site/partials/footer') ?>

    <?= $this->renderSection('scripts') ?>
</body>
</html>
