<?php
helper('vite');
$adminSite = (new \App\Services\SettingService())->getSite();
?>
<!DOCTYPE html>
<html lang="id" class="admin-html">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Dashboard') ?> &mdash; PGA Admin</title>
    <?php if (! empty($adminSite['logo'])): ?>
        <link rel="icon" type="image/webp" href="<?= base_url($adminSite['logo']) ?>">
    <?php else: ?>
        <link rel="icon" href="<?= base_url('favicon.ico') ?>">
    <?php endif; ?>
    <?= vite_assets(['admin-css', 'admin-js']) ?>
    <script src="<?= base_url('assets/tinymce/tinymce.min.js') ?>" referrerpolicy="origin"></script>
</head>

<body class="admin-body font-body text-slate-800 antialiased">
    <div id="page-loader" class="page-loader" aria-hidden="true">
        <div class="page-loader-inner">
            <span class="page-loader-ring page-loader-ring-1"></span>
            <span class="page-loader-ring page-loader-ring-2"></span>
            <?php if (! empty($adminSite['logo'])): ?>
                <img src="<?= base_url($adminSite['logo']) ?>" alt="<?= esc($adminSite['companyName'] ?? 'PGA') ?>" class="page-loader-logo">
            <?php else: ?>
                <span class="page-loader-logo page-loader-logo-text">PGA</span>
            <?php endif; ?>
        </div>
    </div>

    <div id="admin-app" class="relative min-h-screen">
        <div class="pointer-events-none absolute inset-0 -z-10 bg-[radial-gradient(circle_at_12%_18%,rgba(14,165,233,0.14),transparent_34%),radial-gradient(circle_at_85%_10%,rgba(99,102,241,0.12),transparent_32%),radial-gradient(circle_at_50%_100%,rgba(16,185,129,0.10),transparent_40%)]"></div>

        <div class="flex min-h-screen">
            <?= $this->include('admin/partials/sidebar') ?>

            <div class="flex min-w-0 flex-1 flex-col">
                <?= $this->include('admin/partials/topbar') ?>

                <main class="flex-1 px-4 py-4 sm:px-6 sm:py-6 lg:px-8 lg:py-8">
                    <div class="mx-auto w-full max-w-[1600px] space-y-4">
                        <?= $this->include('admin/partials/flash') ?>
                        <section class="admin-surface rounded-2xl p-4 shadow-sm ring-1 ring-slate-200/70 sm:p-6">
                            <?= $this->renderSection('content') ?>
                        </section>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <div id="confirm-modal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/60 backdrop-blur-sm px-4">
        <div class="w-full max-w-sm rounded-2xl bg-white p-6 shadow-2xl">
            <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-rose-100 text-rose-600">
                <svg viewBox="0 0 24 24" class="h-6 w-6 fill-current"><path d="M6 7h12v2H6V7Zm2 3h8l-.9 9.1a1 1 0 0 1-1 .9H9.9a1 1 0 0 1-1-.9L8 10Zm2.5-6h3a1 1 0 0 1 1 1v1h-5V5a1 1 0 0 1 1-1Z" /></svg>
            </div>
            <h3 id="confirm-modal-title" class="text-center text-base font-semibold text-slate-900">Hapus data ini?</h3>
            <p class="mt-1 text-center text-sm text-slate-500">Tindakan ini tidak dapat dibatalkan setelah dikonfirmasi.</p>
            <div class="mt-5 flex gap-3">
                <button type="button" id="confirm-modal-cancel" class="flex-1 rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">Batal</button>
                <button type="button" id="confirm-modal-ok" class="flex-1 rounded-xl bg-rose-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-rose-700">Ya, Hapus</button>
            </div>
        </div>
    </div>

    <script>
        (function() {
            const app = document.getElementById('admin-app');
            const openBtn = document.getElementById('sidebar-open-btn');
            const closeBtn = document.getElementById('sidebar-close-btn');
            const backdrop = document.getElementById('sidebar-backdrop');
            const sidebar = document.getElementById('admin-sidebar');

            const openSidebar = () => {
                if (!app || !sidebar) return;
                app.classList.add('sidebar-open');
                sidebar.setAttribute('aria-hidden', 'false');
            };

            const closeSidebar = () => {
                if (!app || !sidebar) return;
                app.classList.remove('sidebar-open');
                sidebar.setAttribute('aria-hidden', 'true');
            };

            openBtn && openBtn.addEventListener('click', openSidebar);
            closeBtn && closeBtn.addEventListener('click', closeSidebar);
            backdrop && backdrop.addEventListener('click', closeSidebar);

            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024) closeSidebar();
            });

            // --- Sidebar collapse (icon-only) mode, persisted across page loads ---
            const COLLAPSE_KEY = 'pga_admin_sidebar_collapsed';
            const collapseBtn = document.getElementById('sidebar-collapse-btn');
            const collapseIconEl = document.getElementById('sidebar-collapse-icon');
            const expandIconEl = document.getElementById('sidebar-expand-icon');
            const hideOnCollapseSelector = '.sidebar-label, .sidebar-group-label, .sidebar-brand-text, .sidebar-footer-text';

            const applyCollapsed = (collapsed) => {
                if (!sidebar) return;
                const isDesktop = window.innerWidth >= 1024;

                if (!isDesktop) {
                    sidebar.style.width = '';
                    document.querySelectorAll(hideOnCollapseSelector).forEach((el) => { el.style.display = ''; });
                    document.querySelectorAll('.sidebar-tooltip').forEach((el) => { el.style.display = 'none'; });
                    document.querySelectorAll('.sidebar-link').forEach((el) => el.classList.remove('justify-center'));
                    return;
                }

                sidebar.style.width = collapsed ? '5rem' : '';
                document.querySelectorAll(hideOnCollapseSelector).forEach((el) => { el.style.display = collapsed ? 'none' : ''; });
                document.querySelectorAll('.sidebar-tooltip').forEach((el) => { el.style.display = collapsed ? 'block' : 'none'; });
                document.querySelectorAll('.sidebar-link').forEach((el) => el.classList.toggle('justify-center', collapsed));

                if (collapseIconEl && expandIconEl) {
                    collapseIconEl.classList.toggle('hidden', collapsed);
                    expandIconEl.classList.toggle('hidden', !collapsed);
                }
            };

            const isCollapsed = () => localStorage.getItem(COLLAPSE_KEY) === '1';

            applyCollapsed(isCollapsed());

            collapseBtn && collapseBtn.addEventListener('click', () => {
                const next = !isCollapsed();
                localStorage.setItem(COLLAPSE_KEY, next ? '1' : '0');
                applyCollapsed(next);
            });

            window.addEventListener('resize', () => applyCollapsed(isCollapsed()));

            // --- Generic delete/confirm modal for any form[data-confirm], plus
            //     standalone button[data-confirm][data-delete-url] (used where a
            //     real nested <form> isn't possible, e.g. inside another form) ---
            const confirmModal = document.getElementById('confirm-modal');
            const confirmTitle = document.getElementById('confirm-modal-title');
            const confirmOkBtn = document.getElementById('confirm-modal-ok');
            const confirmCancelBtn = document.getElementById('confirm-modal-cancel');
            let pendingForm = null;
            let pendingButton = null;

            const openConfirmModal = (el) => {
                if (confirmTitle) confirmTitle.textContent = el.dataset.confirm || 'Hapus data ini?';
                confirmModal.classList.remove('hidden');
                confirmModal.classList.add('flex');
            };

            const closeConfirmModal = () => {
                pendingForm = null;
                pendingButton = null;
                confirmModal.classList.add('hidden');
                confirmModal.classList.remove('flex');
            };

            if (confirmModal) {
                document.querySelectorAll('form[data-confirm]').forEach((form) => {
                    form.addEventListener('submit', (e) => {
                        e.preventDefault();
                        pendingForm = form;
                        openConfirmModal(form);
                    });
                });

                document.querySelectorAll('button[data-confirm][data-delete-url]').forEach((btn) => {
                    btn.addEventListener('click', () => {
                        pendingButton = btn;
                        openConfirmModal(btn);
                    });
                });

                confirmOkBtn && confirmOkBtn.addEventListener('click', () => {
                    const form = pendingForm;
                    const btn = pendingButton;
                    closeConfirmModal();

                    if (form) {
                        if (window.pgaShowLoader) window.pgaShowLoader();
                        form.submit();
                        return;
                    }

                    if (btn) {
                        if (window.pgaShowLoader) window.pgaShowLoader();
                        const tmpForm = document.createElement('form');
                        tmpForm.method = 'post';
                        tmpForm.action = btn.dataset.deleteUrl;
                        tmpForm.style.display = 'none';
                        const csrfInput = document.createElement('input');
                        csrfInput.type = 'hidden';
                        csrfInput.name = btn.dataset.csrfName;
                        csrfInput.value = btn.dataset.csrfValue;
                        tmpForm.appendChild(csrfInput);
                        document.body.appendChild(tmpForm);
                        tmpForm.submit();
                    }
                });
                confirmCancelBtn && confirmCancelBtn.addEventListener('click', closeConfirmModal);
                confirmModal.addEventListener('click', (e) => {
                    if (e.target === confirmModal) closeConfirmModal();
                });
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape') closeConfirmModal();
                });
            }
        })();
    </script>
</body>

</html>