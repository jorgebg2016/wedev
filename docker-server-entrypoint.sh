#!/bin/sh


npm install -g pm2;

apt install nano -y;

cd /var/www/html;

composer install;

composer require doctrine/dbal;

php artisan migrate

php artisan db:seed

cd /var/www/frontend;

yarn install;

pm2 start ecosystem.config.js --watch;

pm2 save;

a2enmod proxy;

a2enmod proxy_http;

service apache2 restart;

service apache2 reload;

tail -f /var/log/faillog;
