FROM php:8.1-fpm
ARG uid=1000
ARG user=trapdev

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install mbstring pdo pdo_mysql exif pcntl gd bcmath

RUN rm -rf /var/www/html
RUN ln -s src html

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \ 
    chown -R $user:$user /home/$user

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

WORKDIR /var/www

USER $user

EXPOSE 9000

ENTRYPOINT ["php-fpm"]
