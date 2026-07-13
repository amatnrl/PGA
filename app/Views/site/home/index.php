<?= $this->extend('site/layouts/main') ?>

<?php
// Global helper available to included section partials: stored value or fallback default.
if (! function_exists('hv')) {
    function hv(array $home, string $key, string $default = ''): string
    {
        $v = $home[$key] ?? '';

        return $v !== '' ? $v : $default;
    }
}
$visible = fn (string $key) => ($home[$key] ?? null) !== '0';
?>

<?= $this->section('content') ?>
<?= $this->include('site/home/sections/hero') ?>
<?php if ($visible('showOverview')): ?><?= $this->include('site/home/sections/overview') ?><?php endif; ?>
<?php if ($visible('showWhy')): ?><?= $this->include('site/home/sections/why') ?><?php endif; ?>
<?php if ($visible('showCategories')): ?><?= $this->include('site/home/sections/categories') ?><?php endif; ?>
<?php if ($visible('showFeatured')): ?><?= $this->include('site/home/sections/featured') ?><?php endif; ?>
<?php if ($visible('showTestimonial')): ?><?= $this->include('site/home/sections/testimonials') ?><?php endif; ?>
<?php if ($visible('showInstagram')): ?><?= $this->include('site/home/sections/instagram') ?><?php endif; ?>
<?php if ($visible('showPartner')): ?><?= $this->include('site/home/sections/partners') ?><?php endif; ?>
<?php if ($visible('showExplore')): ?><?= $this->include('site/home/sections/explore') ?><?php endif; ?>
<?= $this->include('site/home/sections/recipes') ?>

<script>
document.addEventListener('DOMContentLoaded', () => {
    if (window.gsap) {
        gsap.from('[data-hero-reveal]', { opacity: 0, y: 30, duration: 1, ease: 'power2.out', stagger: 0.15 });
        if (window.animateCounters) animateCounters();
    }
});
</script>
<?= $this->endSection() ?>
