# Imagem única do Certifica: Nginx + PHP-FPM (serversideup/php), código e vendor.
# Usada pelos serviços app (web) e queue. Configuração do PHP/Nginx por variáveis de ambiente
# (PHP_UPLOAD_MAX_FILE_SIZE, NGINX_CLIENT_MAX_BODY_SIZE etc.), definidas no compose de deploy.
# A tag de minor (8.2) recebe as correções de segurança do PHP a cada rebuild.
FROM serversideup/php:8.2-fpm-nginx-alpine

USER root
RUN install-php-extensions gd bcmath \
    # Mesmo uid/gid (1001) dos arquivos de storage já existentes no servidor
    && docker-php-serversideup-set-id www-data 1001:1001 \
    && docker-php-serversideup-set-file-permissions --owner 1001:1001 --service nginx

USER www-data

# Dependências PHP primeiro, para aproveitar o cache de build.
# Inclui as de desenvolvimento: com APP_ENV=local o AppServiceProvider registra o Telescope.
COPY --chown=www-data:www-data composer.json composer.lock ./
RUN composer install --no-interaction --prefer-dist --no-scripts --no-autoloader

COPY --chown=www-data:www-data . .
RUN composer dump-autoload --optimize \
    && ln -sfn /var/www/html/storage/app/public public/storage
