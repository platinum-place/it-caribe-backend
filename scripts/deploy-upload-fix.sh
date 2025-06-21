#!/bin/bash

# Script para aplicar la configuración de uploads optimizada
# Uso: ./scripts/deploy-upload-fix.sh

set -e

echo "🚀 Aplicando configuración optimizada para uploads grandes y Livewire..."

# Colores para output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Función para logging
log() {
    echo -e "${BLUE}[$(date +'%Y-%m-%d %H:%M:%S')]${NC} $1"
}

success() {
    echo -e "${GREEN}✓${NC} $1"
}

warning() {
    echo -e "${YELLOW}⚠${NC} $1"
}

error() {
    echo -e "${RED}✗${NC} $1"
}

# Verificar que estamos en el directorio correcto
if [ ! -f "docker-compose.yml" ]; then
    error "No se encontró docker-compose.yml. Ejecuta este script desde la raíz del proyecto."
    exit 1
fi

log "Verificando archivos de configuración..."

# Verificar que existen los archivos necesarios
required_files=(
    "docker/nginx/nginx.conf"
    "docker/nginx/nginx-main.conf"
    "docker/nginx/Dockerfile"
    "docker/php/production.ini"
    "Dockerfile"
    "entrypoint.sh"
)

for file in "${required_files[@]}"; do
    if [ -f "$file" ]; then
        success "Encontrado: $file"
    else
        error "Falta archivo: $file"
        exit 1
    fi
done

log "Creando backup de la configuración actual..."

# Crear directorio de backup
backup_dir="backups/$(date +'%Y%m%d_%H%M%S')"
mkdir -p "$backup_dir"

# Backup de archivos importantes
cp docker-compose.yml "$backup_dir/" 2>/dev/null || true
cp -r docker/ "$backup_dir/" 2>/dev/null || true
cp Dockerfile "$backup_dir/" 2>/dev/null || true
cp entrypoint.sh "$backup_dir/" 2>/dev/null || true

success "Backup creado en: $backup_dir"

log "Deteniendo contenedores..."
docker-compose down

log "Limpiando imágenes anteriores..."
docker-compose build --no-cache --pull

log "Iniciando contenedores con nueva configuración..."
docker-compose up -d

log "Esperando que los contenedores estén listos..."
sleep 10

# Verificar que los contenedores están corriendo
log "Verificando estado de contenedores..."

containers=("nginx" "app")
for container in "${containers[@]}"; do
    if docker-compose ps | grep -q "$container.*Up"; then
        success "Contenedor $container está corriendo"
    else
        error "Contenedor $container no está corriendo"
        docker-compose logs "$container"
        exit 1
    fi
done

log "Ejecutando verificación de configuración..."

# Ejecutar script de verificación
if [ -f "scripts/check-upload-config.php" ]; then
    docker-compose exec app php scripts/check-upload-config.php
else
    warning "Script de verificación no encontrado"
fi

log "Verificando configuración de Nginx..."

# Verificar configuración de Nginx
nginx_config_test=$(docker-compose exec nginx nginx -t 2>&1)
if echo "$nginx_config_test" | grep -q "syntax is ok"; then
    success "Configuración de Nginx es válida"
else
    error "Error en configuración de Nginx:"
    echo "$nginx_config_test"
    exit 1
fi

log "Verificando límites de PHP..."

# Verificar configuración de PHP
upload_max=$(docker-compose exec app php -r "echo ini_get('upload_max_filesize');")
post_max=$(docker-compose exec app php -r "echo ini_get('post_max_size');")
memory_limit=$(docker-compose exec app php -r "echo ini_get('memory_limit');")

echo "Configuración actual de PHP:"
echo "  upload_max_filesize: $upload_max"
echo "  post_max_size: $post_max"
echo "  memory_limit: $memory_limit"

# Verificar que los valores son los esperados
if [[ "$upload_max" == "2048M" && "$post_max" == "2048M" && "$memory_limit" == "2048M" ]]; then
    success "Configuración de PHP es correcta"
else
    warning "Configuración de PHP podría no ser la esperada"
fi

log "Verificando logs de errores..."

# Mostrar logs recientes para verificar que no hay errores
echo "Logs recientes de Nginx:"
docker-compose logs --tail=10 nginx

echo "Logs recientes de la aplicación:"
docker-compose logs --tail=10 app

log "Ejecutando test básico..."

# Test básico de conectividad
if command -v curl &> /dev/null; then
    response=$(curl -s -o /dev/null -w "%{http_code}" http://localhost:${APP_PORT:-80}/ || echo "000")
    if [ "$response" = "200" ]; then
        success "Test de conectividad exitoso (HTTP $response)"
    else
        warning "Test de conectividad falló (HTTP $response)"
    fi
else
    warning "curl no está disponible, saltando test de conectividad"
fi

echo ""
echo "🎉 ¡Configuración aplicada exitosamente!"
echo ""
echo "📋 Resumen de cambios aplicados:"
echo "  • Límites de archivos aumentados a 2048M"
echo "  • Timeouts extendidos a 3600s"
echo "  • Buffers optimizados para archivos grandes"
echo "  • Configuración específica para Livewire"
echo "  • Directorios temporales configurados"
echo ""
echo "📖 Para más información, consulta: docs/UPLOAD_CONFIGURATION.md"
echo ""
echo "🔍 Para verificar la configuración manualmente:"
echo "  docker-compose exec app php scripts/check-upload-config.php"
echo ""
echo "📊 Para monitorear logs:"
echo "  docker-compose logs -f nginx"
echo "  docker-compose logs -f app"
echo ""

success "¡Despliegue completado!"
