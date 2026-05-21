/**
 * @jest-environment jsdom
 */

const { TextEncoder, TextDecoder } = require('util');
global.TextEncoder = TextEncoder;
global.TextDecoder = TextDecoder;

const $ = require('jquery');
window.$ = window.jQuery = $;

// Mockeamos $.get
$.get = jest.fn().mockReturnValue({ done: jest.fn() });

// Cargamos el código
require('./juego.js'); 

describe('Mantenimiento Correctivo: Bloqueo de tablero', () => {
    
    beforeEach(() => {
        document.body.innerHTML = '<div id="tablero"></div><div id="pregunta-correctos" style="display:none;"></div>';
        // Accedemos a las variables a través de window
        window.tableroBloqueado = false;
        window.parejaSeleccionada = [];
    });

    test('Negativa: El juego debe ignorar el clic si tableroBloqueado es true', () => {
        const carta = $('<div class="carta"></div>');
        // Asegúrate de invocar la versión expuesta en window
        window.asignarListeners(carta);

        window.tableroBloqueado = true;
        carta.click();

        expect(carta.hasClass('flipped')).toBe(false);
    });

    test('Positiva: El juego debe permitir el clic si tableroBloqueado es false', () => {
        const carta = $('<div class="carta"></div>');
        carta.attr("tipo", "definicion");
        
        window.asignarListeners(carta);

        window.tableroBloqueado = false; // Aseguramos que esté libre
        carta.click();

        // Verificamos si cambió de estado
        expect(carta.hasClass('flipped')).toBe(true);
    });
});