# Deploy na homologação (lmtstestes)

O servidor de testes não tem SSH. Todo push em `develop` dispara o workflow
[`.github/workflows/deploy-lmtstestes.yml`](../../.github/workflows/deploy-lmtstestes.yml):

1. **Imagem** (`Dockerfile` na raiz): [`serversideup/php:8.2-fpm-nginx-alpine`](https://serversideup.net/open-source/docker-php/)
   (Nginx + PHP-FPM no mesmo container) + código + `vendor`, publicada em
   `ghcr.io/lmtsufape/certifica-app:<sha>`. Usada pelos serviços `app` e `queue`.
2. **Deploy** pelo runner self-hosted da organização: gera o `.env`, baixa a imagem, roda
   `php artisan migrate --force` e sobe os containers com [`compose.yml`](compose.yml).

A imagem base acompanha as correções de segurança do PHP 8.2 a cada build. **O PHP 8.2 deixa de
receber correções em 31/12/2026**; a migração para 8.3+ depende da atualização do Laravel 9.

Configuração do PHP/Nginx (limites de upload, memória, OPcache) por variáveis de ambiente no
`compose.yml` (`PHP_UPLOAD_MAX_FILE_SIZE`, `NGINX_CLIENT_MAX_BODY_SIZE` etc.).

Endereço: https://lmtsteste15.ufape.edu.br (porta 30095 no servidor).

## Dados

| Volume | Conteúdo |
|---|---|
| `certifica_postgres` | banco PostgreSQL 15 |
| `certifica_storage` | `storage/` do Laravel: certificados, anexos, `app/public`, logs, sessões em arquivo |

Os dois volumes são `external`: o deploy falha em vez de criar um volume vazio por engano.

## Configuração

O `.env` vem do secret `DEPLOY_ENV_FILE` do environment `homologacao` (*Settings → Environments*).
Para mudar uma variável, edite o secret e rode o workflow de novo (*Run workflow*, sem `image-tag`).

Variável específica do servidor: `TRUSTED_PROXIES` (IP do proxy HTTPS da STI), lida por
`app/Http/Middleware/TrustProxies.php` para que o Laravel gere URLs com `https`.

## Rollback

*Actions → Deploy lmtstestes → Run workflow* na branch `develop`, informando em `image-tag` o SHA
de um commit já implantado. Atenção: migrations já aplicadas não são desfeitas.

## Logs

Portainer (https://lmtsteste22.ufape.edu.br) → *Containers* → `certifica-app-1` → *Logs*.
O `laravel.log` fica em `storage/logs/` dentro do volume `certifica_storage`
(acessível pelo *Console* do container no Portainer).
