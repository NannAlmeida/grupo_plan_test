# FROM php:7.3-fpm

# WORKDIR /var/www

# RUN apt-get update && apt-get install -y \
#     libfreetype6-dev \
#     libjpeg-dev \
#     libpng-dev \
#     libicu-dev \
#     libxml2-dev \
#     zlib1g-dev \
#     && docker-php-ext-configure gd \
#     && docker-php-ext-install gd \
#     && docker-php-ext-install intl pdo pdo_mysql

# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# COPY . /var/www

# COPY --chown=www-data:www-data . /var/www

# RUN curl -fsSL https://deb.nodesource.com/setup_14.x | bash - \
#     && apt-get install -y nodejs

# RUN npm install && npm run dev

# EXPOSE 9000
# CMD ["php", "artisan", "serve"]

FROM php:7.3-apache

WORKDIR /var/www/html

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN docker-php-ext-install pdo pdo_mysql
RUN apt-get update -y && apt-get install -y libwebp-dev libjpeg62-turbo-dev libpng-dev libxpm-dev \
    libfreetype6-dev
RUN apt-get update && \
    apt-get install -y \
    zlib1g-dev
RUN apt-get install -y libzip-dev
RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev
RUN docker-php-ext-install zip

RUN docker-php-ext-install gd

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN a2enmod rewrite
RUN chmod -R 777 /var/www/html
RUN echo '<Directory "/var/www/html">\n\tAllowOverride All\n</Directory>' >> /etc/apache2/apache2.conf

RUN curl -fsSL https://deb.nodesource.com/setup_14.x | bash - \
    && apt-get install -y nodejs

COPY package*.json ./

RUN npm install

COPY . .

RUN npm run dev

EXPOSE 9000
CMD ["php", "artisan", "serve"]