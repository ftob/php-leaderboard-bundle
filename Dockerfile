FROM php:5.6-cli

RUN apt-get update && apt-get install -y git

# Install opcache
RUN docker-php-ext-install opcache
# Install mcrypt
#RUN docker-php-ext-install mcrypt
# Install mbstringx
RUN docker-php-ext-install mbstring

# Install Composer and make it available in the PATH
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

WORKDIR /usr/local/app/tests

#CMD ["php", "-S", "localhost:8000", "tests/Serverd.php"]
CMD ["/bin/bash"]
