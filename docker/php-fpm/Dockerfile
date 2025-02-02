FROM phpdockerio/php:8.1-fpm

WORKDIR "/var/www"

RUN apt-get update; \
    apt-get -y --no-install-recommends install \
        git \
        php8.1-bcmath \
        php8.1-bz2 \
        php8.1-gd \
        php8.1-imap \
        php8.1-imagick \
        php8.1-mcrypt \
        php8.1-memcached \
        php8.1-mongodb \
        php8.1-mysql \
        php8.1-oauth \
        php8.1-odbc \
        php8.1-redis \
        php8.1-soap \
        php8.1-sqlite3 \
        php8.1-ssh2 \
        php8.1-xdebug \
        php8.1-xmlrpc \
        php8.1-yaml \
        wget; \
    apt-get clean; \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
# Install libXrender and libfontconfig and libssl and Imagick
#RUN apt-get update \
## NEED TO SET wkhtmltopdf to specific version, download and install
##https://computingforgeeks.com/install-wkhtmltopdf-on-ubuntu-debian-linux/
##apt install fontconfig
##    && apt-get -y install libfontconfig1 libxrender1 libssl1.0-dev php7.4-imagick \
#    && apt-get -y install libfontconfig1 libxrender1 libssl-dev php7.4-imagick \
#    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
#
## Install wget
#RUN apt-get update \
#    && apt-get -y install wget \
#    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
#
## Install symfony installer
#RUN  wget https://get.symfony.com/cli/installer -O - | bash
#
#ENV PATH="/root/.symfony/bin:${PATH}"
#RUN export PATH
