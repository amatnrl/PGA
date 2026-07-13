<?php helper('vite'); ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= lang('Auth.login') ?> &mdash; PGA Admin</title>
    <?= vite_assets(['admin-css', 'admin-js']) ?>
</head>

<body class="admin-body font-body text-slate-800 antialiased">
    <div class="relative flex min-h-screen items-center justify-center overflow-hidden px-4 py-10">
        <div class="pointer-events-none absolute inset-0 -z-10 bg-[radial-gradient(circle_at_12%_18%,rgba(14,165,233,0.16),transparent_34%),radial-gradient(circle_at_85%_10%,rgba(99,102,241,0.14),transparent_32%),radial-gradient(circle_at_50%_100%,rgba(16,185,129,0.12),transparent_40%)]"></div>

        <div class="w-full max-w-md">
            <div class="mb-6 flex flex-col items-center gap-3 text-center">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-red-600 via-red-500 to-rose-600 text-base font-extrabold text-white shadow-lg shadow-red-500/30">PGA</div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-400">Enterprise CMS</p>
                    <p class="text-base font-semibold text-slate-900">Pancaran Gemilang Abadi</p>
                </div>
            </div>

            <div class="admin-surface rounded-2xl border border-slate-200/70 bg-white/95 p-6 shadow-2xl shadow-slate-900/5 ring-1 ring-slate-200/70 sm:p-8">
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
                        <input type="email" id="email" name="email" inputmode="email" autocomplete="email" placeholder="admin@pga.co.id" value="<?= old('email') ?>" required
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-800 transition focus:border-red-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-red-100">
                    </div>

                    <div>
                        <label for="password" class="mb-1.5 block text-xs font-semibold uppercase tracking-[0.1em] text-slate-500"><?= lang('Auth.password') ?></label>
                        <input type="password" id="password" name="password" inputmode="text" autocomplete="current-password" placeholder="••••••••" required
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-800 transition focus:border-red-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-red-100">
                    </div>

                    <?php if (setting('Auth.sessionConfig')['allowRemembering']): ?>
                        <label class="flex items-center gap-2 text-sm text-slate-600">
                            <input type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-300 text-red-600 focus:ring-red-400" <?php if (old('remember')): ?> checked<?php endif ?>>
                            <?= lang('Auth.rememberMe') ?>
                        </label>
                    <?php endif; ?>

                    <button type="submit" class="admin-btn-primary w-full justify-center py-2.5 text-sm"><?= lang('Auth.login') ?></button>

                    <?php if (setting('Auth.allowMagicLinkLogins')) : ?>
                        <p class="text-center text-sm text-slate-500"><?= lang('Auth.forgotPassword') ?> <a href="<?= url_to('magic-link') ?>" class="font-semibold text-red-600 hover:text-red-700"><?= lang('Auth.useMagicLink') ?></a></p>
                    <?php endif ?>
                </form>
            </div>

            <p class="mt-6 text-center text-xs text-slate-400">&copy; <?= date('Y') ?> Pancaran Gemilang Abadi &mdash; Enterprise CMS</p>
        </div>
    </div>
</body>

</html>
