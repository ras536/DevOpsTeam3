FROM php:5.6.31-apache
copy app/ /var/www/html
COPY tests/ ~/tests
EXPOSE 80
