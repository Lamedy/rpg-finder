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

# Назначаем права на папку
RUN chown -R www-data:www-data /var/www/html
