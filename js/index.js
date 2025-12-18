import { magic_inc } from "./utils/utils.js";

/**
 * Ejemplos de uso de la función magic_inc
 */
const pruebas = [
    { val: 92999999999999999.0, mode: 'dec'},
    { val: 17, mode: 'dec' },
    { val: -0.5264523, mode: 'inc'},
    { val: "pepe", mode: 'inc' },
    { val: 0, mode: 'inc' },
    { val: -0, mode: 'inc' },
    { val: 1568.548, mode: 'inc' },
    { val: 10n, mode: 'inc' },
    { val: 100, mode: 'error_test' } 
];

console.log("--- PRUEBAS ---");

pruebas.forEach(({ val, mode, desc }) => {
    try {
        const result = magic_inc(val, mode);
        const type = typeof result;
        console.log(`Entrada: ${val} Modo:(${mode}) -> Resultado: ${result} (${type})`);
    } catch (error) {
        console.error(`[${desc}] Error : ${error.message}`);
    }
});

