# Imagem da aplicação (php-fpm + código + vendor), usada pelos serviços php-fpm e queue.
# Baseada na antiga imagem lmts/php-fpm:8.2 do servidor de testes.
FROM php:8.2-fpm-alpine

WORKDIR /var/www/html/

ARG WWWGROUP=1001
ARG WWWUSER=1001

# Dependências do sistema
RUN apk update && apk add --no-cache \
    libpq-dev \
    tzdata \
    zip libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    jpegoptim optipng pngquant gifsicle

ENV LC_ALL pt_BR.UTF-8
ENV LANG pt_BR.UTF-8
ENV LANGUAGE pt_BR.UTF-8

RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini
COPY docker/php-fpm/php.ini /usr/local/etc/php/conf.d/custom-php.ini

# Extensões PHP
RUN docker-php-ext-install zip bcmath pdo_pgsql
RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# Usuário da aplicação (mesmo uid/gid 1001 dos arquivos de storage existentes)
RUN addgroup -g $WWWGROUP www
RUN adduser -u $WWWUSER -s /bin/sh -G www -D www
RUN chown www:www -R /var/www/html/

USER www

# Dependências PHP primeiro, para aproveitar o cache de build.
# Inclui as de desenvolvimento: com APP_ENV=local o AppServiceProvider registra o Telescope.
COPY --chown=www:www composer.json composer.lock ./
RUN composer install --no-interaction --prefer-dist --no-scripts --no-autoloader

COPY --chown=www:www . .
RUN composer dump-autoload --optimize \
    && ln -sfn /var/www/html/storage/app/public public/storage
