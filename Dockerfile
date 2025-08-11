# Utilise l'image officielle PHP avec Apache
FROM php:8.3-apache

# Installe les dépendances
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libicu-dev \
    zip \
    unzip \
    curl \
    git \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip intl

# Active mod_rewrite d’Apache
RUN a2enmod rewrite

COPY . /var/www/html
WORKDIR /var/www/html

# Redirige Apache vers le dossier public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf


# Installe Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Donne les bons droits à Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache
