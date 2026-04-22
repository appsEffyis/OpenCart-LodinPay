FROM php:8.1-apache

# Extensions PHP
# Après
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libzip-dev libxml2-dev unzip \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install gd mysqli pdo pdo_mysql zip xml

# Active mod_rewrite
RUN a2enmod rewrite

# Copie OpenCart depuis le dossier local déjà extrait
COPY opencart-4.0.2.3/upload/ /var/www/html/

# Permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Config Apache
RUN echo '<Directory /var/www/html>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/opencart.conf \
    && a2enconf opencart

EXPOSE 80