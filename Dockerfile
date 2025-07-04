FROM php:8.2-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable mod_rewrite and SSL
RUN a2enmod rewrite ssl

# Copy certs
COPY .docker/certs/cms.local.test.pem /etc/apache2/ssl/cms.local.test.pem
COPY .docker/certs/cms.local.test-key.pem /etc/apache2/ssl/cms.local.test-key.pem

# Copy vhost config
COPY .docker/apache/vhost.conf /etc/apache2/sites-available/vhost.conf
RUN a2ensite vhost.conf

# Optional: disable default
RUN a2dissite 000-default.conf

# Custom PHP config
COPY .docker/php.ini /usr/local/etc/php/conf.d/custom.ini
