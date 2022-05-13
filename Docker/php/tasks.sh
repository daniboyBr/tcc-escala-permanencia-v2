#!/bin/sh

nohup sh -c  "while :; do cd /var/www && php artisan schedule:run >> /dev/null 2>&1; sleep 1m; done &"

exec "php-fpm"
