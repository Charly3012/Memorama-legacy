FROM php:7.4-cli

# Instalamos las extensiones que tu proyecto legacy necesita
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    && docker-php-ext-install mysqli pdo pdo_mysql bcmath gd

# Usamos la configuración de desarrollo para ver errores
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

WORKDIR /workspaces/Memorama