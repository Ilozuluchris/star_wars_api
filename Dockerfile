FROM php:7.2
RUN apt-get update -y && apt-get install -y openssl zip unzip git libpq-dev
RUN pecl install -o -f redis pcov \
&&  rm -rf /tmp/pear \
&&  docker-php-ext-enable redis pcov
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo mbstring pdo_pgsql
WORKDIR /app
COPY . /app
RUN composer install

RUN chmod +x setup_api.sh

EXPOSE $PORT

ENTRYPOINT ["./setup_api.sh"]
