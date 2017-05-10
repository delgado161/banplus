/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


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
    var regex = new RegExp("^[a-zA-z0-9. ]+$");
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

function solo_email(event) {
    var regex = new RegExp("^[a-zA-Z0-9._-@]+$");
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



