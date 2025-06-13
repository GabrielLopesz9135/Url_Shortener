FROM php:8.3-fpm-alpine3.19

# Instala dependências do sistema, Git e MongoDB
RUN apk add --no-cache \
    bash \
    curl \
    git \ 
    libpng-dev \
    libzip-dev \
    zlib-dev \
    openssl-dev \
    autoconf \
    g++ \
    make \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb

# Instala extensões PHP
RUN docker-php-ext-install gd zip

# Copia o Composer mais recente
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer config --global github-protocols https

# Instala Node e NPM
RUN apk add --no-cache nodejs npm

# Define o diretório de trabalho
WORKDIR /var/www

EXPOSE 9000

