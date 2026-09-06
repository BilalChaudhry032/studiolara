#!/bin/bash
set -e

cd /var/www/html

if [ ! -f database/database.sqlite ]; then
    touch database/database.sqlite
fi

php artisan config:clear
php artisan migrate --force

SEEDED=$(php -r "
try {
    \$pdo = new PDO('sqlite:' . (getenv('DB_DATABASE') ?: __DIR__ . '/database/database.sqlite'));
    echo \$pdo->query('SELECT COUNT(*) FROM services')->fetchColumn();
} catch (Exception \$e) { echo 0; }
")

if [ "$SEEDED" = "0" ]; then
    php artisan db:seed --force
fi

php artisan db:seed --class=AdminUserSeeder --force

php artisan storage:link || true
php artisan config:cache
php artisan route:cache
php artisan view:cache

php artisan serve --host=0.0.0.0 --port="${PORT:-10000}"
