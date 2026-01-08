<!-- .github/copilot-instructions.md -->
# Quick instructions for AI coding agents (GitHub Copilot / assistants)

Purpose: Help an AI be immediately productive in this CodeIgniter 4 hotel reservation app.

1) Project at-a-glance
- Framework: CodeIgniter 4 (MVC). Main folders: `app/Controllers`, `app/Models`, `app/Views`, `app/Config`, `app/Filters`, `app/Database` (Migrations & Seeds).
- DB model: users → clients → reservations → chambres. Reservation statuses: `en_attente`, `confirmee`, `annulee`.

2) How to run & debug (important)
- Use the XAMPP PHP CLI to run spark commands (recommended):
  - `/opt/lampp/bin/php spark migrate`
  - `/opt/lampp/bin/php spark db:seed InitialDataSeeder`
  - `/opt/lampp/bin/php spark routes`
- If using system `php`, ensure `mysqli` is enabled or alias `php` to `/opt/lampp/bin/php`.
- Logs: `writable/logs/` (tail `tail -f writable/logs/log-*.log`).
- Quick DB sanity endpoints (in browser): `/test/database` and `/test/tables` (should return "success").

3) Key patterns & conventions to follow
- Controllers coordinate HTTP → validate input → call Models → return Views or redirect. Example: `app/Controllers/AuthController.php`.
- Models use CodeIgniter `Model` features: `$validationRules`, `$beforeInsert` callbacks (see `app/Models/UserModel.php` — `hashPassword`).
- Dates use format `Y-m-d` and are validated with `valid_date[Y-m-d]`. See `ReservationController::create` and `ReservationModel`.
- Session keys used by the app: `isLoggedIn`, `id_user`, `id_client`, `role`, `email`. See `AuthController` and `AuthFilter`.
- Route protection uses filters (`auth`, `admin`). Filter aliases live in `app/Config/Filters.php` and implementations in `app/Filters/AuthFilter.php` and `app/Filters/AdminFilter.php`.

4) Common tasks & where to change code
- Add a route: update `app/Config/Routes.php` and a controller method (follow existing naming like `bookingForm`, `create`).
- Add a migration: `/opt/lampp/bin/php spark make:migration Name` → implement new migration under `app/Database/Migrations` → run `migrate`.
- Add seed data: create seed class in `app/Database/Seeds/` and run `db:seed YourSeeder`.
- To change auth behaviour: edit `app/Filters/*.php` and `app/Controllers/AuthController.php` (session & redirection logic).

5) Safety & validation
- Passwords are hashed in `UserModel::hashPassword` and verified with `password_verify()` in `AuthController::login`.
- Input validation is done using `$this->validate([...])` in controllers and `$validationRules` in models — use those to replicate patterns.
- CSRF protection is enabled by default in `.env` and code expects server-side validation (see docs).

6) Testing / verification shortcuts
- No full PHPUnit suite shipped; use the provided endpoints `/test/database` and `/test/tables` and migrations/seeds for quick verification.
- To inspect current routes before changing code run: `/opt/lampp/bin/php spark routes`.

7) Useful file pointers (examples you can reference)
- Controllers: `app/Controllers/AuthController.php`, `ReservationController.php`, `ChambreController.php`.
- Models: `app/Models/UserModel.php`, `ReservationModel.php`, `ChambreModel.php`.
- Filters: `app/Filters/AuthFilter.php`, `app/Filters/AdminFilter.php`.
- Config/Routes: `app/Config/Routes.php`, `app/Config/Filters.php`.
- Seeds: `app/Database/Seeds/InitialDataSeeder.php` (creates admin@hotel.com / admin123 and sample rooms).

8) What to avoid / watch-outs
- Do not assume French file names or strings indicate a different behavior — variables and method names are conventional (English/PHP). Keep date format `Y-m-d` for comparisons.
- Use the XAMPP PHP binary on dev machines where XAMPP is installed to avoid missing `mysqli` or other extension differences.

If anything here is unclear or you'd like more examples (e.g., a specific controller refactor pattern or seed/migration template), tell me which area to expand. ✅
