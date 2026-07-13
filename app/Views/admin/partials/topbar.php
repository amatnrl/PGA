<?php
$user     = $currentUser ?? null;
$menuFlat = \App\Libraries\AdminMenu::flat();
?>
<header class="sticky top-0 z-30 border-b border-slate-200/80 bg-white/80 backdrop-blur-xl">
    <div class="mx-auto flex h-16 w-full max-w-[1600px] items-center justify-between gap-3 px-4 sm:px-6 lg:px-8">
        <div class="flex min-w-0 items-center gap-3">
            <button id="sidebar-open-btn" type="button" class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-red-600 shadow-sm transition hover:bg-red-50 hover:text-red-700 lg:hidden" aria-label="Open sidebar">
                <svg viewBox="0 0 24 24" class="h-5 w-5 fill-current">
                    <path d="M3 6h18v2.2H3V6Zm0 4.9h18v2.2H3v-2.2Zm0 4.9h18V18H3v-2.2Z" />
                </svg>
            </button>

            <button id="sidebar-collapse-btn" type="button" class="hidden h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-slate-200 bg-white text-red-600 shadow-sm transition hover:border-red-300 hover:bg-red-50 hover:text-red-700 lg:inline-flex" aria-label="Toggle sidebar width">
                <svg id="sidebar-collapse-icon" viewBox="0 0 24 24" class="h-5 w-5 fill-current">
                    <path d="M19 4H5a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1ZM10 18H6V6h4v12Zm3.6-2.4L11.2 12l2.4-3.6 1.6 1.1L13.8 12l1.4 2.5-1.6 1.1Z" />
                </svg>
                <svg id="sidebar-expand-icon" viewBox="0 0 24 24" class="hidden h-5 w-5 fill-current">
                    <path d="M19 4H5a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1ZM10 18H6V6h4v12Zm1.4-2.4L10 14.5 12.4 12 10 9.5l1.4-1.1 3.6 3.6Z" />
                </svg>
            </button>

            <div class="min-w-0">
                <p class="truncate text-[0.68rem] font-semibold uppercase tracking-[0.16em] text-slate-400">PGA Enterprise Admin</p>
                <h1 class="truncate text-lg font-semibold text-slate-900"><?= esc($title ?? 'Dashboard') ?></h1>
            </div>
        </div>

        <div class="relative hidden flex-1 justify-center px-4 lg:flex">
            <div class="w-full max-w-xl">
                <label class="group flex w-full items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 shadow-sm transition focus-within:border-red-300 focus-within:ring-4 focus-within:ring-red-100">
                    <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-slate-400 transition group-focus-within:text-red-500">
                        <path d="m20.3 18.7-4.8-4.8a6.8 6.8 0 1 0-1.6 1.6l4.8 4.8 1.6-1.6ZM5.6 9.9a4.3 4.3 0 1 1 8.6 0 4.3 4.3 0 0 1-8.6 0Z" />
                    </svg>
                    <input type="text" id="navSearchInput" autocomplete="off" placeholder="Cari menu admin..." class="w-full border-0 bg-transparent p-0 text-sm text-slate-700 placeholder:text-slate-400 focus:outline-none focus:ring-0">
                    <kbd class="hidden rounded border border-slate-200 bg-slate-50 px-1.5 py-0.5 text-[10px] font-semibold text-slate-400 xl:inline">⌘K</kbd>
                </label>
                <div id="navSearchResults" class="absolute left-0 top-full z-40 mt-2 hidden w-full overflow-hidden rounded-xl border border-slate-200 bg-white shadow-xl"></div>
            </div>
        </div>

        <div class="flex items-center gap-2 sm:gap-3">
            <div class="hidden items-center gap-3 rounded-xl border border-slate-200 bg-white px-2.5 py-1.5 shadow-sm sm:flex">
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-br from-red-500 to-rose-700 text-xs font-semibold text-white">
                    <?= esc(strtoupper(substr($user?->username ?? 'Admin', 0, 1))) ?>
                </div>
                <div class="leading-tight">
                    <p class="text-xs font-semibold text-slate-700"><?= esc($user?->username ?? 'Admin') ?></p>
                    <p class="text-[11px] text-slate-400">Administrator</p>
                </div>
            </div>

            <button type="button" id="logout-btn" class="inline-flex h-10 items-center rounded-xl border border-transparent bg-slate-900 px-3 text-sm font-semibold text-white transition hover:bg-slate-700">
                Logout
            </button>
        </div>
    </div>
