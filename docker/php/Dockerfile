FROM php:8.4-fpm
ARG UID=1000
ARG GID=1000

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpq-dev \
    && docker-php-ext-install \
        pdo \
        pdo_pgsql \
        pcntl \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN groupadd -g ${GID} appgroup \
    && useradd -u ${UID} -g appgroup -m appuser

COPY docker/php/start.sh /start.sh
RUN chmod +x /start.sh

WORKDIR /var/www
USER appuser

ENTRYPOINT ["/start.sh"]