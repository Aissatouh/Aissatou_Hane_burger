# Utilisation de l'image officielle PHP avec extensions requises
FROM php:8.2-fpm

# Installation des dépendances système nécessaires
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définition du répertoire de travail
WORKDIR /var/www

# Copie des fichiers de l'application
COPY . .

# Installation des dépendances PHP avec Composer
RUN composer install --no-dev --optimize-autoloader

# Changement des permissions du stockage et du cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Exposition du port par défaut de Laravel
EXPOSE 9000

# Commande de démarrage du conteneur
CMD ["php-fpm"]