</header>

<div id="logout-modal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/60 backdrop-blur-sm px-4">
    <div class="w-full max-w-sm rounded-2xl bg-white p-6 shadow-2xl">
        <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-rose-100 text-rose-600">
            <svg viewBox="0 0 24 24" class="h-6 w-6 fill-current"><path d="M10 17v-2H3v-2h7V9l5 4-5 4Zm9 3H12v-2h7V6h-7V4h7a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2Z" /></svg>
        </div>
        <h3 class="text-center text-base font-semibold text-slate-900">Keluar dari Admin?</h3>
        <p class="mt-1 text-center text-sm text-slate-500">Anda harus login kembali untuk mengakses dashboard.</p>
        <div class="mt-5 flex gap-3">
            <button type="button" id="logout-cancel-btn" class="flex-1 rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">Batal</button>
            <a href="<?= site_url('logout') ?>" class="flex-1 rounded-xl bg-rose-600 px-4 py-2.5 text-center text-sm font-semibold text-white transition hover:bg-rose-700">Ya, Logout</a>
        </div>
    </div>
</div>

<script>
(function() {
    const menuItems = <?= json_encode($menuFlat) ?>;
    const baseUrl   = '<?= rtrim(site_url(), '/') ?>/';

    const input   = document.getElementById('navSearchInput');
    const results = document.getElementById('navSearchResults');

    if (input && results) {
        const render = (items) => {
            if (items.length === 0) {
                results.innerHTML = '<p class="px-4 py-3 text-sm text-slate-400">Tidak ada menu ditemukan.</p>';
                return;
            }
            results.innerHTML = items.map((item) => `
                <a href="${baseUrl}${item.url}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-slate-700 hover:bg-red-50 hover:text-red-700">
                    <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-slate-400"><path d="m20.3 18.7-4.8-4.8a6.8 6.8 0 1 0-1.6 1.6l4.8 4.8 1.6-1.6ZM5.6 9.9a4.3 4.3 0 1 1 8.6 0 4.3 4.3 0 0 1-8.6 0Z"/></svg>
                    <span>${item.label}</span>
                </a>`).join('');
        };

        input.addEventListener('input', () => {
            const q = input.value.trim().toLowerCase();
            if (!q) {
                results.classList.add('hidden');
                return;
            }
            const matches = menuItems.filter((item) => item.label.toLowerCase().includes(q));
            render(matches);
            results.classList.remove('hidden');
        });

        input.addEventListener('focus', () => {
            if (input.value.trim()) results.classList.remove('hidden');
        });

        document.addEventListener('click', (e) => {
            if (!results.contains(e.target) && e.target !== input) results.classList.add('hidden');
        });

        input.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                const first = results.querySelector('a');
                if (first) window.location.href = first.href;
            } else if (e.key === 'Escape') {
                results.classList.add('hidden');
                input.blur();
            }
        });
    }

    const logoutBtn  = document.getElementById('logout-btn');
    const logoutModal = document.getElementById('logout-modal');
    const logoutCancel = document.getElementById('logout-cancel-btn');

    if (logoutBtn && logoutModal) {
        const openModal = () => {
            logoutModal.classList.remove('hidden');
            logoutModal.classList.add('flex');
        };
        const closeModal = () => {
            logoutModal.classList.add('hidden');
            logoutModal.classList.remove('flex');
        };

        logoutBtn.addEventListener('click', openModal);
        logoutCancel && logoutCancel.addEventListener('click', closeModal);
        logoutModal.addEventListener('click', (e) => {
            if (e.target === logoutModal) closeModal();
        });
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeModal();
        });
    }
})();
</script>
