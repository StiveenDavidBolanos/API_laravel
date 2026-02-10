#!/bin/bash
set -e

# Cachear configuración si estamos en producción
if [ "$APP_ENV" = "production" ]; then
    echo "Caching configuration..."
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
fi

# Crear enlace simbólico para el storage público
php artisan storage:link

# Ejecutar migraciones (Descomenta la siguiente línea si quieres migraciones automáticas)
# php artisan migrate --force

# Ejecutar el comando principal (apache)
exec "$@"