FROM php:8.2-apache

# Instala Git e extensões PHP necessárias
RUN apt-get update && apt-get install -y git \
    && docker-php-ext-install mysqli pdo pdo_mysql

# Copia os arquivos do projeto para o Apache
COPY . /var/www/html/

EXPOSE 80
