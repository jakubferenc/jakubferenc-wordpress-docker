FROM php:8.2-apache

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache mod_rewrite (for WordPress permalinks)
RUN a2enmod rewrite

# Optional: add custom PHP config
COPY .docker/php.ini /usr/local/etc/php/conf.d/custom.ini
