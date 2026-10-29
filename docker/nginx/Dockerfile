# Nginx do Certifica: configuração + arquivos estáticos de public/.
# Build a partir da raiz do repositório: docker build -f docker/nginx/Dockerfile .
# Os arquivos de storage/app/public chegam pelo volume compartilhado com o php-fpm.
FROM nginx:1.28-alpine

COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf
COPY public /var/www/html/public
RUN ln -sfn /var/www/html/storage/app/public /var/www/html/public/storage
