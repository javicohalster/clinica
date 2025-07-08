<?php
$path = __DIR__; // Carpeta raíz donde pones este script
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
foreach ($iterator as $file) {
    if ($file->isFile() && strtolower($file->getExtension()) === 'php') {
        $lines = file($file->getPathname());
        foreach ($lines as $number => $line) {
            if (stripos($line, 'NewADOConnection') !== false || stripos($line, 'mysql_') !== false) {
                echo "Encontrado en: " . $file->getPathname() . " (Línea " . ($number + 1) . ")\n";
                echo "→ " . trim($line) . "\n\n";
            }
        }
    }
}
?>

