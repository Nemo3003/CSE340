FROM php:8.1.5-apache
COPY . /usr/src/myapp
WORKDIR /usr/src/myapp
CMD [ "php", "./home.php" ]