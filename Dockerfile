FROM php:8.3.11-apache
RUN apt-get update -y && apt-get install -y openssl zip unzip git 
RUN docker-php-ext-install pdo_mysql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY . /var/www
COPY ./public /var/www/html
WORKDIR /var/www
RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist
RUN php artisan key:generate
RUN chmod -R 777 storage
RUN a2enmod rewrite
# Remove service restart and migrations from build
# CMD ["apache2-foreground"] is inherited from php:8.3.11-apache