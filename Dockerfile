FROM php:8.2-fpm

SHELL ["/bin/bash", "-o", "pipefail", "-c"]

# Rendszer csomagok + fejlécek
RUN apt-get update && apt-get install -y --no-install-recommends \
    ca-certificates \
    curl \
    git \
    zip \
    unzip \
    libxml2-dev \
    libzip-dev \
    zlib1g-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    pkg-config \
    $PHPIZE_DEPS \
 && rm -rf /var/lib/apt/lists/*

# PHP extensionök
RUN docker-php-ext-install -j"$(nproc)" zip pdo_mysql mbstring exif pcntl bcmath
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install -j"$(nproc)" gd

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1

# Git safe.directory
RUN git config --system --add safe.directory /var/www/html

WORKDIR /var/www/html

# entrypoint
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["entrypoint.sh"]
CMD ["php-fpm"]
