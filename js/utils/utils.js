
/***
 * Magic Inc/Dec
 * 
 * Implementa una función magic_inc(value, mode) que incremente o decremente "mágicamente" un número dado.
 * @param {number|bigint|string} value - El valor a incrementar o decrementar.
 * @param {string} mode - El modo de operación: 'inc' para incrementar, 'dec' para decrementar.
 * @returns {number|bigint} - El valor incrementado o decrementado.
 */
export function magic_inc() {
    let [value, mode] = arguments;

    // Validación: Cualquier valor no numberérico null o 0 devolvemos 0 
    let number = parseFloat(value);
    if (!value || isNaN(number) || number === 0 || Math.sign(number) == -0) return 0;

    const isNegative = Math.sign(number) === -1; // Condicion pasa saber si es un numero negativo
    const absNumber = Math.abs(number); // Convertimos a positivo para  manipularlo
    const action = mode.toLowerCase(); // Convertimos el modo a minisculas para evitar errores

    // Extraer exponente y primer dígito (soporta números gigantes/pequeños)
    let [numberSlice, exp] = absNumber.toExponential().split('e'); // Tranformamos numero a exponencial y posteriormente hacemos un split nos quedamos con la parte  numerica y exponente 
    let exponent = parseInt(exp); // Convertimos exponente a un entero , no da igual si es positivo o negativo 
    let firstDigit = parseInt(numberSlice[0]); // Cogemos el primer digito de nuestra parte numerica 

    // Lógica de funcionamiento :
    // Numero negativo : incrementar un  numero negativo es reducir su valor absoluto y decrementar es aumentar su valor absoluto
    // Numero positivo : incrementar un numero positivo es aumentar su valor absoluto y decrementar es reducir su valor absoluto

    let shouldIncreaseAbs = isNegative ? action === 'dec' : action === 'inc';

    let resDigit, resExp = exponent;

    if (shouldIncreaseAbs) {
        // Ejemplo: 0.76 -> firstDigit:7, exp:-1. Resultado: (7+1)*10^-1 = 0.8
        resDigit = firstDigit + 1;
        //Logica para manejar primeros digitos mayores a 9 
        if (resDigit > 9) {
            resDigit = 1;
            resExp++;
        }
    } else {
        // Ejemplo: 17 -> d:1, e:1. Como 17 > 10, el siguiente hacia abajo es 10...
        resDigit = firstDigit - 1;
        if (resDigit < 1) {
            resDigit = 9;
            resExp--;
        }
    }

    /*Parte Bonus  */
    let result;
    // El exponente debe ser un BigIny o mayor o igual a 15 en su Exp para ser BigInt , los Number  mayores a 15 digitos pierden precision . 
    // Si no es asi retornamos un Number 
    if (typeof value === 'bigint' || resExp >= 15) {

        result = BigInt(resDigit) * (10n ** BigInt(resExp));
        if (isNegative) result = -result;
        return result;
    } else {
      
        result = resDigit * Math.pow(10, resExp);
        if (isNegative) result *= -1;
       
        return Number(result.toPrecision(1));  // Limpiamos resto de coma flotante
    }

}


