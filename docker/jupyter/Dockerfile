FROM jupyter/base-notebook

USER root

RUN echo "deb http://packages.dotdeb.org jessie all" >> /etc/apt/sources.list
RUN wget https://www.dotdeb.org/dotdeb.gpg
RUN apt-key add dotdeb.gpg
RUN apt-get update && apt-get install -y \
    php7.0-common \
    php7.0-dev \
    php7.0-cli \
    php7.0-curl \
    php7.0-intl \
    php7.0-json \
    php7.0-mcrypt \
    php7.0-opcache \
    php7.0-zip \
    php-pear

RUN apt-get install -y zip unzip
RUN apt-get install -y git

# install dependencies
RUN apt-get update && apt-get install -yq --no-install-recommends \
    vim \
    build-essential \
    python-dev \
    libsm6 \
    pandoc \
    libxrender1 \
    inkscape \
    pkg-config \
    && apt-get clean && \
    rm -rf /var/lib/apt/lists/*

## install zeromq and zmq php extension
RUN wget https://github.com/zeromq/zeromq4-1/releases/download/v4.1.5/zeromq-4.1.5.tar.gz && \
    tar -xvf zeromq-4.1.5.tar.gz && \
    cd zeromq-* && \
    ./configure && make && make install && \
    printf "\n" | pecl install zmq-beta && \
    echo "extension=zmq.so" > /etc/php/7.0/cli/conf.d/zmq.ini

RUN bash -c "wget http://getcomposer.org/composer.phar"
RUN chmod -v +x composer.phar

# install PHP composer
RUN wget https://litipk.github.io/Jupyter-PHP-Installer/dist/jupyter-php-installer.phar && \
    php ./jupyter-php-installer.phar -vvv install

RUN mv composer.phar /usr/local/bin/composer && \
    rm -rf zeromq-* jupyter-php*

# Reset user from jupyter/base-notebook
USER $NB_USER