FROM php:8.0.3-cli-alpine3.12

RUN apk update && apk add git curl zip nodejs yarn sqlite php-pdo_sqlite

COPY . /app
WORKDIR /app

RUN yarn install && yarn run encore prod

RUN echo '' >> var/app.db

COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN composer install \
    --optimize-autoloader \
    --no-ansi \
    --no-interaction \
    --no-progress
