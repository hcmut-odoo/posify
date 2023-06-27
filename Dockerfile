FROM php:7.4-apache

# Copy virtual host into container
COPY ./docker/000-default.conf /etc/apache2/sites-available/000-default.conf

# Enable rewrite mode
RUN a2enmod rewrite

# Install necessary packages
RUN apt-get update && \
    apt-get install \
    libzip-dev \
    wget \
    git \
    unzip \
    -y --no-install-recommends

# Install PHP Extensions
RUN docker-php-ext-install zip pdo_mysql

# Copy php.ini
COPY ./docker/php.ini /usr/local/etc/php/

# Create a non-root user for running Composer
RUN useradd -ms /bin/bash composer

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Node.js
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash -
RUN apt-get install -y nodejs

# Copy application files
COPY . /var/www

# Change the owner of the container document root
RUN chown -R www-data:www-data /var/www

# Change the current working directory
WORKDIR /var/www

# Install application dependencies
RUN composer install --optimize-autoloader --no-dev
RUN npm install
RUN npm run dev

# Start Apache in foreground
CMD ["apache2-foreground"]
