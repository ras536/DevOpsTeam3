FROM php:5.6.31-apache
copy app/ /var/www/html
COPY tests/ ~/tests
RUN apt-get update
RUN apt-get install -y phpunit
RUN phpunit --version
RUN phpunit --bootstrap /var/www/html/php/weatherapp.php ~/tests
EXPOSE 80
