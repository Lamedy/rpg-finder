# Этап 1: сборка фронтенда
FROM node:18 as node-builder

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY resources ./resources
COPY vite.config.js ./

RUN npm run build

# Этап 2: сборка бэкенда
FROM php:8.2-apache

# Установим необходимые PHP-расширения
RUN apt-get update && apt-get install -y \
    zip unzip curl git libzip-dev && \
    docker-php-ext-install pdo pdo_mysql zip

# Установим Composer (глобально)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Настроим Apache DocumentRoot под Laravel
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Копируем свой конфиг Apache
COPY apache/000-default.conf /etc/apache2/sites-available/000-default.conf

# Включаем mod_rewrite — Laravel его использует
RUN a2enmod rewrite

# Копируем Laravel проект в контейнер
COPY . /var/www/html
COPY storage/app/public/icons /var/www/html/storage/app/public/icons

# Копируем аватар в "временное" место
COPY storage/app/public/avatars/default_avatar.png /var/www/html/default_assets/default_avatar.png

# Копируем entrypoint
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]

WORKDIR /var/www/html

# Копируем собранные ассеты Vite из первого этапа
COPY --from=node-builder /app/public /var/www/html/public

ENV COMPOSER_AUTH='{"github-oauth": {"github.com": "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"}}'
RUN composer install --no-dev --optimize-autoloader --prefer-dist

# Назначаем права на папку
RUN chown -R www-data:www-data /var/www/html


