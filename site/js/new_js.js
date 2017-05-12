/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// format number



function calcular_edad(dia, mes, ano) {
    fecha_hoy = new Date();
    ahora_ano = fecha_hoy.getYear();
    ahora_mes = fecha_hoy.getMonth();
    ahora_dia = fecha_hoy.getDate();
    edad = (ahora_ano + 1900) - ano;

    if (ahora_mes < (mes - 1)) {
        edad--;
    }
    if (((mes - 1) == ahora_mes) && (ahora_dia < dia)) {
        edad--;
    }
    if (edad > 1900) {
        edad -= 1900;
    }

    return edad;
}

function solo_email(event) {
    var regex = new RegExp("^[@a-zA-z0-9._-]+$");
    if (event.keyCode != 9) {
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            if (event.keyCode != 8) {
                event.preventDefault();
                return false;
            }
        }
    }
}

function solo_letras(event) {
    var regex = new RegExp("^[a-zA-z ]+$");
    if (event.keyCode != 9) {
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            if (event.keyCode != 8) {
                event.preventDefault();
                return false;
            }
        }
    }
}


function solo_letras2(event) {
    var regex = new RegExp("^[a-zA-z0-9 ]+$");
    if (event.keyCode != 9) {
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            if (event.keyCode != 8) {
                event.preventDefault();
                return false;
            }
        }
    }
}

function solo_letras3(event) {
    var regex = new RegExp("^[a-zA-z0-9 ]+$");
    if (event.keyCode != 9) {
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            if (event.keyCode != 8) {
                event.preventDefault();
                return false;
            }
        }
    }
}


function solo_numeros(event) {
    var regex = new RegExp("^[0-9]+$");
    if (event.keyCode != 9) {
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            if (event.keyCode != 8) {
                event.preventDefault();
                return false;
            }
        }
    }
}

function solo_moneda(event) {
    var regex = new RegExp("^[0-9.,]+$");
    if (event.keyCode != 9) {
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            if (event.keyCode != 8) {
                event.preventDefault();
                return false;
            }
        }
    }
}







