<?php
helper('vite');
$authSite = (new \App\Services\SettingService())->getSite();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= lang('Auth.login') ?> &mdash; PGA Admin</title>
    <?php if (! empty($authSite['logo'])): ?>
        <link rel="icon" type="image/webp" href="<?= base_url($authSite['logo']) ?>">
    <?php else: ?>
        <link rel="icon" href="<?= base_url('favicon.ico') ?>">
    <?php endif; ?>
    <?= vite_assets(['admin-css', 'admin-js']) ?>
</head>

<body class="admin-body font-body text-slate-800 antialiased">
    <div class="relative flex min-h-screen items-center justify-center overflow-hidden px-4 py-10">
        <div class="pointer-events-none absolute inset-0 -z-10 bg-[radial-gradient(circle_at_12%_18%,rgba(14,165,233,0.16),transparent_34%),radial-gradient(circle_at_85%_10%,rgba(99,102,241,0.14),transparent_32%),radial-gradient(circle_at_50%_100%,rgba(16,185,129,0.12),transparent_40%)]"></div>

        <div class="w-full max-w-md">
            <div class="admin-surface rounded-2xl border border-slate-200/70 bg-white/95 p-6 shadow-2xl shadow-slate-900/5 ring-1 ring-slate-200/70 sm:p-8">
                <div class="mb-6 flex flex-col items-center gap-3 text-center">
                    <?php if (! empty($authSite['logo'])): ?>
                        <img src="<?= base_url($authSite['logo']) ?>" alt="<?= esc($authSite['companyName'] ?? 'PGA') ?>" class="h-14 w-14 rounded-2xl object-contain shadow-lg shadow-red-500/30">
                    <?php else: ?>
                        <img src="<?= base_url('favicon.ico') ?>" alt="Pancaran Gemilang Abadi" class="h-14 w-14 rounded-2xl object-contain shadow-lg shadow-red-500/30">
                    <?php endif; ?>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-400">Enterprise CMS</p>
                        <p class="text-base font-semibold text-slate-900">Pancaran Gemilang Abadi</p>
                    </div>
                </div>

                <h1 class="text-lg font-semibold text-slate-900"><?= lang('Auth.login') ?></h1>
                <p class="mt-1 text-sm text-slate-500">Masuk untuk mengelola konten dan data perusahaan.</p>

                <?php if (session('error') !== null) : ?>
                    <div class="mt-4 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700"><?= esc(session('error')) ?></div>
                <?php elseif (session('errors') !== null) : ?>
                    <div class="mt-4 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                        <?php if (is_array(session('errors'))) : ?>
                            <?php foreach (session('errors') as $error) : ?>
                                <p><?= esc($error) ?></p>
                            <?php endforeach ?>
                        <?php else : ?>
                            <?= esc(session('errors')) ?>
                        <?php endif ?>
                    </div>
                <?php endif ?>

                <?php if (session('message') !== null) : ?>
                    <div class="mt-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700"><?= esc(session('message')) ?></div>
                <?php endif ?>

                <form action="<?= url_to('login') ?>" method="post" class="mt-6 space-y-4">
                    <?= csrf_field() ?>

                    <div>
                        <label for="email" class="mb-1.5 block text-xs font-semibold uppercase tracking-[0.1em] text-slate-500"><?= lang('Auth.email') ?></label>
                        <div class="relative">
                            <svg viewBox="0 0 24 24" class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 fill-none stroke-slate-400 stroke-2"><path d="M3.5 6.5h17v11h-17z" stroke-linecap="round" stroke-linejoin="round"/><path d="m4 7 8 6 8-6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <input type="email" id="email" name="email" inputmode="email" autocomplete="email" placeholder="admin@pga.co.id" value="<?= old('email') ?>" required
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 py-2.5 pl-10 pr-4 text-sm text-slate-800 transition focus:border-red-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-red-100">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="mb-1.5 block text-xs font-semibold uppercase tracking-[0.1em] text-slate-500"><?= lang('Auth.password') ?></label>
                        <div class="relative">
                            <svg viewBox="0 0 24 24" class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 fill-none stroke-slate-400 stroke-2"><rect x="4.5" y="10.5" width="15" height="9" rx="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M8 10.5V7.5a4 4 0 0 1 8 0v3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <input type="password" id="password" name="password" inputmode="text" autocomplete="current-password" placeholder="••••••••" required
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 py-2.5 pl-10 pr-4 text-sm text-slate-800 transition focus:border-red-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-red-100">
                        </div>
                    </div>

                    <?php if (setting('Auth.sessionConfig')['allowRemembering']): ?>
                        <label class="flex items-center gap-2 text-sm text-slate-600">
                            <input type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-300 text-red-600 focus:ring-red-400" <?php if (old('remember')): ?> checked<?php endif ?>>
                            <?= lang('Auth.rememberMe') ?>
                        </label>
                    <?php endif; ?>

                    <button type="submit" class="admin-btn-primary flex w-full items-center justify-center gap-2 py-2.5 text-sm">
                        <svg viewBox="0 0 24 24" class="h-4 w-4 fill-none stroke-current stroke-2"><path d="M14 8V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-2" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 12h11m0 0-3.5-3.5M20 12l-3.5 3.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <?= lang('Auth.login') ?>
                    </button>
                </form>
            </div>

            <p class="mt-6 text-center text-xs text-slate-400">&copy; <?= date('Y') ?> Pancaran Gemilang Abadi &mdash; Enterprise CMS</p>
        </div>
    </div>
</body>

</html>
