# --- Stage 1: build frontend assets ---
FROM node:20-alpine AS assets
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY resources ./resources
COPY vite.config.js tailwind.config.js postcss.config.js ./
RUN npm run build

# --- Stage 2: PHP application ---
FROM php:8.3-cli-alpine

RUN apk add --no-cache \
    git curl bash sqlite \
    libpng-dev libzip-dev icu-dev oniguruma-dev \
    && docker-php-ext-install pdo pdo_sqlite mbstring zip exif pcntl bcmath gd intl \
    && apk del --no-cache libpng-dev libzip-dev icu-dev oniguruma-dev

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .
COPY --from=assets /app/public/build ./public/build

RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress \
    && mkdir -p database storage/framework/{cache,sessions,views} storage/logs bootstrap/cache \
    && touch database/database.sqlite \
    && chmod -R 775 storage bootstrap/cache database

COPY docker/start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

EXPOSE 10000
CMD ["start.sh"]
