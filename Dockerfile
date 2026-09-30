FROM debian:12

RUN apt update && apt install -y \
    apache2 \
    php \
    libapache2-mod-php \
    php-pgsql \
    php-mysql \
    php-cli \
    php-mbstring \
    php-xml \
    php-curl \
    php-zip \
    unzip \
    curl \
    nano \
    git \
    && apt clean \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && rm composer-setup.php

RUN git config --system --add safe.directory '*' \
    && git config --system init.defaultBranch main

RUN a2enmod rewrite headers expires

WORKDIR /var/www/html

EXPOSE 80

CMD ["apache2ctl", "-D", "FOREGROUND"]