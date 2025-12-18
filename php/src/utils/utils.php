<?php
declare(strict_types=1);

/**
 * Verifica si un valor es negativo y numérico
 * @param mixed $valor - El valor a verificar.
 * @return bool - True si es numérico y negativo, false en caso contrario.
 */
function is_negative(mixed $valor): bool
{
    if (!is_numeric($valor)) {
        return false;
    }
    return (float)$valor < 0;
}

/**
 * Magic Inc/Dec
 * * @param int|float|string $value - El valor a procesar.
 * @param string $mode - 'inc' para incrementar, 'dec' para decrementar.
 * @return int|float|string - El valor resultante.
 */
function magic_inc(int|float|string $value, string $mode): int|float|string
{
    // Validación inicial
    if (!$value || !is_numeric($value) || (float)$value === 0.0) {
        return 0;
    }

    $isNegative = is_negative($value); // Determinamos si es numerico negativo
    $absNumber = abs((float)$value);// Convertimos a float y tomamos valor absoluto
    $action = strtolower($mode); //Convertimos modo a minusculas

    if ($action !== 'inc' && $action !== 'dec') {
        throw new InvalidArgumentException("El modo debe ser 'inc' o 'dec'");
    }

    $formatCientific = sprintf("%.15e", $absNumber); // Notación científica formateado a 15 decimales
    [$numberSlice, $exp] = explode('e', $formatCientific); //Desestructuración primer dígito y exponente
    $exponent = (int)$exp;// Convertir exponente a entero
    $firstDigit = (int)$numberSlice[0]; // Convertir primer dígito del número a entero

    // Lógica de funcionamiento :
    // Numero negativo : incrementar un  numero negativo es reducir su valor absoluto y decrementar es aumentar su valor absoluto
    // Numero positivo : incrementar un numero positivo es aumentar su valor absoluto y decrementar es reducir su valor absoluto
    $shouldIncreaseAbs = $isNegative ? $action === 'dec' : $action === 'inc';

    $resDigit = 0;
    $resExp = $exponent;

    if ($shouldIncreaseAbs) {
        $resDigit = $firstDigit + 1;
        if ($resDigit > 9) {
            $resDigit = 1;
            $resExp++;
        }
    } else {
        $resDigit = $firstDigit - 1;
        if ($resDigit < 1) {
            $resDigit = 9;
            $resExp--;
        }
    }

    // Parte Bonus 
    // Si el exponente es muy alto, lo manejamos como string para no perder precisión . Numeros con  con mas de 15 digitos  pierden precisión en float o int 
    if ($resExp >= 15) {
        $result = $resDigit . str_repeat('0', $resExp); // construimos el número como string con tantos ceros como el exponente nos indica
        return $isNegative ? '-' . $result : $result; // Devuelve un string y si es negativo añadimos signo menos
    }

    $result = $resDigit * pow(10, $resExp); // Calculamos el valor numérico con su exponente si es positivo *100 o negativo *-1
    if ($isNegative) {
        $result *= -1;
    }

    // Limpieza de precisión decimal
    $finalValue = (float)sprintf("%.1g", $result); // Redondeamos a 1 dígito significativo para evitar errores de precisión y convertimos a float

    // Retorno dinámico según si tiene decimales o no
    return (floor($finalValue) == $finalValue) ? (int)$finalValue : $finalValue; // Formateamos primero a floor  ya que redondea hacia abajo buscando el entero más cercano. Después comparamos con el valor original para decidir si retornamos int o float
}