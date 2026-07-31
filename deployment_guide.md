# Deployment Guide — Hostinger Shared Hosting

Production: **bluelagoon.fun** · Laravel 10.50 + Filament · PHP 8.3

## Server layout

The application lives **outside** the web root. `public_html` is a symlink to `laravel/public`,
so only the `public/` directory is ever reachable from the internet.

```
~/domains/bluelagoon.fun/
├── laravel/          <- the repository (git clone lives here)
│   ├── app/ config/ routes/ storage/ vendor/ ...
│   ├── .env          <- server-only, never committed
│   └── public/
│       └── storage -> ../storage/app/public   (symlink)
└── public_html -> laravel/public              (symlink)
```

## Server limitations to remember

Hostinger's shared PHP has `proc_open()` and `symlink()` disabled. Two consequences:

- `composer install` must be run with `--no-scripts`, then `php artisan package:discover` manually.
- `php artisan storage:link` fails. Create the link from the shell with `ln -s` instead.

There is also **no Node.js**. Frontend assets must be built locally and committed —
that is why `/public/build` is deliberately *not* in `.gitignore`.

## Routine deploy

```bash
cd ~/domains/bluelagoon.fun/laravel

git status --short          # must be clean before pulling
git pull origin master

composer install --no-dev --optimize-autoloader --no-scripts
php artisan package:discover

php artisan migrate --force

php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

If a Filament package was added or upgraded, also run:

```bash
php artisan filament:assets
```

## Frontend assets

Build locally, commit the output, then pull on the server:

```bash
npm install
npm run build
git add public/build
git commit -m "chore: rebuild frontend assets"
git push origin master
```

## First-time setup on a fresh server

```bash
cd ~/domains/bluelagoon.fun
git clone https://github.com/oraby99/bluelagon.git laravel

cd laravel
composer install --no-dev --optimize-autoloader --no-scripts
php artisan package:discover

cp .env.example .env
nano .env                   # APP_ENV=production, APP_DEBUG=false, APP_URL, DB_*
php artisan key:generate

php artisan migrate --force

# storage symlink (artisan cannot create it on this host)
cd public && ln -s ../storage/app/public storage && cd ..

chmod -R 775 storage bootstrap/cache

# point the web root at public/
cd ~/domains/bluelagoon.fun
rm -rf public_html
ln -s laravel/public public_html
```

Then create the Filament admin user:

```bash
cd ~/domains/bluelagoon.fun/laravel
php artisan make:filament-user
```

## Scheduler

hPanel → Advanced → Cron Jobs, every minute:

```
/usr/bin/php /home/u454266434/domains/bluelagoon.fun/laravel/artisan schedule:run >> /dev/null 2>&1
```

## Verification checklist

```bash
curl -sI https://bluelagoon.fun/.env  | head -1   # expect 403 or 404
curl -sI https://bluelagoon.fun/      | head -1   # expect 200
ls -la ~/domains/bluelagoon.fun/public_html       # expect symlink -> laravel/public
tail -30 ~/domains/bluelagoon.fun/laravel/storage/logs/laravel.log
```

## Notes

- `.env` is never committed. Keep the production values somewhere safe outside the repo.
- `git config core.fileMode false` is set on the server so `chmod` does not surface as changes.
- Do not edit files directly on the server. Change them locally, push, then pull.
