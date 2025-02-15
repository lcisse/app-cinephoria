# Utiliser l'image PHP avec Apache
FROM php:8.2-apache

# Installer les extensions nécessaires
RUN apt-get update && apt-get install -y \
    libssl-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd session

# Activer la gestion des sessions PHP
RUN mkdir -p /var/lib/php/sessions && chmod -R 777 /var/lib/php/sessions

# Activer les modules Apache
RUN a2enmod rewrite

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Installer l'extension MongoDB
RUN pecl install mongodb \
    && echo "extension=mongodb.so" > /usr/local/etc/php/conf.d/mongodb.ini

# Copier le code source
COPY . /var/www/html/

# Copier le fichier de configuration Apache
COPY default.conf /etc/apache2/sites-available/000-default.conf
RUN a2ensite 000-default.conf

# Donner les bonnes permissions aux fichiers
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

# Exposer le port 80
EXPOSE 80

# Démarrer Apache
CMD ["apache2-foreground"]

