// filepath: c:/Users/LABE1-PC-19/Documents/VsCode/DisenoWeb/SistemaDeRolGastos/javascript/solotexto-numero.js

document.addEventListener("DOMContentLoaded", () => {
    const cedulaInput = document.getElementById("cedula");
    const telefonoInput = document.getElementById("telefono");
    const nombreInput = document.getElementById("nombre");
    const apellidoInput = document.getElementById("apellido");

    // Validar que solo se ingresen números en cédula y teléfono
    const soloNumeros = (event) => {
        const charCode = event.which ? event.which : event.keyCode;
        if (charCode < 48 || charCode > 57) {
            event.preventDefault();
        }
    };

    // Validar que solo se ingresen letras en nombre y apellido
    const soloTexto = (event) => {
        const charCode = event.which ? event.which : event.keyCode;
        if (
            !(charCode >= 65 && charCode <= 90) && // Letras mayúsculas
            !(charCode >= 97 && charCode <= 122) && // Letras minúsculas
            charCode !== 32 && // Espacio
            charCode !== 225 && // á
            charCode !== 233 && // é
            charCode !== 237 && // í
            charCode !== 243 && // ó
            charCode !== 250 && // ú
            charCode !== 241 && // ñ
            charCode !== 209 // Ñ
        ) {
            event.preventDefault();
        }
    };

    cedulaInput.addEventListener("keypress", soloNumeros);
    telefonoInput.addEventListener("keypress", soloNumeros);
    nombreInput.addEventListener("keypress", soloTexto);
    apellidoInput.addEventListener("keypress", soloTexto);
});