#!/bin/bash

# 依赖 sixbyte 的 nginx-proxy 配置
sudo docker run -d \
-e VIRTUAL_HOST=laradmin.local.com \
-e VIRTUAL_PORT=9000 \
-v /data/www:/var/www/html:rw \
-v /data/www/laradmin/docker-run/php-fpm.conf:/usr/local/etc/php-fpm.conf \
-v /data/www/laradmin/docker-run/php.ini:/usr/local/etc/php/php.ini:ro \
--name laradmin sixbyte/fpm56
