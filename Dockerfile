FROM php:8.2-fpm

# system deps
RUN apt-get update && apt-get install -y \
    git curl zip unzip nodejs npm \
    libpng-dev libonig-dev libxml2-dev

# PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# copy project
COPY . .

# install backend
RUN composer install --no-interaction --prefer-dist

# install frontend + build Vite
RUN npm install
RUN npm run build

# Laravel optimizations
RUN php artisan key:generate || true
RUN php artisan storage:link || true
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

RUN chmod -R 777 storage bootstrap/cache

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000