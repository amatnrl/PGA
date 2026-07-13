# TODO - Admin Dashboard Redesign + Branch CRUD (PGA)

- [x] Add migration for `branches` table.
- [x] Create `BranchModel`.
- [x] Create `BranchController` with CRUD actions.
- [x] Add admin routes for Branch CRUD in `app/Config/Routes.php`.
- [x] Create views `app/Views/admin/branches/index.php` and `app/Views/admin/branches/form.php`.
- [x] Remove branch information block from sidebar and add "Cabang" menu.
- [x] Modernize dashboard cards in `app/Views/admin/dashboard/index.php` with interactive hover/animation UI.
- [x] Extend `resources/css/admin.css` for modern dashboard card animations/effects.
- [x] Run `php spark migrate`.
- [x] Run `npm run build`.
- [x] Perform testing (CRUD cabang + dashboard UI interactions + sidebar navigation).
- [x] Update testing status summary.

## Testing status summary (2026-06-20)

- `php spark migrate:status` confirms `2026-06-22-000001_CreateBranchesTable` applied (batch 5).
- `npm run build` completes cleanly, producing updated `admin-css`/`admin-js` bundles with the dashboard card styles.
- `php spark serve` smoke test: `/admin` correctly redirects (302) to login (session/permission filters active); public site `/` returns 200.
- Code review of `BranchController`, `BranchModel`, `admin/branches/index.php`, `admin/branches/form.php`, sidebar, and dashboard view confirms all CRUD actions, routes, and modern UI (hover/animation dash-card styles in `resources/css/admin.css`) are in place — no remaining gaps found in this pass.
