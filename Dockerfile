FROM php:latest

WORKDIR /app/nutricraft-app

RUN apt-get update

RUN apt-get install -y libpq-dev \
  && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
  && docker-php-ext-install pdo pdo_pgsql pgsql

COPY . .

EXPOSE 3000

CMD [ "php", "-S", "0.0.0.0:3001" ]