FROM php:8.3-apache

# PHP拡張（PDO MySQL）を入れる
RUN docker-php-ext-install pdo pdo_mysql

# Apacheの設定（DocumentRootを /var/www/html/public に）
COPY .docker/apache.conf /etc/apache2/sites-available/000-default.conf

# mod_rewrite（将来のルーティング拡張用。不要なら消してOK）
RUN a2enmod rewrite

WORKDIR /var/www/html

#（開発中はボリュームでマウントするので COPY は必須ではないが、保険で置いても良い）
# COPY . /var/www/html
