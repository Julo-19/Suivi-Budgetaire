# Utilise l'image officielle PHP avec Apache
FROM php:8.3-apache

# Installe les dépendances système
RUN apt-get update && apt-get install -y \
    libicu-dev \
    zlib1g-dev \
    g++ \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    git \
    libzip-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl pdo pdo_mysql zip

# Active mod_rewrite d’Apache
RUN a2enmod rewrite

# Installe Composer avant de copier ton code
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Copie le code de ton projet
COPY . /var/www/html
WORKDIR /var/www/html

# Installer les dépendances PHP de Laravel
RUN composer install --no-dev --optimize-autoloader

# Redirige Apache vers le dossier public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Donne les bons droits à Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache
