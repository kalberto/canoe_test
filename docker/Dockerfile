FROM ubuntu:22.04

ARG WWWGROUP

ENV TZ=UTC

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update \
    && apt-get install -y curl zip unzip git supervisor libcap2-bin \
    && apt-get update \
    && apt-get install -y php8.1-cli php8.1-dev \
           php8.1-pgsql php8.1-sqlite3 php8.1-gd \
           php8.1-curl \
           php8.1-imap php8.1-mysql php8.1-mbstring \
           php8.1-xml php8.1-zip php8.1-bcmath php8.1-soap \
           php8.1-intl php8.1-readline \
           php8.1-ldap php8.1-gmp \
           php8.1-msgpack php8.1-igbinary php8.1-redis \
           php8.1-memcached php8.1-pcov php8.1-xdebug \
    && apt-get install -y mysql-client \
    && apt-get install -y postgresql-client \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN setcap "cap_net_bind_service=+ep" /usr/bin/php8.1

RUN groupadd --force -g $WWWGROUP sail
RUN useradd -ms /bin/bash --no-user-group -g $WWWGROUP -u 1337 sail

COPY start-container /usr/local/bin/start-container
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY php.ini /etc/php/8.1/cli/conf.d/99-sail.ini
RUN chmod +x /usr/local/bin/start-container

EXPOSE 8000

ENTRYPOINT ["start-container"]
