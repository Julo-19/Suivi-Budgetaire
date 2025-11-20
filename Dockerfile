# Utilise l'image officielle PHP avec Apache
FROM php:8.3-apache

# Installe les dépendances système
RUN apt-get update && apt-get install -y \
    netcat \
    libicu-dev zlib1g-dev g++ libpng-dev libonig-dev libxml2-dev zip unzip curl git libzip-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl pdo pdo_mysql zip

# Active mod_rewrite d’Apache
RUN a2enmod rewrite

# Installe Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Copie le code Laravel
COPY . /var/www/html
WORKDIR /var/www/html

# Crée les dossiers nécessaires et donne les permissions correctes
RUN mkdir -p storage/logs bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Installer les dépendances PHP de Laravel
RUN composer install --no-dev --optimize-autoloader

# Redirige Apache vers le dossier public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Expose le port Apache
EXPOSE 80

# Démarre Apache en foreground
CMD ["apache2-foreground"]
