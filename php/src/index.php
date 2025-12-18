<?php

declare(strict_types=1);

require_once 'utils/utils.php';

echo "<h1> Pruebas </h1>";
echo "<pre>";

// Configuración de pruebas
$pruebas = [
    ['value' => "-0",            'mode' => 'dec'],
    ['value' => 17,              'mode' => 'dec'],
    ['value' => -0.5264523,      'mode' => 'inc'],
    ['value' => 1568.548,        'mode' => 'inc'],
    ['value' => 0.76,            'mode' => 'inc'],
    ['value' => 950,             'mode' => 'inc'],
    ['value' => 10,              'mode' => 'ERROR'],
    ['value' => "pepe",          'mode' => 'inc'],
    ['value' => -0.5264523,              'mode' => 'inc'],
    ['value' => -9999999999999999.0, 'mode' => 'dec'],
    ['value' => 0.0,                   'mode' => 'dec'],
    ['value' => 1.2223333332333938498494898298299393,'mode' => 'dec'],
];

echo str_pad("ENTRADA", 20) . str_pad("MODO", 10) . "RESULTADO\n";
echo str_repeat("=", 45) . "\n";

foreach ($pruebas as $p) {
    try {
        $res = magic_inc($p['value'], $p['mode']);

        echo str_pad((string)$p['value'], 20);
        echo str_pad($p['mode'], 10);
        echo "OK: " . $res . " (" . gettype($res) . ")\n";
    } catch (InvalidArgumentException $e) {
        // Captura el error de 'inc'/'dec'
        echo str_pad((string)$p['value'], 20);
        echo str_pad($p['mode'], 10);
        echo "ERROR: " . $e->getMessage() . "\n";
    } catch (TypeError $e) {
        // Captura errores de tipado
        echo "ERROR DE TIPADO: " . $e->getMessage() . "\n";
    }
}

echo "</pre>";
