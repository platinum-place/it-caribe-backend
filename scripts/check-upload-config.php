<?php
/**
 * Script para verificar la configuración de uploads y límites de archivos
 * Ejecutar con: php scripts/check-upload-config.php
 */

echo "=== Verificación de Configuración de Uploads ===\n\n";

// Verificar configuraciones de PHP
$configs = [
    'upload_max_filesize' => ini_get('upload_max_filesize'),
    'post_max_size' => ini_get('post_max_size'),
    'memory_limit' => ini_get('memory_limit'),
    'max_execution_time' => ini_get('max_execution_time'),
    'max_input_time' => ini_get('max_input_time'),
    'max_input_vars' => ini_get('max_input_vars'),
    'max_file_uploads' => ini_get('max_file_uploads'),
    'file_uploads' => ini_get('file_uploads') ? 'On' : 'Off',
];

echo "Configuraciones de PHP:\n";
echo "----------------------\n";
foreach ($configs as $key => $value) {
    printf("%-20s: %s\n", $key, $value);
}

echo "\n";

// Verificar extensiones necesarias
$extensions = ['curl', 'gd', 'mbstring', 'zip', 'pdo', 'pdo_pgsql'];
echo "Extensiones de PHP:\n";
echo "-------------------\n";
foreach ($extensions as $ext) {
    $status = extension_loaded($ext) ? '✓ Cargada' : '✗ No encontrada';
    printf("%-15s: %s\n", $ext, $status);
}

echo "\n";

// Verificar límites en bytes
function parseSize($size) {
    $unit = preg_replace('/[^bkmgtpezy]/i', '', $size);
    $size = preg_replace('/[^0-9\.]/', '', $size);
    if ($unit) {
        return round($size * pow(1024, stripos('bkmgtpezy', $unit[0])));
    } else {
        return round($size);
    }
}

$uploadMax = parseSize(ini_get('upload_max_filesize'));
$postMax = parseSize(ini_get('post_max_size'));
$memoryLimit = parseSize(ini_get('memory_limit'));

echo "Límites en bytes:\n";
echo "-----------------\n";
printf("upload_max_filesize: %s bytes (%.2f GB)\n", number_format($uploadMax), $uploadMax / (1024*1024*1024));
printf("post_max_size      : %s bytes (%.2f GB)\n", number_format($postMax), $postMax / (1024*1024*1024));
printf("memory_limit       : %s bytes (%.2f GB)\n", number_format($memoryLimit), $memoryLimit / (1024*1024*1024));

echo "\n";

// Verificar consistencia
echo "Verificación de consistencia:\n";
echo "-----------------------------\n";

if ($postMax >= $uploadMax) {
    echo "✓ post_max_size >= upload_max_filesize\n";
} else {
    echo "✗ post_max_size debe ser >= upload_max_filesize\n";
}

if ($memoryLimit >= $postMax) {
    echo "✓ memory_limit >= post_max_size\n";
} else {
    echo "✗ memory_limit debe ser >= post_max_size\n";
}

// Verificar directorio temporal
$tempDir = sys_get_temp_dir();
echo "\nDirectorio temporal:\n";
echo "--------------------\n";
printf("Directorio: %s\n", $tempDir);
printf("Escribible: %s\n", is_writable($tempDir) ? '✓ Sí' : '✗ No');

// Verificar espacio en disco
$freeSpace = disk_free_space($tempDir);
if ($freeSpace !== false) {
    printf("Espacio libre: %s bytes (%.2f GB)\n", number_format($freeSpace), $freeSpace / (1024*1024*1024));
} else {
    echo "No se pudo determinar el espacio libre\n";
}

echo "\n";

// Recomendaciones
echo "Recomendaciones:\n";
echo "----------------\n";

if ($uploadMax < 2147483648) { // 2GB
    echo "⚠ Considera aumentar upload_max_filesize para archivos muy grandes\n";
}

if (ini_get('max_execution_time') < 3600) {
    echo "⚠ Considera aumentar max_execution_time para uploads grandes\n";
}

if (ini_get('max_input_vars') < 10000) {
    echo "⚠ Considera aumentar max_input_vars para formularios complejos\n";
}

echo "\n=== Verificación completada ===\n";
