#!/bin/bash

echo "Iniciando configuracion de Nginx para Laravel..."

# 1. Modificar la raiz de Nginx a /public
cp /etc/nginx/sites-available/default /tmp/default
sed -i 's|root /home/site/wwwroot;|root /home/site/wwwroot/public;|g' /tmp/default
cp /tmp/default /etc/nginx/sites-available/default

# 2. Recargar Nginx para aplicar cambios
echo "Recargando Nginx..."
service nginx reload

# 3. Limpiar y optimizar cache de Laravel
echo "Optimizando Laravel..."
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 4. Iniciar PHP-FPM (Obligatorio para que no se apague el contenedor)
echo "Iniciando PHP-FPM..."
php-fpm