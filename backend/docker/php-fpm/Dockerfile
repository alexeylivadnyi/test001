FROM ubuntu:18.04

MAINTAINER livalex

RUN set -eux; \
	apt-get update; \
	apt-get install -y gosu; \
	rm -rf /var/lib/apt/lists/*; \
# verify that the binary works
	gosu nobody true

# Create user for files
RUN groupadd -g 1000 www \
    && useradd -u 1000 -g www -g www-data www

RUN apt-get update \
    && apt-get install -y locales \
    && apt-get -y dist-upgrade \
    && locale-gen en_US.UTF-8

ENV LANG en_US.UTF-8
ENV LANGUAGE en_US:en
ENV LC_ALL en_US.UTF-8
ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get purge supervisor

RUN apt-get install -y \
    curl \
    zip \
    unzip \
    git \
    software-properties-common \
    && add-apt-repository -y ppa:ondrej/php \
    && apt-get update \
    && apt-get install -y \
       supervisor \
       php7.4-fpm \
       php7.4-cli \
       php7.4-gd \
       php7.4-imap \
       php7.4-mbstring \
       php7.4-xml \
       php7.4-curl \
       php7.4-redis \
       php7.4-mysql \
    && php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
    && mkdir /run/php \
    && apt-get remove -y --purge software-properties-common \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

COPY php-fpm.conf /etc/php/7.4/fpm/php-fpm.conf
COPY www.conf /etc/php/7.4/fpm/pool.d/www.conf

WORKDIR /var/www

EXPOSE 9000

CMD ["php-fpm7.4"]
